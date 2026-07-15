<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoanController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $loans = LoanRequest::query()
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $layout = $user->hasRole('Manager')
            ? 'manager.master'
            : 'employee.master';

        $storeRoute = $user->hasRole('Manager')
            ? 'manager.loans.store'
            : 'employee.loans.store';

        return view(
            'loans.index',
            compact(
                'loans',
                'layout',
                'storeRoute'
            )
        );
    }

    public function store(
        Request $request
    ): RedirectResponse {
        $validated = $request->validate([
            'requested_amount' => [
                'required',
                'numeric',
                'min:1',
            ],

            'installment_months' => [
                'required',
                'integer',
                'min:1',
                'max:60',
            ],

            'reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $hasActiveLoan = LoanRequest::query()
            ->where('user_id', Auth::id())
            ->whereIn('status', [
                'Pending',
                'Approved',
            ])
            ->exists();

        if ($hasActiveLoan) {
            return back()->with(
                'error',
                'You already have an active or pending loan request.'
            );
        }

        LoanRequest::create([
            'user_id' => Auth::id(),

            'requested_amount' =>
                $validated['requested_amount'],

            'installment_months' =>
                $validated['installment_months'],

            'reason' => $validated['reason'],

            'status' => 'Pending',
        ]);

        return back()->with(
            'success',
            'Loan request submitted successfully.'
        );
    }
}
