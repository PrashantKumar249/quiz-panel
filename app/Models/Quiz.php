<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'time_limit',
        'user_id'
    ];

    // Relationship
    public function questions()
    {
        return $this->hasMany(\App\Models\Question::class);
    }
}