<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'is_suspended',
        'profile_photo',
        'school',
        'age',
        'bio',
        'is_profile_complete',
        'username',
        'is_public',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class, 'mentor_id');
    }

    public function taskSubmissions(): HasMany
    {
        return $this->hasMany(TaskSubmission::class);
    }

    public function vocationalTestResult()
    {
        return $this->hasOne(VocationalTestResult::class);
    }

    /**
     * Shorthand to check if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'administrador';
    }

    /**
     * Shorthand to check if the user is a mentor/teacher.
     */
    public function isMentor(): bool
    {
        return $this->user_type === 'maestro';
    }
}
