<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'description',

        'employee_id',
        'manager_id',
        'created_by',

        'priority',
        'status',

        'start_date',
        'due_date',

        'attachment',
        'submitted_file',

        'employee_comment',
        'manager_comment',

        'started_at',
        'submitted_at',
        'completed_at',
    ];

    protected $casts = [

        'start_date' => 'date',

        'due_date' => 'date',

        'started_at' => 'datetime',

        'submitted_at' => 'datetime',

        'completed_at' => 'datetime',
    ];

    /**
     * Employee
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Manager
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Admin Creator
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
