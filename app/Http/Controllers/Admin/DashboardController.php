<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{


    public function index()
    {

        $totalEmployee = User::role('employee')->count();


        $totalManager = User::role('manager')->count();

        $employees = User::role('employee')
                    ->latest()
                    ->take(5)
                    ->get();


        $managers = User::role('manager')
                    ->latest()
                    ->take(5)
                    ->get();


        $today = Carbon::today();




        $presentToday = Attendance::whereDate(
            'date',
            $today
        )
        ->where('status','Present')
        ->count();

        $lateToday = Attendance::whereDate(
            'date',
            $today
        )
        ->where('status','Late')
        ->count();

        $absentToday = Attendance::whereDate(
            'date',
            $today
        )
        ->where('status','Absent')
        ->count();

        $workingHours = Attendance::whereDate(
            'date',
            $today
        )
        ->sum('working_hours');


        $departments = User::role('employee')
        ->selectRaw('department, count(*) as total')
        ->groupBy('department')
        ->get();

        $todayAttendance = Attendance::with('user')
    ->whereDate('date', $today)
    ->latest()
    ->take(5)
    ->get();


    $totalAdmin = User::role('admin')->count();

$verifiedEmployee = User::role('employee')
    ->where('verification_status', 'verified')
    ->count();

$pendingEmployee = User::role('employee')
    ->where('verification_status', 'pending')
    ->count();

$newEmployeesThisMonth = User::role('employee')
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();

$maleEmployee = User::role('employee')
    ->where('gender', 'Male')
    ->count();

$femaleEmployee = User::role('employee')
    ->where('gender', 'Female')
    ->count();


$taskStats = [
    'total' => Task::count(),

    'completed' => Task::where('status', 'Completed')->count(),

    'pending' => Task::where('status', 'Pending')->count(),

    'progress' => Task::where('status', 'In Progress')->count(),

    'overdue' => Task::where('status', '!=', 'Completed')
        ->whereDate('due_date', '<', today())
        ->count(),
];

$taskChart = [
    $taskStats['completed'],
    $taskStats['pending'],
    $taskStats['progress'],
    $taskStats['overdue'],
];

$topPerformer = Task::query()
    ->select(
        'employee_id',
        DB::raw('COUNT(*) as total_tasks'),
        DB::raw("
            SUM(
                CASE
                    WHEN status = 'Completed' THEN 1
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
            (int) $item->completed_tasks /
            (int) $item->total_tasks
        ) * 100;
    })
    ->first();

$recentTasks = Task::with([
        'employee',
        'manager',
        'creator',
    ])
    ->latest()
    ->take(5)
    ->get();

        return view('admin.dashboard', compact(

    'totalEmployee',
    'totalManager',
    'employees',
    'managers',
    'presentToday',
    'lateToday',
    'absentToday',
    'workingHours',
    'departments',
    'todayAttendance',

    'totalAdmin',
    'verifiedEmployee',
    'pendingEmployee',
    'newEmployeesThisMonth',
    'maleEmployee',
    'femaleEmployee',
    'taskStats',
'taskChart',
'topPerformer',
'recentTasks',

));


    }


}
