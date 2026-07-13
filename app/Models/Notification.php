<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    /**
     * Mass Assignable Fields
     */
    protected $fillable = [
        'title',
        'slug',
        'message',
        'priority',
        'audience',
        'attachment',
        'publish_at',
        'expire_at',
        'status',
        'created_by',
    ];

    /**
     * Attribute Casting
     */
    protected $casts = [
        'publish_at' => 'datetime',
        'expire_at'  => 'datetime',
    ];

    /**
     * Creator (Admin)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Read Status
     * (Future: Manager/Employee Read Tracking)
     */
    public function reads()
    {
        return $this->hasMany(NotificationRead::class);
    }
}
