<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::where('status',1)
            ->latest()
            ->get();

        return view(
            'employee.holiday.index',
            compact('holidays')
        );
    }
}
