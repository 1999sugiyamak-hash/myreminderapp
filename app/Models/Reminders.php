<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    protected $fillable = [
        'created_user',
        'title',
        'description',
        'user_received_reminder',
        'remind_at',
        'latitude',
        'longitude',
        'completed',
        'repeted',
    ];

    // Specify property
    protected $cast =[
        'remind_at'=>'DateTime',
        'latitude'=>'decimal:7',
        'longitude'=>'decimal:7',
        'completed'=>'boolean',
        'repeted'=>'boolean',
    ];
}
