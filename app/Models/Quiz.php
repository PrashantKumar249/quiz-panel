<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'time_limit',
        'user_id',
    ];

    /**
     * Quiz ke saare questions
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Quiz ke saare attempts (admin results ke liye)
     */
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}