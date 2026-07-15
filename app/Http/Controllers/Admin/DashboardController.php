<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Current Bangladesh Date
        |--------------------------------------------------------------------------
        */

        $today = now('Asia/Dhaka')->toDateString();


        /*
        |--------------------------------------------------------------------------
        | Main User Statistics
        |--------------------------------------------------------------------------
        */

        $totalEmployee = User::role('employee')->count();

        $totalManager = User::role('manager')->count();

        $totalAdmin = User::role('admin')->count();

        $verifiedEmployee = User::role('employee')
            ->where('verification_status', 'verified')
            ->count();

        $pendingEmployee = User::role('employee')
            ->where('verification_status', 'pending')
            ->count();

        $newEmployeesThisMonth = User::role('employee')
            ->whereMonth('created_at', now('Asia/Dhaka')->month)
            ->whereYear('created_at', now('Asia/Dhaka')->year)
            ->count();

        $maleEmployee = User::role('employee')
            ->where('gender', 'Male')
            ->count();

        $femaleEmployee = User::role('employee')
            ->where('gender', 'Female')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Recent Employees
        |--------------------------------------------------------------------------
        */

        $employees = User::role('employee')
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Managers
        |--------------------------------------------------------------------------
        |
        | employees_count দেখানোর জন্য withCount ব্যবহার করা হয়েছে।
        |--------------------------------------------------------------------------
        */

        $managers = User::role('manager')
            ->withCount([
                'employees',
            ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | All Employees for Today's Attendance Overview
        |--------------------------------------------------------------------------
        */

        $allEmployees = User::role('employee')
            ->with('manager')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Today's Attendance Collection
        |--------------------------------------------------------------------------
        |
        | user_id দিয়ে key করা হয়েছে, যাতে প্রতিটি employee-এর attendance
        | দ্রুত পাওয়া যায়।
        |--------------------------------------------------------------------------
        */

        $todayAttendanceCollection = Attendance::query()
            ->with('user')
            ->whereDate('date', $today)
            ->get()
            ->keyBy('user_id');


        /*
        |--------------------------------------------------------------------------
        | Attendance Summary
        |--------------------------------------------------------------------------
        */

        $presentToday = $todayAttendanceCollection
            ->where('status', 'Present')
            ->count();

        $lateToday = $todayAttendanceCollection
            ->where('status', 'Late')
            ->count();

        $pendingClockIn = $todayAttendanceCollection
            ->where('clock_in_approval_status', 'Pending')
            ->count();

        $pendingClockOut = $todayAttendanceCollection
            ->where('clock_out_approval_status', 'Pending')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Today's Absent Employees
        |--------------------------------------------------------------------------
        |
        | যাদের attendance row নেই অথবা status Absent, তারা absent।
        |
        | পরে Leave integration করলে approved leave employee এখানে বাদ যাবে।
        |--------------------------------------------------------------------------
        */

        $absentEmployees = $allEmployees
            ->filter(function ($employee) use ($todayAttendanceCollection) {

                $attendance = $todayAttendanceCollection->get(
                    $employee->id
                );

                return !$attendance
                    || $attendance->status === 'Absent';
            })
            ->map(function ($employee) use ($todayAttendanceCollection) {

                return [
                    'employee' => $employee,

                    'attendance' => $todayAttendanceCollection->get(
                        $employee->id
                    ),

                    'status' => 'Absent',
                ];
            })
            ->values();

        $absentToday = $absentEmployees->count();


        /*
        |--------------------------------------------------------------------------
        | Complete Today Attendance Rows
        |--------------------------------------------------------------------------
        |
        | Attendance list page বা dashboard table-এ ব্যবহার করা যাবে।
        |--------------------------------------------------------------------------
        */

        $todayAttendanceRows = $allEmployees
            ->map(function ($employee) use ($todayAttendanceCollection) {

                $attendance = $todayAttendanceCollection->get(
                    $employee->id
                );

                return [
                    'employee' => $employee,

                    'attendance' => $attendance,

                    'status' => $attendance?->status ?? 'Absent',
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | Total Working Hours Today
        |--------------------------------------------------------------------------
        |
        | working_hours database format: H:MM
        |--------------------------------------------------------------------------
        */

        $totalWorkingMinutes = $todayAttendanceCollection
            ->sum(function ($attendance) {

                if (!$attendance->working_hours) {
                    return 0;
                }

                [$hours, $minutes] = array_pad(
                    explode(':', $attendance->working_hours),
                    2,
                    0
                );

                return ((int) $hours * 60)
                    + (int) $minutes;
            });

        $workingHours = sprintf(
            '%d:%02d',
            intdiv($totalWorkingMinutes, 60),
            $totalWorkingMinutes % 60
        );


        /*
        |--------------------------------------------------------------------------
        | Recent Clock-In / Clock-Out Activities
        |--------------------------------------------------------------------------
        */

        $todayAttendance = Attendance::query()
            ->with('user')
            ->whereDate('date', $today)
            ->latest('updated_at')
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Department Statistics
        |--------------------------------------------------------------------------
        */

        $departments = User::role('employee')
            ->selectRaw('department, COUNT(*) as total')
            ->groupBy('department')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Task Statistics
        |--------------------------------------------------------------------------
        */

        $taskStats = [
            'total' => Task::count(),

            'completed' => Task::where(
                'status',
                'Completed'
            )->count(),

            'pending' => Task::where(
                'status',
                'Pending'
            )->count(),

            'progress' => Task::where(
                'status',
                'In Progress'
            )->count(),

            'overdue' => Task::where(
                'status',
                '!=',
                'Completed'
            )
                ->whereDate(
                    'due_date',
                    '<',
                    $today
                )
                ->count(),
        ];

        $taskChart = [
            $taskStats['completed'],
            $taskStats['pending'],
            $taskStats['progress'],
            $taskStats['overdue'],
        ];


        /*
        |--------------------------------------------------------------------------
        | Top Performer
        |--------------------------------------------------------------------------
        */

        $topPerformer = Task::query()
            ->select(
                'employee_id',

                DB::raw(
                    'COUNT(*) as total_tasks'
                ),

                DB::raw("
                    SUM(
                        CASE
                            WHEN status = 'Completed'
                            THEN 1
                            ELSE 0
                        END
                    ) as completed_tasks
                ")
            )
            ->whereNotNull('employee_id')
            ->groupBy('employee_id')
            ->with('employee')
            ->get()
            ->sortByDesc(function ($item) {

                if ((int) $item->total_tasks === 0) {
                    return 0;
                }

                return (
                    (int) $item->completed_tasks
                    /
                    (int) $item->total_tasks
                ) * 100;
            })
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Recent Tasks
        |--------------------------------------------------------------------------
        */

        $recentTasks = Task::with([
            'employee',
            'manager',
            'creator',
        ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard View
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalEmployee',
                'totalManager',
                'totalAdmin',

                'employees',
                'managers',

                'verifiedEmployee',
                'pendingEmployee',
                'newEmployeesThisMonth',
                'maleEmployee',
                'femaleEmployee',

                'presentToday',
                'lateToday',
                'absentToday',
                'pendingClockIn',
                'pendingClockOut',
                'workingHours',

                'absentEmployees',
                'todayAttendanceRows',
                'todayAttendance',

                'departments',

                'taskStats',
                'taskChart',
                'topPerformer',
                'recentTasks'
            )
        );
    }
}
