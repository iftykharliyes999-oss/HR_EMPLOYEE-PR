<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee')
            ->where('manager_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('manager.leave.index', compact('leaves'));
    }

   public function show(Leave $leave)
{
    if ($leave->manager_id != auth()->id()) {
        abort(403);
    }

    return view('manager.leave.show', compact('leave'));
}

public function approve(Request $request, Leave $leave)
{
    if ($leave->manager_id != auth()->id()) {
        abort(403);
    }

    if ($leave->manager_status !== 'Pending') {
        return back()->with(
            'error',
            'Leave already processed.'
        );
    }

    $leave->update([
        'manager_status' => 'Approved',
        'manager_comment' => $request->manager_comment,
    ]);

    return redirect()
        ->route('manager.leaves.index')
        ->with(
            'success',
            'Leave approved successfully.'
        );
}

public function reject(Request $request, Leave $leave)
{
    if ($leave->manager_id != auth()->id()) {
        abort(403);
    }

    if ($leave->manager_status !== 'Pending') {
        return back()->with(
            'error',
            'Leave already processed.'
        );
    }

    $request->validate([
        'manager_comment' => 'required'
    ]);

    $leave->update([
        'manager_status' => 'Rejected',
        'manager_comment' => $request->manager_comment,
    ]);

    return redirect()
        ->route('manager.leaves.index')
        ->with(
            'success',
            'Leave rejected successfully.'
        );
}


}
