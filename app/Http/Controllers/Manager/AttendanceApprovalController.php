<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AttendanceApprovalController extends Controller
{
    public function approveClockIn(
        Attendance $attendance
    ): RedirectResponse {
        $manager = Auth::user();

        abort_unless(
            (int) $attendance->manager_id === (int) $manager->id,
            403
        );

        if (
            $attendance->clock_in_approval_status !== 'Pending'
        ) {
            return back()->with(
                'error',
                'Clock-in has already been processed.'
            );
        }

        $attendance->update([
            'clock_in_approval_status' => 'Approved',
            'clock_in_approved_by' => $manager->id,
            'clock_in_approved_at' => now('Asia/Dhaka'),
        ]);

        return back()->with(
            'success',
            'Clock-in approved successfully.'
        );
    }

    public function rejectClockIn(
        Attendance $attendance
    ): RedirectResponse {
        $manager = Auth::user();

        abort_unless(
            (int) $attendance->manager_id === (int) $manager->id,
            403
        );

        if (
            $attendance->clock_in_approval_status !== 'Pending'
        ) {
            return back()->with(
                'error',
                'Clock-in has already been processed.'
            );
        }

        $attendance->update([
            'clock_in_approval_status' => 'Rejected',
            'clock_in_approved_by' => $manager->id,
            'clock_in_approved_at' => now('Asia/Dhaka'),
        ]);

        return back()->with(
            'success',
            'Clock-in rejected.'
        );
    }

    public function approveClockOut(
        Attendance $attendance
    ): RedirectResponse {
        $manager = Auth::user();

        abort_unless(
            (int) $attendance->manager_id === (int) $manager->id,
            403
        );

        if (
            $attendance->clock_out_approval_status !== 'Pending'
        ) {
            return back()->with(
                'error',
                'Clock-out has already been processed.'
            );
        }

        $attendance->update([
            'clock_out_approval_status' => 'Approved',
            'clock_out_approved_by' => $manager->id,
            'clock_out_approved_at' => now('Asia/Dhaka'),
        ]);

        return back()->with(
            'success',
            'Clock-out approved successfully.'
        );
    }

    public function rejectClockOut(
        Attendance $attendance
    ): RedirectResponse {
        $manager = Auth::user();

        abort_unless(
            (int) $attendance->manager_id === (int) $manager->id,
            403
        );

        if (
            $attendance->clock_out_approval_status !== 'Pending'
        ) {
            return back()->with(
                'error',
                'Clock-out has already been processed.'
            );
        }

        $attendance->update([
            'clock_out_approval_status' => 'Rejected',
            'clock_out_approved_by' => $manager->id,
            'clock_out_approved_at' => now('Asia/Dhaka'),
        ]);

        return back()->with(
            'success',
            'Clock-out rejected.'
        );
    }
}
