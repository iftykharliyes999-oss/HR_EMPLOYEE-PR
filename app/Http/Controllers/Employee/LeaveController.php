<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::where('employee_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('employee.leave.index', compact('leaves'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
            'attachment' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Total Leave Days Calculate
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $totalDays = $start->diffInDays($end) + 1;

        // Attachment Upload
        $attachment = null;

        if ($request->hasFile('attachment')) {

            $attachment = time() . '_' . $request->attachment->getClientOriginalName();

            $request->attachment->move(
                public_path('uploads/leaves'),
                $attachment
            );
        }

        Leave::create([

            'employee_id' => auth()->id(),

            'manager_id' => auth()->user()->manager_id,

            'leave_type' => $request->leave_type,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'total_days' => $totalDays,

            'reason' => $request->reason,

            'attachment' => $attachment,

            'manager_status' => 'Pending',

            'admin_status' => 'Pending',

        ]);

        return redirect()
            ->route('employee.leaves.index')
            ->with('success', 'Leave Application Submitted Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $leave = Leave::findOrFail($id);

        if ($leave->employee_id != auth()->id()) {
            abort(403);
        }

        return view('employee.leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
{
    // Only owner can edit
    if ($leave->employee_id != auth()->id()) {
        abort(403);
    }

    // Only pending leave can be edited
    if (
        $leave->manager_status !== 'Pending' ||
        $leave->admin_status !== 'Pending'
    ) {
        return redirect()
            ->route('employee.leaves.index')
            ->with('error', 'This leave has already been processed and cannot be edited.');
    }

    return view('employee.leave.edit', compact('leave'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
{
    // Only owner can update
    if ($leave->employee_id != auth()->id()) {
        abort(403);
    }

    // Only pending leave can be updated
    if (
        $leave->manager_status !== 'Pending' ||
        $leave->admin_status !== 'Pending'
    ) {
        return redirect()
            ->route('employee.leaves.index')
            ->with('error', 'This leave has already been processed and cannot be modified.');
    }

    $request->validate([
        'leave_type' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'reason' => 'required|string|max:1000',
        'attachment' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);

    $totalDays = $start->diffInDays($end) + 1;

    $attachment = $leave->attachment;

    if ($request->hasFile('attachment')) {

        // Delete old file
        if (
            $leave->attachment &&
            file_exists(public_path('uploads/leaves/' . $leave->attachment))
        ) {
            unlink(public_path('uploads/leaves/' . $leave->attachment));
        }

        $attachment = time() . '_' . $request->file('attachment')->getClientOriginalName();

        $request->file('attachment')->move(
            public_path('uploads/leaves'),
            $attachment
        );
    }

    $leave->update([
        'leave_type' => $request->leave_type,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_days' => $totalDays,
        'reason' => $request->reason,
        'attachment' => $attachment,
    ]);

    return redirect()
        ->route('employee.leaves.index')
        ->with('success', 'Leave updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
{
    // Only owner can delete
    if ($leave->employee_id != auth()->id()) {
        abort(403);
    }

    // Only pending leave can be deleted
    if (
        $leave->manager_status !== 'Pending' ||
        $leave->admin_status !== 'Pending'
    ) {
        return redirect()
            ->route('employee.leaves.index')
            ->with('error', 'This leave has already been processed and cannot be deleted.');
    }

    // Delete attachment
    if (
        $leave->attachment &&
        file_exists(public_path('uploads/leaves/' . $leave->attachment))
    ) {
        unlink(public_path('uploads/leaves/' . $leave->attachment));
    }

    $leave->delete();

    return redirect()
        ->route('employee.leaves.index')
        ->with('success', 'Leave deleted successfully.');
}
}
