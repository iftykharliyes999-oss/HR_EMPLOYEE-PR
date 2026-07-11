<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Leave;

class DashboardController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        $employees = User::where(
            'manager_id',
            $manager->id
        )
        ->latest()
        ->get();

        $totalEmployee = $employees->count();

        $recentEmployees = User::where(
            'manager_id',
            $manager->id
        )
        ->latest()
        ->take(5)
        ->get();

        $pendingLeave = Leave::where(
            'manager_id',
            $manager->id
        )
        ->where('manager_status', 'Pending')
        ->count();

        $approvedLeave = Leave::where(
            'manager_id',
            $manager->id
        )
        ->where('manager_status', 'Approved')
        ->count();

        $rejectedLeave = Leave::where(
            'manager_id',
            $manager->id
        )
        ->where('manager_status', 'Rejected')
        ->count();

        $recentLeaves = Leave::with('employee')
            ->where('manager_id', $manager->id)
            ->latest()
            ->take(5)
            ->get();

        return view(
            'manager.dashboard',
            compact(
                'manager',
                'employees',
                'totalEmployee',
                'recentEmployees',
                'pendingLeave',
                'approvedLeave',
                'rejectedLeave',
                'recentLeaves'
            )
        );
    }
}
