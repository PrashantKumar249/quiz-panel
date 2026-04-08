<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'total_questions',
        'correct_answers',
        'wrong_answers',
        'score',
        'status',
    ];

    // Kaun sa quiz tha
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Kon user ne diya
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Is attempt ke saare answers
    public function answers()
    {
        return $this->hasMany(QuizAttemptAnswer::class);
    }
}