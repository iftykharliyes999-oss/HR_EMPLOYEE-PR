<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Models\NotificationRead;
use App\Models\Notification;
use App\Models\Task;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;


    protected $fillable = [

        'name',
        'email',
        'password',

        // Common information
        'phone',
        'department',
        'designation',
        'salary',
        'gender',
        'joining_date',
        'address',
        'photo',

        // Employee information
        'manager_id',

        // Verification information
        'nid_number',
        'nid_front',
        'nid_back',
        'verification_status',

    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'joining_date' => 'date',

        ];
    }



    public function employees()
    {
        return $this->hasMany(User::class, 'manager_id');
    }




    public function manager()
{
    return $this->belongsTo(User::class,'manager_id');
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}

public function leaves()
{
    return $this->hasMany(Leave::class, 'employee_id');
}


public function managedLeaves()
{
    return $this->hasMany(Leave::class, 'manager_id');
}


/**
 * Notifications created by this user.
 */
public function createdNotifications()
{
    return $this->hasMany(Notification::class, 'created_by');
}

/**
 * Notifications read by this user.
 */
public function notificationReads()
{
    return $this->hasMany(NotificationRead::class);
}
/**
 * Assigned Tasks
 */
public function assignedTasks()
{
    return $this->hasMany(Task::class, 'employee_id');
}

/**
 * Managed Tasks
 */
public function managedTasks()
{
    return $this->hasMany(Task::class, 'manager_id');
}

/**
 * Created Tasks
 */
public function createdTasks()
{
    return $this->hasMany(Task::class, 'created_by');
}

public function payrolls()
{
    return $this->hasMany(
        Payroll::class,
        'user_id'
    );
}

public function processedPayrolls()
{
    return $this->hasMany(
        Payroll::class,
        'processed_by'
    );
}

public function paidPayrolls()
{
    return $this->hasMany(
        Payroll::class,
        'paid_by'
    );
}

public function loanRequests()
{
    return $this->hasMany(
        LoanRequest::class,
        'user_id'
    );
}



}
