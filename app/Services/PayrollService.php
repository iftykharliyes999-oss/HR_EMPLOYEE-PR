<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\LoanRequest;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PayrollService
{
    /*
    |--------------------------------------------------------------------------
    | Payroll Rules
    |--------------------------------------------------------------------------
    */

    private const ABSENCE_DEDUCTION_RATE = 0.03;

    private const LATE_COUNT_FOR_ONE_ABSENT = 3;

    /*
    |--------------------------------------------------------------------------
    | Calculate Monthly Payroll
    |--------------------------------------------------------------------------
    |
    | একজন Manager বা Employee-এর জন্য payroll calculation করবে।
    |
    */

    public function calculate(
        User $user,
        int $month,
        int $year,

        float $houseAllowance = 0,
        float $medicalAllowance = 0,
        float $transportAllowance = 0,
        float $foodAllowance = 0,

        float $festivalBonus = 0,
        float $performanceBonus = 0,
        float $otherBonus = 0,
        float $overtimeAmount = 0,

        float $taxDeduction = 0,
        float $advanceDeduction = 0,
        float $otherDeduction = 0
    ): array {
        /*
        |--------------------------------------------------------------------------
        | Base Salary
        |--------------------------------------------------------------------------
        */

        $baseSalary = max(
            0,
            (float) $user->salary
        );

        /*
        |--------------------------------------------------------------------------
        | Attendance Summary
        |--------------------------------------------------------------------------
        */

        $attendanceSummary = $this->getAttendanceSummary(
            $user,
            $month,
            $year
        );

        $actualAbsentDays = (int) $attendanceSummary[
            'actual_absent_days'
        ];

        $lateCount = (int) $attendanceSummary[
            'late_count'
        ];

        $latePenaltyDays = intdiv(
            $lateCount,
            self::LATE_COUNT_FOR_ONE_ABSENT
        );

        $totalDeductibleDays =
            $actualAbsentDays
            + $latePenaltyDays;

        /*
        |--------------------------------------------------------------------------
        | Absence Deduction
        |--------------------------------------------------------------------------
        |
        | প্রতি deductible day-এ base salary-এর ৩% কাটা হবে।
        |
        */

        $deductionPerAbsentDay =
            $baseSalary
            * self::ABSENCE_DEDUCTION_RATE;

        $absenceDeduction =
            $deductionPerAbsentDay
            * $totalDeductibleDays;

        /*
        |--------------------------------------------------------------------------
        | Automatic Loan Deduction
        |--------------------------------------------------------------------------
        */

        $loanDeduction = $this->getAutomaticLoanDeduction(
            $user,
            $month,
            $year
        );

        /*
        |--------------------------------------------------------------------------
        | Sanitize Earnings
        |--------------------------------------------------------------------------
        */

        $houseAllowance = max(
            0,
            $houseAllowance
        );

        $medicalAllowance = max(
            0,
            $medicalAllowance
        );

        $transportAllowance = max(
            0,
            $transportAllowance
        );

        $foodAllowance = max(
            0,
            $foodAllowance
        );

        $festivalBonus = max(
            0,
            $festivalBonus
        );

        $performanceBonus = max(
            0,
            $performanceBonus
        );

        $otherBonus = max(
            0,
            $otherBonus
        );

        $overtimeAmount = max(
            0,
            $overtimeAmount
        );

        /*
        |--------------------------------------------------------------------------
        | Gross Salary
        |--------------------------------------------------------------------------
        */

        $grossSalary =
            $baseSalary
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
        | Sanitize Additional Deductions
        |--------------------------------------------------------------------------
        */

        $taxDeduction = max(
            0,
            $taxDeduction
        );

        $advanceDeduction = max(
            0,
            $advanceDeduction
        );

        $otherDeduction = max(
            0,
            $otherDeduction
        );

        /*
        |--------------------------------------------------------------------------
        | Total Deduction
        |--------------------------------------------------------------------------
        */

        $totalDeduction =
            $absenceDeduction
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

        /*
        |--------------------------------------------------------------------------
        | Payroll Data
        |--------------------------------------------------------------------------
        */

        return [
            'user_id' => $user->getKey(),

            'salary_month' => $month,
            'salary_year' => $year,

            /*
            |--------------------------------------------------------------------------
            | Base Salary and Allowances
            |--------------------------------------------------------------------------
            */

            'base_salary' => round(
                $baseSalary,
                2
            ),

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

            /*
            |--------------------------------------------------------------------------
            | Bonuses and Earnings
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | Attendance Details
            |--------------------------------------------------------------------------
            */

            'actual_absent_days' =>
                $actualAbsentDays,

            'late_count' =>
                $lateCount,

            'late_penalty_days' =>
                $latePenaltyDays,

            'total_deductible_days' =>
                $totalDeductibleDays,

            /*
            |--------------------------------------------------------------------------
            | Deductions
            |--------------------------------------------------------------------------
            */

            'absence_deduction' => round(
                $absenceDeduction,
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

            /*
            |--------------------------------------------------------------------------
            | Final Calculation
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | Initial Status
            |--------------------------------------------------------------------------
            */

            'status' => 'Draft',

            'recipient_status' => 'Pending',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Payroll for One User
    |--------------------------------------------------------------------------
    */

    public function generateForUser(
        User $user,
        int $month,
        int $year,
        int $processedBy,

        float $houseAllowance = 0,
        float $medicalAllowance = 0,
        float $transportAllowance = 0,
        float $foodAllowance = 0,

        float $festivalBonus = 0,
        float $performanceBonus = 0,
        float $otherBonus = 0,
        float $overtimeAmount = 0,

        float $taxDeduction = 0,
        float $advanceDeduction = 0,
        float $otherDeduction = 0
    ): array {
        /*
        |--------------------------------------------------------------------------
        | Duplicate Protection
        |--------------------------------------------------------------------------
        */

        $existingPayroll = Payroll::query()
            ->where(
                'user_id',
                $user->getKey()
            )
            ->where(
                'salary_month',
                $month
            )
            ->where(
                'salary_year',
                $year
            )
            ->first();

        if ($existingPayroll) {
            return [
                'created' => false,

                'payroll' => $existingPayroll,

                'message' =>
                    'Payroll already exists for this month.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Payroll
        |--------------------------------------------------------------------------
        */

        $data = $this->calculate(
            $user,
            $month,
            $year,

            $houseAllowance,
            $medicalAllowance,
            $transportAllowance,
            $foodAllowance,

            $festivalBonus,
            $performanceBonus,
            $otherBonus,
            $overtimeAmount,

            $taxDeduction,
            $advanceDeduction,
            $otherDeduction
        );

        $data['processed_by'] = $processedBy;

        /*
        |--------------------------------------------------------------------------
        | Create Payroll
        |--------------------------------------------------------------------------
        */

        $payroll = Payroll::create($data);

        return [
            'created' => true,

            'payroll' => $payroll,

            'message' =>
                'Payroll generated successfully.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Payroll for All Managers and Employees
    |--------------------------------------------------------------------------
    */

    public function generateForAll(
        int $month,
        int $year,
        int $processedBy
    ): array {
        /*
        |--------------------------------------------------------------------------
        | Salary Eligible Users
        |--------------------------------------------------------------------------
        */

        $users = User::query()
            ->whereHas(
                'roles',
                function ($query) {
                    $query->whereIn(
                        'name',
                        [
                            'Manager',
                            'Employee',
                        ]
                    );
                }
            )
            ->whereNotNull('salary')
            ->where('salary', '>', 0)
            ->get();

        $generatedCount = 0;
        $skippedCount = 0;

        /*
        |--------------------------------------------------------------------------
        | Generate Inside Transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $users,
                $month,
                $year,
                $processedBy,
                &$generatedCount,
                &$skippedCount
            ) {
                foreach ($users as $user) {
                    $result = $this->generateForUser(
                        $user,
                        $month,
                        $year,
                        $processedBy
                    );

                    if ($result['created']) {
                        $generatedCount++;
                    } else {
                        $skippedCount++;
                    }
                }
            }
        );

        return [
            'generated' => $generatedCount,
            'skipped' => $skippedCount,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Get Attendance Summary
    |--------------------------------------------------------------------------
    */

    private function getAttendanceSummary(
        User $user,
        int $month,
        int $year
    ): array {
        $attendances = Attendance::query()
            ->where(
                'user_id',
                $user->getKey()
            )
            ->whereMonth(
                'date',
                $month
            )
            ->whereYear(
                'date',
                $year
            )
            ->get([
                'status',
            ]);

        return [
            'actual_absent_days' =>
                $attendances
                    ->where(
                        'status',
                        'Absent'
                    )
                    ->count(),

            'late_count' =>
                $attendances
                    ->where(
                        'status',
                        'Late'
                    )
                    ->count(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Get Automatic Loan Deduction
    |--------------------------------------------------------------------------
    |
    | Approved loan-এর deduction_start_month salary month-এর আগে বা সমান
    | হলে monthly installment payroll-এ কাটা হবে।
    |
    */

    private function getAutomaticLoanDeduction(
        User $user,
        int $month,
        int $year
    ): float {
        $salaryMonth = Carbon::create(
            $year,
            $month,
            1,
            0,
            0,
            0,
            'Asia/Dhaka'
        )->startOfMonth();

        $activeLoan = LoanRequest::query()
            ->where(
                'user_id',
                $user->getKey()
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
            ->oldest(
                'deduction_start_month'
            )
            ->first();

        if (!$activeLoan) {
            return 0;
        }

        return round(
            min(
                (float) $activeLoan
                    ->monthly_installment,

                (float) $activeLoan
                    ->remaining_balance
            ),
            2
        );
    }
}
