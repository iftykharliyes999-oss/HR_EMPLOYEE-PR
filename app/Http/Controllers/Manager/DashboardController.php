<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Leave;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        $employees = User::where(
            'manager_id',
            $manager->id
        )
        ->latest()
        ->get();

        $totalEmployee = $employees->count();

        $recentEmployees = User::where(
            'manager_id',
            $manager->id
        )
        ->latest()
        ->take(5)
        ->get();

        $pendingLeave = Leave::where(
            'manager_id',
            $manager->id
        )
        ->where('manager_status', 'Pending')
        ->count();

        $approvedLeave = Leave::where(
            'manager_id',
            $manager->id
        )
        ->where('manager_status', 'Approved')
        ->count();

        $rejectedLeave = Leave::where(
            'manager_id',
            $manager->id
        )
        ->where('manager_status', 'Rejected')
        ->count();

        $recentLeaves = Leave::with('employee')
            ->where('manager_id', $manager->id)
            ->latest()
            ->take(5)
            ->get();






        $taskChart = [

    'completed' => Task::where('manager_id', Auth::id())
        ->where('status', 'Completed')
        ->count(),

    'pending' => Task::where('manager_id', Auth::id())
        ->where('status', 'Pending')
        ->count(),

    'progress' => Task::where('manager_id', Auth::id())
        ->where('status', 'In Progress')
        ->count(),

    'overdue' => Task::where('manager_id', Auth::id())
        ->where('status','!=','Completed')
        ->whereDate('due_date','<',today())
        ->count(),

];

$topPerformer = Task::select(

        'employee_id',

        DB::raw('COUNT(*) as total'),

        DB::raw("
            SUM(
                CASE
                    WHEN status='Completed'
                    THEN 1
                    ELSE 0
                END
            ) as completed
        ")

    )

    ->where('manager_id',Auth::id())

    ->groupBy('employee_id')

    ->with('employee')

    ->get()

    ->sortByDesc(function($row){

        return $row->completed;

    })

    ->first();


    $employeeRanking = Task::select(

        'employee_id',

        DB::raw('COUNT(*) total'),

        DB::raw("
            SUM(
                CASE
                    WHEN status='Completed'
                    THEN 1
                    ELSE 0
                END
            ) completed
        ")

    )

    ->where('manager_id',Auth::id())

    ->groupBy('employee_id')

    ->with('employee')

    ->get()

    ->sortByDesc('completed');



        return view(
            'manager.dashboard',
            compact(
                'manager',
                'employees',
                'totalEmployee',
                'recentEmployees',
                'pendingLeave',
                'approvedLeave',
                'rejectedLeave',
                'recentLeaves',
                'taskChart',

        'topPerformer',

        'employeeRanking'

            )
        );
    }
}
