<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Employee Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $employee = Auth::user();

        $employeeId = $employee->getKey();

        $now = Carbon::now('Asia/Dhaka');

        $today = $now->toDateString();

        /*
        |--------------------------------------------------------------------------
        | Today's Attendance
        |--------------------------------------------------------------------------
        */

        $todayAttendance = Attendance::query()
            ->where('user_id', $employeeId)
            ->whereDate('date', $today)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Attendance Statistics
        |--------------------------------------------------------------------------
        */

        $present = Attendance::query()
            ->where('user_id', $employeeId)
            ->where('status', 'Present')
            ->count();

        $late = Attendance::query()
            ->where('user_id', $employeeId)
            ->where('status', 'Late')
            ->count();

        $absent = Attendance::query()
            ->where('user_id', $employeeId)
            ->where('status', 'Absent')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Total Working Time
        |--------------------------------------------------------------------------
        */

        $totalMinutes = Attendance::query()
            ->where('user_id', $employeeId)
            ->whereNotNull('working_hours')
            ->get(['working_hours'])
            ->sum(function (Attendance $attendance) {

                if (
                    !$attendance->working_hours
                    || !str_contains(
                        $attendance->working_hours,
                        ':'
                    )
                ) {
                    return 0;
                }

                [$hours, $minutes] = array_pad(
                    explode(
                        ':',
                        $attendance->working_hours
                    ),
                    2,
                    0
                );

                return ((int) $hours * 60)
                    + (int) $minutes;
            });

        $workingHours = intdiv(
            (int) $totalMinutes,
            60
        );

        $workingMinutes = (int) $totalMinutes % 60;

        $totalWorkingTime = sprintf(
            '%dh %02dm',
            $workingHours,
            $workingMinutes
        );

        /*
        |--------------------------------------------------------------------------
        | Current Month Attendance
        |--------------------------------------------------------------------------
        */

        $monthlyAttendance = Attendance::query()
            ->where('user_id', $employeeId)
            ->whereMonth('date', $now->month)
            ->whereYear('date', $now->year)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Task Statistics
        |--------------------------------------------------------------------------
        */

        $taskStats = [
            'completed' => Task::query()
                ->where('employee_id', $employeeId)
                ->where('status', 'Completed')
                ->count(),

            'pending' => Task::query()
                ->where('employee_id', $employeeId)
                ->where('status', 'Pending')
                ->count(),

            'progress' => Task::query()
                ->where('employee_id', $employeeId)
                ->where('status', 'In Progress')
                ->count(),

            'overdue' => Task::query()
                ->where('employee_id', $employeeId)
                ->where('status', '!=', 'Completed')
                ->whereDate('due_date', '<', $today)
                ->count(),
        ];

        return view(
            'employee.dashboard',
            compact(
                'employee',
                'todayAttendance',
                'present',
                'late',
                'absent',
                'totalWorkingTime',
                'monthlyAttendance',
                'taskStats'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Attendance Calendar Page
    |--------------------------------------------------------------------------
    */

    public function calendar()
    {
        return view('employee.calendar');
    }

    /*
    |--------------------------------------------------------------------------
    | Calendar Events API
    |--------------------------------------------------------------------------
    */

    public function calendarEvents()
    {
        $employeeId = Auth::id();

        $events = [];

        /*
        |--------------------------------------------------------------------------
        | Attendance Events
        |--------------------------------------------------------------------------
        */

        $attendances = Attendance::query()
            ->where('user_id', $employeeId)
            ->get();

        foreach ($attendances as $attendance) {

            $color = match ($attendance->status) {
                'Present' => '#28a745',
                'Late' => '#ffc107',
                'Absent' => '#dc3545',
                'Leave' => '#0dcaf0',
                'Holiday' => '#0d6efd',
                default => '#6c757d',
            };

            $events[] = [
                'title' => $attendance->status,
                'start' => Carbon::parse(
                    $attendance->date
                )->toDateString(),

                'allDay' => true,
                'color' => $color,

                'extendedProps' => [
                    'clock_in' =>
                        $attendance->clock_in,

                    'clock_out' =>
                        $attendance->clock_out,

                    'working_hours' =>
                        $attendance->working_hours,

                    'clock_in_approval' =>
                        $attendance
                            ->clock_in_approval_status,

                    'clock_out_approval' =>
                        $attendance
                            ->clock_out_approval_status,
                ],
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Holiday Events
        |--------------------------------------------------------------------------
        */

        $holidays = Holiday::query()
            ->where('status', 'Active')
            ->get();

        foreach ($holidays as $holiday) {

            $events[] = [
                'title' =>
                    'Holiday - ' . $holiday->title,

                'start' => Carbon::parse(
                    $holiday->start_date
                )->toDateString(),

                // FullCalendar-এর end date exclusive।
                'end' => Carbon::parse(
                    $holiday->end_date
                )
                    ->addDay()
                    ->toDateString(),

                'allDay' => true,
                'color' => '#0d6efd',
            ];
        }

        return response()->json($events);
    }
}
