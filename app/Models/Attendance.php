<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Attendance extends Model
{

    protected $fillable = [

        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'status',
        'working_hours'

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
