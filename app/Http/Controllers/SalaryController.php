<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SalaryController extends Controller
{
    /**
     * Logged-in Manager/Employee নিজের salary দেখবে।
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

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

        $payroll = Payroll::query()
            ->with([
                'processor',
                'payer',
            ])
            ->where('user_id', $user->id)
            ->where('salary_month', $month)
            ->where('salary_year', $year)
            ->first();

        $salaryHistory = Payroll::query()
            ->where('user_id', $user->id)
            ->latest('salary_year')
            ->latest('salary_month')
            ->paginate(12)
            ->withQueryString();

        if ($user->hasRole('Manager')) {
            $layout = 'manager.master';
            $receiveRouteName = 'manager.salary.received';
            $salaryRouteName = 'manager.salary.index';
        } else {
            $layout = 'employee.master';
            $receiveRouteName = 'employee.salary.received';
            $salaryRouteName = 'employee.salary.index';
        }

        return view(
            'salary.index',
            compact(
                'user',
                'payroll',
                'salaryHistory',
                'month',
                'year',
                'layout',
                'receiveRouteName',
                'salaryRouteName'
            )
        );
    }

    /**
     * Logged-in user salary received confirm করবে।
     */
    public function received(Payroll $payroll): RedirectResponse
    {
        $user = Auth::user();

        abort_unless(
            (int) $payroll->user_id === (int) $user->id,
            403
        );

        if ($payroll->status !== 'Paid') {
            return back()->with(
                'error',
                'Salary has not been paid by Admin yet.'
            );
        }

        if ($payroll->recipient_status === 'Received') {
            return back()->with(
                'error',
                'Salary receipt has already been confirmed.'
            );
        }

        $payroll->update([
            'recipient_status' => 'Received',
            'received_at' => now('Asia/Dhaka'),
        ]);

        return back()->with(
            'success',
            'Salary received successfully confirmed.'
        );
    }
}
