<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::latest()
            ->paginate(10);

        return view(
            'admin.holiday.index',
            compact('holidays')
        );
    }


    public function create()
    {
        return view('admin.holiday.create');
    }


    public function store(Request $request)
{
    $request->validate([

        'title' => 'required',

        'start_date' => 'required|date',

        'end_date' => 'required|date|after_or_equal:start_date',

        'description' => 'nullable',
    ]);

    $start = \Carbon\Carbon::parse($request->start_date);

    $end = \Carbon\Carbon::parse($request->end_date);

    $totalDays = $start->diffInDays($end) + 1;

    Holiday::create([

        'title' => $request->title,

        'start_date' => $request->start_date,

        'end_date' => $request->end_date,

        'total_days' => $totalDays,

        'description' => $request->description,

        'status' => 'Active',
    ]);

    return redirect()
        ->route('admin.holidays.index')
        ->with(
            'success',
            'Holiday Added Successfully'
        );
}


    public function show(Holiday $holiday)
    {
        return view(
            'admin.holiday.show',
            compact('holiday')
        );
    }


    public function edit(Holiday $holiday)
    {
        return view(
            'admin.holiday.edit',
            compact('holiday')
        );
    }


    public function update(
    Request $request,
    Holiday $holiday
)
{
    $request->validate([

        'title' => 'required',

        'start_date' => 'required|date',

        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $start = \Carbon\Carbon::parse($request->start_date);

    $end = \Carbon\Carbon::parse($request->end_date);

    $totalDays = $start->diffInDays($end) + 1;

    $holiday->update([

        'title' => $request->title,

        'start_date' => $request->start_date,

        'end_date' => $request->end_date,

        'total_days' => $totalDays,

        'description' => $request->description,
    ]);

    return redirect()
        ->route('admin.holidays.index')
        ->with(
            'success',
            'Holiday Updated Successfully'
        );
}


    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return back()->with(
            'success',
            'Holiday Deleted Successfully'
        );
    }
}
