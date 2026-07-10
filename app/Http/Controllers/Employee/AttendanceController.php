<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function clockIn()
    {
        $user = Auth::user();


        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();

        if ($attendance) {
            return back()->with('error', 'Already Clock In Done');
        }

        $now = Carbon::now();


        $status = $now->format('H:i') > '09:15'
            ? 'Late'
            : 'Present';

        Attendance::create([
            'user_id'   => $user->id,
            'date'      => today(),
            'clock_in'  => $now->format('H:i:s'),
            'status'    => $status,
        ]);

        return back()->with('success', 'Clock In Successfully');
    }



    public function clockOut()
    {
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Please Clock In First');
        }


        if ($attendance->clock_out) {
            return back()->with('error', 'Already Clock Out Done');
        }

        $clockOut = Carbon::now();
        $clockIn = Carbon::parse($attendance->clock_in);


        $hours = $clockIn->diffInHours($clockOut);

        $minutes = $clockIn
            ->copy()
            ->addHours($hours)
            ->diffInMinutes($clockOut);

        // Format: 0.30 / 1.00 / 8.45
        $workingHours = sprintf('%d.%02d', $hours, $minutes);

        $attendance->update([
            'clock_out'     => $clockOut->format('H:i:s'),
            'working_hours' => $workingHours,
        ]);

        return back()->with('success', 'Clock Out Successfully');
    }
}
