<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
    public function storeQuestion($data)
    {
        return Question::create($data);
    }

    public function updateQuestion($id, $data)
    {
        $question = Question::findOrFail($id);
        $question->update($data);
        return $question;
    }

    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);
        return $question->delete();
    }
}
