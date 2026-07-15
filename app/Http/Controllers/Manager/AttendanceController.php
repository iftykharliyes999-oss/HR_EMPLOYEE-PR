<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $manager = Auth::user();

        $selectedDate = $request->get(
            'date',
            now('Asia/Dhaka')->toDateString()
        );

        $employees = User::query()
            ->where('manager_id', $manager->id)
            ->orderBy('name')
            ->get();

        $employeeIds = $employees->pluck('id');

        $attendances = Attendance::query()
            ->with('user')
            ->whereIn('user_id', $employeeIds)
            ->whereDate('date', $selectedDate)
            ->orderBy('clock_in')
            ->get()
            ->keyBy('user_id');

        $attendanceRows = $employees->map(function ($employee) use ($attendances) {
            $attendance = $attendances->get($employee->id);

            return [
                'employee' => $employee,
                'attendance' => $attendance,
                'final_status' => $attendance?->status ?? 'Absent',
            ];
        });

        return view(
            'manager.attendance.index',
            compact(
                'attendanceRows',
                'selectedDate'
            )
        );
    }

    public function show(Request $request, User $employee)
    {
        $manager = Auth::user();

        abort_unless(
            (int) $employee->manager_id === (int) $manager->id,
            403
        );

        $month = $request->get(
            'month',
            now('Asia/Dhaka')->format('Y-m')
        );

        $monthStart = Carbon::createFromFormat(
            'Y-m',
            $month,
            'Asia/Dhaka'
        )->startOfMonth();

        $monthEnd = $monthStart->copy()->endOfMonth();

        $attendances = Attendance::query()
            ->where('user_id', $employee->id)
            ->whereBetween('date', [
                $monthStart->toDateString(),
                $monthEnd->toDateString(),
            ])
            ->orderByDesc('date')
            ->get();

        $summary = [
            'present' => $attendances
                ->where('status', 'Present')
                ->count(),

            'late' => $attendances
                ->where('status', 'Late')
                ->count(),

            'absent' => $attendances
                ->where('status', 'Absent')
                ->count(),

            'leave' => $attendances
                ->where('status', 'Leave')
                ->count(),

            'total_working_hours' => $attendances
                ->sum(function ($attendance) {
                    if (!$attendance->working_hours) {
                        return 0;
                    }

                    [$hours, $minutes] = array_pad(
                        explode(':', $attendance->working_hours),
                        2,
                        0
                    );

                    return ((int) $hours * 60) + (int) $minutes;
                }),
        ];

        $summary['total_working_hours'] = sprintf(
            '%d:%02d',
            intdiv($summary['total_working_hours'], 60),
            $summary['total_working_hours'] % 60
        );

        return view(
            'manager.attendance.show',
            compact(
                'employee',
                'attendances',
                'summary',
                'month'
            )
        );
    }
}
