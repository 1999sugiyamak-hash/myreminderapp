<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

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

    protected function createdUser(): BelongsTo{
        return $this->belongsTo(User::class, 'created_user', 'id');
    }

    protected function receivedUser(): BelongsTo{
        return $this->belongsTo(User::class, 'user_received_remainser', 'id');
    }
}
