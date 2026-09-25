<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use App\Models\Reminders;
use Illuminate\Database\Eloquent\Model;

// #[Fillable(['name', 'email', 'password'])]
// #[Hidden(['password', 'remember_token'])]
class Users extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $fillable = [
        'name',
        'endpoint',
        'key',
        'token',
        'encoding',
    ];

    protected function createReminders(): HasMany{
        return $this->hasMany(Reminders::class, 'created_user', 'id');
    }

    protected function receivedReminders(): HasMany{
        return $this->hasMany(Reminders::class, 'user_received_reminder', 'id');
    }
}

