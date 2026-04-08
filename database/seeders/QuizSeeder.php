<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // ✅ Java Quiz
        $javaQuiz = Quiz::create([
            'title' => 'Java Basics',
            'description' => 'Basic Java Questions',
            'time_limit' => 10,
            'user_id' => 1
        ]);

        Question::create([
            'quiz_id' => $javaQuiz->id,
            'question' => 'Java is?',
            'option_a' => 'Programming Language',
            'option_b' => 'Database',
            'option_c' => 'OS',
            'option_d' => 'Browser',
            'correct_answer' => 'A'
        ]);

        Question::create([
            'quiz_id' => $javaQuiz->id,
            'question' => 'Which keyword is used for inheritance?',
            'option_a' => 'this',
            'option_b' => 'super',
            'option_c' => 'extends',
            'option_d' => 'implements',
            'correct_answer' => 'C'
        ]);

        // ✅ GK Quiz
        $gkQuiz = Quiz::create([
            'title' => 'General Knowledge',
            'description' => 'GK Questions',
            'time_limit' => 10,
            'user_id' => 1
        ]);

        Question::create([
            'quiz_id' => $gkQuiz->id,
            'question' => 'Capital of India?',
            'option_a' => 'Mumbai',
            'option_b' => 'Delhi',
            'option_c' => 'Kolkata',
            'option_d' => 'Chennai',
            'correct_answer' => 'B'
        ]);

        Question::create([
            'quiz_id' => $gkQuiz->id,
            'question' => 'National animal of India?',
            'option_a' => 'Lion',
            'option_b' => 'Tiger',
            'option_c' => 'Elephant',
            'option_d' => 'Horse',
            'correct_answer' => 'B'
        ]);
    }
}