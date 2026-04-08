<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttemptAnswer extends Model
{
    protected $fillable = [
        'quiz_attempt_id',
        'question_id',
        'selected_option',
        'is_correct',
    ];

    // Kaun sa question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Kaun si attempt
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }
}