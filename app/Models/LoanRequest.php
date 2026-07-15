<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanRequest extends Model
{
    protected $fillable = [
        'user_id',
        'requested_amount',
        'installment_months',
        'monthly_installment',
        'remaining_balance',
        'reason',
        'status',
        'reviewed_by',
        'reviewed_at',
        'admin_note',
        'deduction_start_month',
    ];

    protected $casts = [
        'requested_amount' => 'decimal:2',
        'monthly_installment' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'reviewed_at' => 'datetime',
        'deduction_start_month' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }

    public function isApproved(): bool
    {
        return $this->status === 'Approved';
    }
}
