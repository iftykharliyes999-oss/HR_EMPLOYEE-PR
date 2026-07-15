<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    protected $fillable = [
        /*
        |--------------------------------------------------------------------------
        | Relations
        |--------------------------------------------------------------------------
        */

        'user_id',
        'processed_by',
        'paid_by',

        /*
        |--------------------------------------------------------------------------
        | Salary Period
        |--------------------------------------------------------------------------
        */

        'salary_month',
        'salary_year',

        /*
        |--------------------------------------------------------------------------
        | Base Salary and Allowances
        |--------------------------------------------------------------------------
        */

        'base_salary',
        'house_allowance',
        'medical_allowance',
        'transport_allowance',
        'food_allowance',

        /*
        |--------------------------------------------------------------------------
        | Bonuses and Earnings
        |--------------------------------------------------------------------------
        */

        'festival_bonus',
        'performance_bonus',
        'other_bonus',
        'overtime_amount',

        /*
        |--------------------------------------------------------------------------
        | Attendance Details
        |--------------------------------------------------------------------------
        */

        'actual_absent_days',
        'late_count',
        'late_penalty_days',
        'total_deductible_days',

        /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

        'absence_deduction',
        'tax_deduction',
        'loan_deduction',
        'advance_deduction',
        'other_deduction',

        /*
        |--------------------------------------------------------------------------
        | Final Salary Calculation
        |--------------------------------------------------------------------------
        */

        'gross_salary',
        'total_deduction',
        'net_salary',

        /*
        |--------------------------------------------------------------------------
        | Payment Status
        |--------------------------------------------------------------------------
        */

        'status',
        'payment_date',
        'payment_method',
        'transaction_reference',
        'note',
        'paid_at',

        /*
        |--------------------------------------------------------------------------
        | Recipient Confirmation
        |--------------------------------------------------------------------------
        */

        'recipient_status',
        'received_at',
    ];

    protected $casts = [
        /*
        |--------------------------------------------------------------------------
        | Salary Period
        |--------------------------------------------------------------------------
        */

        'salary_month' => 'integer',
        'salary_year' => 'integer',

        /*
        |--------------------------------------------------------------------------
        | Base Salary and Allowances
        |--------------------------------------------------------------------------
        */

        'base_salary' => 'decimal:2',
        'house_allowance' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'transport_allowance' => 'decimal:2',
        'food_allowance' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Bonuses and Earnings
        |--------------------------------------------------------------------------
        */

        'festival_bonus' => 'decimal:2',
        'performance_bonus' => 'decimal:2',
        'other_bonus' => 'decimal:2',
        'overtime_amount' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Attendance Details
        |--------------------------------------------------------------------------
        */

        'actual_absent_days' => 'integer',
        'late_count' => 'integer',
        'late_penalty_days' => 'integer',
        'total_deductible_days' => 'integer',

        /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

        'absence_deduction' => 'decimal:2',
        'tax_deduction' => 'decimal:2',
        'loan_deduction' => 'decimal:2',
        'advance_deduction' => 'decimal:2',
        'other_deduction' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Final Salary Calculation
        |--------------------------------------------------------------------------
        */

        'gross_salary' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'net_salary' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Dates
        |--------------------------------------------------------------------------
        */

        'payment_date' => 'date',
        'paid_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Salary Recipient
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Payroll Generator
    |--------------------------------------------------------------------------
    */

    public function processor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'processed_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Salary Payer
    |--------------------------------------------------------------------------
    */

    public function payer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'paid_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Status Helpers
    |--------------------------------------------------------------------------
    */

    public function isDraft(): bool
    {
        return $this->status === 'Draft';
    }

    public function isPaid(): bool
    {
        return $this->status === 'Paid';
    }

    public function isReceived(): bool
    {
        return $this->recipient_status === 'Received';
    }

    /*
    |--------------------------------------------------------------------------
    | Salary Period Label
    |--------------------------------------------------------------------------
    */

    public function getSalaryPeriodAttribute(): string
    {
        return sprintf(
            '%02d-%04d',
            (int) $this->salary_month,
            (int) $this->salary_year
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Total Allowance Attribute
    |--------------------------------------------------------------------------
    */

    public function getTotalAllowanceAttribute(): float
    {
        return round(
            (float) $this->house_allowance
            + (float) $this->medical_allowance
            + (float) $this->transport_allowance
            + (float) $this->food_allowance,
            2
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Total Bonus Attribute
    |--------------------------------------------------------------------------
    */

    public function getTotalBonusAttribute(): float
    {
        return round(
            (float) $this->festival_bonus
            + (float) $this->performance_bonus
            + (float) $this->other_bonus
            + (float) $this->overtime_amount,
            2
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Total Additional Deduction Attribute
    |--------------------------------------------------------------------------
    */

    public function getTotalAdditionalDeductionAttribute(): float
    {
        return round(
            (float) $this->tax_deduction
            + (float) $this->loan_deduction
            + (float) $this->advance_deduction
            + (float) $this->other_deduction,
            2
        );
    }
}
