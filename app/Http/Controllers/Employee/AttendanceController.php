<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct(
        private readonly AttendanceService $attendanceService
    ) {
    }

    public function clockIn(): RedirectResponse
    {
        $user = Auth::user();

        $todayAttendance = Attendance::query()
            ->where('user_id', $user->id)
            ->whereDate('date', now('Asia/Dhaka')->toDateString())
            ->first();

        if ($todayAttendance) {
            return back()->with(
                'error',
                'You have already clocked in today.'
            );
        }

        $now = Carbon::now('Asia/Dhaka');

        $calculated = $this->attendanceService
            ->calculateStatus($now);

        Attendance::create([
            'user_id' => $user->id,

            // এটি তোমার actual relationship অনুযায়ী বদলাতে হবে
            'manager_id' => $user->manager_id ?? null,

            'date' => $now->toDateString(),
            'clock_in' => $now->format('H:i:s'),

            'status' => $calculated['status'],
            'late_minutes' => $calculated['late_minutes'],

            'clock_in_approval_status' => 'Pending',
            'clock_out_approval_status' => 'Not Submitted',
        ]);

        return back()->with(
            'success',
            'Clock-in submitted for manager approval.'
        );
    }

    public function clockOut(): RedirectResponse
    {
        $user = Auth::user();
        $now = Carbon::now('Asia/Dhaka');

        $attendance = Attendance::query()
            ->where('user_id', $user->id)
            ->whereDate('date', $now->toDateString())
            ->first();

        if (!$attendance) {
            return back()->with(
                'error',
                'Please clock in first.'
            );
        }

        if ($attendance->clock_out) {
            return back()->with(
                'error',
                'You have already clocked out today.'
            );
        }

        if (
            $attendance->clock_in_approval_status === 'Rejected'
        ) {
            return back()->with(
                'error',
                'Your clock-in was rejected.'
            );
        }

        $workingHours = $this->attendanceService
            ->calculateWorkingHours(
                $attendance->clock_in,
                $now
            );

        $attendance->update([
            'clock_out' => $now->format('H:i:s'),
            'working_hours' => $workingHours,
            'clock_out_approval_status' => 'Pending',
        ]);

        return back()->with(
            'success',
            'Clock-out submitted for manager approval.'
        );
    }
}
