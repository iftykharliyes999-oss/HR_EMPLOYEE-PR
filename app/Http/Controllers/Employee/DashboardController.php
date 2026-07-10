<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;


class DashboardController extends Controller
{

    public function index()
    {

        $employee = Auth::user();


        $todayAttendance = Attendance::where('user_id',$employee->id)
        ->whereDate('date',Carbon::today())
        ->first();



        $present = Attendance::where('user_id',$employee->id)
        ->where('status','Present')
        ->count();



        $late = Attendance::where('user_id',$employee->id)
        ->where('status','Late')
        ->count();



        $absent = Attendance::where('user_id',$employee->id)
        ->where('status','Absent')
        ->count();



        $workingHours = Attendance::where('user_id',$employee->id)
        ->sum('working_hours');



        return view('employee.dashboard',compact(

            'employee',

            'todayAttendance',

            'present',

            'late',

            'absent',

            'workingHours'

        ));


    }

}
