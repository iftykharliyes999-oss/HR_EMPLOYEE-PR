<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Holiday;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $todayAttendance = Attendance::where(
            'user_id',
            $employee->id
        )
        ->whereDate('date', Carbon::today())
        ->first();

        $present = Attendance::where(
            'user_id',
            $employee->id
        )
        ->where('status', 'Present')
        ->count();

        $late = Attendance::where(
            'user_id',
            $employee->id
        )
        ->where('status', 'Late')
        ->count();

        $joiningDate = Carbon::parse(
            $employee->joining_date
        );

        $totalDays = $joiningDate->diffInDays(
            Carbon::today()
        ) + 1;

        $attendanceDays = Attendance::where(
            'user_id',
            $employee->id
        )->count();

        $absent = max(
            0,
            $totalDays - $attendanceDays
        );

        $totalMinutes = 0;

        $attendances = Attendance::where(
            'user_id',
            $employee->id
        )
        ->whereNotNull('working_hours')
        ->get();

        foreach ($attendances as $attendance) {

            if (
                $attendance->working_hours &&
                str_contains(
                    $attendance->working_hours,
                    ':'
                )
            ) {

                [$hour, $minute] = explode(
                    ':',
                    $attendance->working_hours
                );

                $totalMinutes +=
                    ($hour * 60) + $minute;
            }
        }

        $workingHours =
            floor($totalMinutes / 60);

        $workingMinutes =
            $totalMinutes % 60;

        $totalWorkingTime =
            $workingHours . 'h ' .
            $workingMinutes . 'm';

        $monthlyAttendance = Attendance::where(
            'user_id',
            $employee->id
        )
        ->whereMonth(
            'date',
            Carbon::now()->month
        )
        ->count();

        return view(
            'employee.dashboard',
            compact(
                'employee',
                'todayAttendance',
                'present',
                'late',
                'absent',
                'totalWorkingTime',
                'monthlyAttendance'
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
    $employee = Auth::user();

    $events = [];

    // Attendance

    $attendances = Attendance::where(
        'user_id',
        $employee->id
    )->get();

    foreach ($attendances as $attendance) {

        $color = '#28a745';

        if ($attendance->status == 'Late') {
            $color = '#ffc107';
        }

        $events[] = [

            'title' => $attendance->status,

            'start' => $attendance->date,

            'color' => $color,

        ];
    }


    // Holidays

    $holidays = Holiday::where(
        'status',
        'Active'
    )->get();

    foreach ($holidays as $holiday) {

        $events[] = [

            'title' => 'Holiday - '.$holiday->title,

            'start' => $holiday->start_date,

            'end' => Carbon::parse(
                $holiday->end_date
            )->addDay(),

            'color' => '#0d6efd',

        ];
    }

    return response()->json($events);
}
}
