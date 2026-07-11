<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;


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
    'femaleEmployee'

));


    }


}
