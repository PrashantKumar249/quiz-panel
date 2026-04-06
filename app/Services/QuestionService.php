<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
    public function storeQuestion($data)
    {
        return Question::create($data);
    }
}