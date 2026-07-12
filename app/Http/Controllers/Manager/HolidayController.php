<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::where('status', 'Active')
            ->latest()
            ->paginate(10);

        return view(
            'manager.holiday.index',
            compact('holidays')
        );
    }
}
