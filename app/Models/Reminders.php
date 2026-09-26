<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminders extends Model
{
    protected $fillable = [
        'created_user',
        'title',
        'description',
        'user_received_reminder',
        'remind_at',
        'location_name',
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

    public function createdUser(): BelongsTo{
        return $this->belongsTo(Users::class, 'created_user', 'id');
    }

    public function receivedUser(): BelongsTo{
        return $this->belongsTo(Users::class, 'user_received_reminder', 'id');
    }
}
