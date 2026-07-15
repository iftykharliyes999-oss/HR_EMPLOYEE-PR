<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;
use App\Models\Payroll;
use App\Services\PayrollService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PayrollController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payroll List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $month = (int) $request->get(
            'month',
            now('Asia/Dhaka')->month
        );

        $year = (int) $request->get(
            'year',
            now('Asia/Dhaka')->year
        );

        if ($month < 1 || $month > 12) {
            $month = now('Asia/Dhaka')->month;
        }

        if ($year < 2020 || $year > 2100) {
            $year = now('Asia/Dhaka')->year;
        }

        $baseQuery = Payroll::query()
            ->where('salary_month', $month)
            ->where('salary_year', $year);

        $payrolls = (clone $baseQuery)
            ->with('user')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $totalPayrollAmount = (clone $baseQuery)
            ->sum('net_salary');

        $paidAmount = (clone $baseQuery)
            ->where('status', 'Paid')
            ->sum('net_salary');

        $draftAmount = (clone $baseQuery)
            ->where('status', 'Draft')
            ->sum('net_salary');

        $paidCount = (clone $baseQuery)
            ->where('status', 'Paid')
            ->count();

        $draftCount = (clone $baseQuery)
            ->where('status', 'Draft')
            ->count();

        return view(
            'admin.payroll.index',
            compact(
                'payrolls',
                'month',
                'year',
                'totalPayrollAmount',
                'paidAmount',
                'draftAmount',
                'paidCount',
                'draftCount'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Payroll
    |--------------------------------------------------------------------------
    */

    public function generate(
        Request $request,
        PayrollService $payrollService
    ): RedirectResponse {
        $validated = $request->validate([
            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],

            'year' => [
                'required',
                'integer',
                'min:2020',
                'max:2100',
            ],
        ]);

        $result = $payrollService->generateForAll(
            (int) $validated['month'],
            (int) $validated['year'],
            (int) Auth::id()
        );

        return redirect()
            ->route('admin.payroll.index', [
                'month' => $validated['month'],
                'year' => $validated['year'],
            ])
            ->with(
                'success',
                $result['generated']
                . ' payroll generated, '
                . $result['skipped']
                . ' payroll skipped.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Payroll Details
    |--------------------------------------------------------------------------
    */

    public function show(Payroll $payroll): View
    {
        $payroll->load([
            'user.manager',
            'processor',
            'payer',
        ]);

        return view(
            'admin.payroll.show',
            compact('payroll')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Salary Components
    |--------------------------------------------------------------------------
    */

    public function updateComponents(
        Request $request,
        Payroll $payroll
    ): RedirectResponse {
        if ($payroll->status === 'Paid') {
            return back()->with(
                'error',
                'Paid payroll cannot be modified.'
            );
        }

        $validated = $request->validate([
            'house_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'medical_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'transport_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'food_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'festival_bonus' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'performance_bonus' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_bonus' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'overtime_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax_deduction' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'advance_deduction' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_deduction' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $houseAllowance = (float) (
            $validated['house_allowance'] ?? 0
        );

        $medicalAllowance = (float) (
            $validated['medical_allowance'] ?? 0
        );

        $transportAllowance = (float) (
            $validated['transport_allowance'] ?? 0
        );

        $foodAllowance = (float) (
            $validated['food_allowance'] ?? 0
        );

        $festivalBonus = (float) (
            $validated['festival_bonus'] ?? 0
        );

        $performanceBonus = (float) (
            $validated['performance_bonus'] ?? 0
        );

        $otherBonus = (float) (
            $validated['other_bonus'] ?? 0
        );

        $overtimeAmount = (float) (
            $validated['overtime_amount'] ?? 0
        );

        $taxDeduction = (float) (
            $validated['tax_deduction'] ?? 0
        );

        $advanceDeduction = (float) (
            $validated['advance_deduction'] ?? 0
        );

        $otherDeduction = (float) (
            $validated['other_deduction'] ?? 0
        );

        /*
        |--------------------------------------------------------------------------
        | Active Loan Installment
        |--------------------------------------------------------------------------
        */

        $salaryMonth = Carbon::create(
            (int) $payroll->salary_year,
            (int) $payroll->salary_month,
            1,
            0,
            0,
            0,
            'Asia/Dhaka'
        )->startOfMonth();

        $activeLoan = LoanRequest::query()
            ->where(
                'user_id',
                $payroll->user_id
            )
            ->where(
                'status',
                'Approved'
            )
            ->where(
                'remaining_balance',
                '>',
                0
            )
            ->whereNotNull(
                'deduction_start_month'
            )
            ->whereDate(
                'deduction_start_month',
                '<=',
                $salaryMonth->toDateString()
            )
            ->oldest('deduction_start_month')
            ->first();

        $loanDeduction = $activeLoan
            ? min(
                (float) $activeLoan->monthly_installment,
                (float) $activeLoan->remaining_balance
            )
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Gross Salary
        |--------------------------------------------------------------------------
        */

        $grossSalary =
            (float) $payroll->base_salary
            + $houseAllowance
            + $medicalAllowance
            + $transportAllowance
            + $foodAllowance
            + $festivalBonus
            + $performanceBonus
            + $otherBonus
            + $overtimeAmount;

        /*
        |--------------------------------------------------------------------------
        | Total Deduction
        |--------------------------------------------------------------------------
        */

        $totalDeduction =
            (float) $payroll->absence_deduction
            + $taxDeduction
            + $loanDeduction
            + $advanceDeduction
            + $otherDeduction;

        /*
        |--------------------------------------------------------------------------
        | Net Salary
        |--------------------------------------------------------------------------
        */

        $netSalary = max(
            0,
            $grossSalary - $totalDeduction
        );

        $payroll->update([
            'house_allowance' => round(
                $houseAllowance,
                2
            ),

            'medical_allowance' => round(
                $medicalAllowance,
                2
            ),

            'transport_allowance' => round(
                $transportAllowance,
                2
            ),

            'food_allowance' => round(
                $foodAllowance,
                2
            ),

            'festival_bonus' => round(
                $festivalBonus,
                2
            ),

            'performance_bonus' => round(
                $performanceBonus,
                2
            ),

            'other_bonus' => round(
                $otherBonus,
                2
            ),

            'overtime_amount' => round(
                $overtimeAmount,
                2
            ),

            'tax_deduction' => round(
                $taxDeduction,
                2
            ),

            'loan_deduction' => round(
                $loanDeduction,
                2
            ),

            'advance_deduction' => round(
                $advanceDeduction,
                2
            ),

            'other_deduction' => round(
                $otherDeduction,
                2
            ),

            'gross_salary' => round(
                $grossSalary,
                2
            ),

            'total_deduction' => round(
                $totalDeduction,
                2
            ),

            'net_salary' => round(
                $netSalary,
                2
            ),
        ]);

        return back()->with(
            'success',
            'Salary components and calculation updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Pay Salary
    |--------------------------------------------------------------------------
    */

    public function pay(
        Request $request,
        Payroll $payroll
    ): RedirectResponse {
        if ($payroll->status === 'Paid') {
            return back()->with(
                'error',
                'This salary has already been paid.'
            );
        }

        $validated = $request->validate([
            'payment_date' => [
                'required',
                'date',
            ],

            'payment_method' => [
                'required',
                'string',
                'in:Cash,Bank Transfer,Mobile Banking,Cheque',
            ],

            'transaction_reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'note' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        if (
            $validated['payment_method'] !== 'Cash'
            && empty($validated['transaction_reference'])
        ) {
            return back()
                ->withErrors([
                    'transaction_reference' =>
                        'Transaction reference is required for this payment method.',
                ])
                ->withInput();
        }

        DB::transaction(function () use (
            $payroll,
            $validated
        ) {
            /*
            |--------------------------------------------------------------------------
            | Lock Payroll
            |--------------------------------------------------------------------------
            */

            $lockedPayroll = Payroll::query()
                ->whereKey($payroll->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedPayroll->status === 'Paid') {
                throw new \RuntimeException(
                    'This salary has already been paid.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Mark Salary as Paid
            |--------------------------------------------------------------------------
            */

            $lockedPayroll->update([
                'status' => 'Paid',

                'paid_by' => Auth::id(),

                'paid_at' => now('Asia/Dhaka'),

                'payment_date' =>
                    $validated['payment_date'],

                'payment_method' =>
                    $validated['payment_method'],

                'transaction_reference' =>
                    $validated['transaction_reference']
                    ?? null,

                'note' =>
                    $validated['note']
                    ?? null,

                'recipient_status' => 'Pending',

                'received_at' => null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Reduce Loan Balance
            |--------------------------------------------------------------------------
            */

            $loanDeduction = (float) (
                $lockedPayroll->loan_deduction ?? 0
            );

            if ($loanDeduction <= 0) {
                return;
            }

            $salaryMonth = Carbon::create(
                (int) $lockedPayroll->salary_year,
                (int) $lockedPayroll->salary_month,
                1,
                0,
                0,
                0,
                'Asia/Dhaka'
            )->startOfMonth();

            $loan = LoanRequest::query()
                ->where(
                    'user_id',
                    $lockedPayroll->user_id
                )
                ->where(
                    'status',
                    'Approved'
                )
                ->where(
                    'remaining_balance',
                    '>',
                    0
                )
                ->whereNotNull(
                    'deduction_start_month'
                )
                ->whereDate(
                    'deduction_start_month',
                    '<=',
                    $salaryMonth->toDateString()
                )
                ->oldest('deduction_start_month')
                ->lockForUpdate()
                ->first();

            if (!$loan) {
                return;
            }

            $actualDeduction = min(
                $loanDeduction,
                (float) $loan->remaining_balance
            );

            $newBalance = max(
                0,
                (float) $loan->remaining_balance
                - $actualDeduction
            );

            $loan->update([
                'remaining_balance' => round(
                    $newBalance,
                    2
                ),

                'status' => $newBalance <= 0
                    ? 'Completed'
                    : 'Approved',
            ]);
        });

        return redirect()
            ->route(
                'admin.payroll.show',
                $payroll
            )
            ->with(
                'success',
                'Salary paid successfully and loan balance updated.'
            );
    }
}
