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

        return view('admin.dashboard',compact(

            'totalEmployee',

            'totalManager',

            'employees',

            'managers',

            'presentToday',

            'lateToday',

            'absentToday',

            'workingHours',

            'departments',

            'todayAttendance'


        ));



    }


}
