<?php

namespace App\Services;

use Carbon\Carbon;
use InvalidArgumentException;

class AttendanceService
{
    private const LATE_HOUR = 9;
    private const LATE_MINUTE = 15;

    private const ABSENT_HOUR = 9;
    private const ABSENT_MINUTE = 30;

    /**
     * Clock-in time অনুযায়ী attendance status calculate করবে।
     *
     * Rules:
     * 09:15:00 বা তার আগে  = Present
     * 09:15:00-এর পরে এবং 09:30:00 পর্যন্ত = Late
     * 09:30:00-এর পরে = Absent
     */
    public function calculateStatus(Carbon $clockIn): array
    {
        $lateStart = $clockIn->copy()->setTime(
            self::LATE_HOUR,
            self::LATE_MINUTE,
            0
        );

        $absentCutoff = $clockIn->copy()->setTime(
            self::ABSENT_HOUR,
            self::ABSENT_MINUTE,
            0
        );

        if ($clockIn->greaterThan($absentCutoff)) {
            return [
                'status' => 'Absent',
                'late_minutes' => $lateStart->diffInMinutes($clockIn),
            ];
        }

        if ($clockIn->greaterThan($lateStart)) {
            return [
                'status' => 'Late',
                'late_minutes' => $lateStart->diffInMinutes($clockIn),
            ];
        }

        return [
            'status' => 'Present',
            'late_minutes' => 0,
        ];
    }

    /**
     * Clock-in এবং Clock-out থেকে total working hours calculate করবে।
     *
     * Output example:
     * 8:05
     * 7:45
     * 0:30
     */
    public function calculateWorkingHours(
        string $clockIn,
        Carbon $clockOut
    ): string {
        if (empty($clockIn)) {
            throw new InvalidArgumentException(
                'Clock-in time is required.'
            );
        }

        $clockInTime = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $clockOut->toDateString() . ' ' . $clockIn,
            'Asia/Dhaka'
        );

        if ($clockOut->lessThan($clockInTime)) {
            throw new InvalidArgumentException(
                'Clock-out time cannot be earlier than clock-in time.'
            );
        }

        $totalMinutes = $clockInTime->diffInMinutes($clockOut);

        $hours = intdiv($totalMinutes, 60);
        $remainingMinutes = $totalMinutes % 60;

        return sprintf(
            '%d:%02d',
            $hours,
            $remainingMinutes
        );
    }
}
