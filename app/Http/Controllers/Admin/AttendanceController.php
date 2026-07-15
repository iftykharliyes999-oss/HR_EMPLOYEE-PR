<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->get(
            'date',
            now('Asia/Dhaka')->toDateString()
        );

        $employees = User::role('Employee')
            ->orderBy('name')
            ->get();

        $attendanceRows = $employees->map(function ($employee) use ($selectedDate) {

            $attendance = Attendance::where(
                'user_id',
                $employee->id
            )
            ->whereDate('date', $selectedDate)
            ->first();

            return [

                'employee' => $employee,

                'attendance' => $attendance,

                'status' => $attendance?->status ?? 'Absent',

            ];

        });

        return view(
            'admin.attendance.index',
            compact(
                'attendanceRows',
                'selectedDate'
            )
        );
    }

    public function show(Request $request, User $employee)
    {
        $month = $request->get(
            'month',
            now()->format('Y-m')
        );

        $start = Carbon::createFromFormat(
            'Y-m',
            $month
        )->startOfMonth();

        $end = $start->copy()->endOfMonth();

        $attendances = Attendance::where(
            'user_id',
            $employee->id
        )
        ->whereBetween('date', [
            $start,
            $end
        ])
        ->latest('date')
        ->get();

        $summary = [

            'present' =>
                $attendances->where('status', 'Present')->count(),

            'late' =>
                $attendances->where('status', 'Late')->count(),

            'absent' =>
                $attendances->where('status', 'Absent')->count(),

            'leave' =>
                $attendances->where('status', 'Leave')->count(),

        ];

        return view(
            'admin.attendance.show',
            compact(
                'employee',
                'attendances',
                'summary',
                'month'
            )
        );
    }
}
