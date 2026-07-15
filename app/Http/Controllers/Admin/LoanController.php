<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    public function index(): View
    {
        $loans = LoanRequest::query()
            ->with([
                'user',
                'reviewer',
            ])
            ->latest()
            ->paginate(20);

        return view(
            'admin.loans.index',
            compact('loans')
        );
    }

    public function approve(
        Request $request,
        LoanRequest $loan
    ): RedirectResponse {
        if ($loan->status !== 'Pending') {
            return back()->with(
                'error',
                'This loan request has already been processed.'
            );
        }

        $validated = $request->validate([
            'approved_amount' => [
                'required',
                'numeric',
                'min:1',
                'max:' . $loan->requested_amount,
            ],

            'installment_months' => [
                'required',
                'integer',
                'min:1',
                'max:60',
            ],

            'deduction_start_month' => [
                'required',
                'date',
            ],

            'admin_note' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $approvedAmount =
            (float) $validated['approved_amount'];

        $installmentMonths =
            (int) $validated['installment_months'];

        $monthlyInstallment = round(
            $approvedAmount / $installmentMonths,
            2
        );

        $loan->update([
            'requested_amount' => $approvedAmount,

            'installment_months' =>
                $installmentMonths,

            'monthly_installment' =>
                $monthlyInstallment,

            'remaining_balance' =>
                $approvedAmount,

            'status' => 'Approved',

            'reviewed_by' => auth()->id(),

            'reviewed_at' =>
                now('Asia/Dhaka'),

            'deduction_start_month' =>
                $validated['deduction_start_month'],

            'admin_note' =>
                $validated['admin_note'] ?? null,
        ]);

        return back()->with(
            'success',
            'Loan approved successfully.'
        );
    }

    public function reject(
        Request $request,
        LoanRequest $loan
    ): RedirectResponse {
        if ($loan->status !== 'Pending') {
            return back()->with(
                'error',
                'This loan request has already been processed.'
            );
        }

        $validated = $request->validate([
            'admin_note' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $loan->update([
            'status' => 'Rejected',

            'reviewed_by' => auth()->id(),

            'reviewed_at' =>
                now('Asia/Dhaka'),

            'admin_note' =>
                $validated['admin_note'],
        ]);

        return back()->with(
            'success',
            'Loan rejected successfully.'
        );
    }
}
