<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with(['employee', 'manager'])
            ->latest()
            ->paginate(10);

        $totalLeaves = Leave::count();

        $pendingLeaves = Leave::where('admin_status', 'Pending')->count();

        $approvedLeaves = Leave::where('admin_status', 'Approved')->count();

        $rejectedLeaves = Leave::where('admin_status', 'Rejected')->count();

        return view(
            'admin.leave.index',
            compact(
                'leaves',
                'totalLeaves',
                'pendingLeaves',
                'approvedLeaves',
                'rejectedLeaves'
            )
        );
    }

    public function show(Leave $leave)
    {
        return view(
            'admin.leave.show',
            compact('leave')
        );
    }

    public function approve(Request $request, Leave $leave)
    {
        if ($leave->manager_status !== 'Approved') {

            return back()->with(
                'error',
                'Manager must approve first.'
            );
        }

        if ($leave->admin_status !== 'Pending') {

            return back()->with(
                'error',
                'Leave already processed.'
            );
        }

        $leave->update([
            'admin_status' => 'Approved',
            'admin_comment' => $request->admin_comment,
        ]);

        return redirect()
            ->route('admin.leaves.index')
            ->with(
                'success',
                'Leave approved successfully.'
            );
    }

    public function reject(Request $request, Leave $leave)
    {
        if ($leave->manager_status !== 'Approved') {

            return back()->with(
                'error',
                'Manager must approve first.'
            );
        }

        $request->validate([
            'admin_comment' => 'required'
        ]);

        if ($leave->admin_status !== 'Pending') {

            return back()->with(
                'error',
                'Leave already processed.'
            );
        }

        $leave->update([
            'admin_status' => 'Rejected',
            'admin_comment' => $request->admin_comment,
        ]);

        return redirect()
            ->route('admin.leaves.index')
            ->with(
                'success',
                'Leave rejected successfully.'
            );
    }
}
