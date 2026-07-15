<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'manager_id',
        'date',
        'clock_in',
        'clock_out',
        'status',
        'working_hours',
        'late_minutes',

        'clock_in_approval_status',
        'clock_out_approval_status',

        'clock_in_approved_by',
        'clock_out_approved_by',

        'clock_in_approved_at',
        'clock_out_approved_at',
    ];

    protected $casts = [
        'date' => 'date',
        'clock_in_approved_at' => 'datetime',
        'clock_out_approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function clockInApprover(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'clock_in_approved_by'
        );
    }

    public function clockOutApprover(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'clock_out_approved_by'
        );
    }
}
