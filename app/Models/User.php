<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    // =========================================================
    // RELATIONSHIPS
    // =========================================================

    /**
     * User ke saare quiz attempts
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // =========================================================
    // HELPER METHODS
    // =========================================================

    /**
     * Check karo admin hai ya nahi
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check karo active hai ya blocked
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }
}