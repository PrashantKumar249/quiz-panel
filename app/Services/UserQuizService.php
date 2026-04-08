<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use Illuminate\Support\Facades\Auth;

class UserQuizService
{
    /**
     * STEP 3: User dashboard ke liye saare available quizzes laao
     * (sirf wahi quiz dikhenge jisme questions hain)
     */
    public function getAvailableQuizzes()
    {
        return Quiz::withCount('questions')
            ->having('questions_count', '>', 0)
            ->get();
    }

    /**
     * STEP 5: Quiz start karo — ek naya attempt record banao (pending)
     * Agar user pehle se attempt kar chuka hai completed, toh naya banao
     */
    public function startQuiz(int $quizId): QuizAttempt
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        // Naya attempt banao
        $attempt = QuizAttempt::create([
            'user_id'          => Auth::id(),
            'quiz_id'          => $quizId,
            'total_questions'  => $quiz->questions->count(),
            'correct_answers'  => 0,
            'wrong_answers'    => 0,
            'score'            => 0,
            'status'           => 'pending',
        ]);

        return $attempt;
    }

    /**
     * STEP 7: Quiz submit karo
     * User ke selected answers process karo, score calculate karo
     *
     * $answers = ['question_id' => 'selected_option', ...]
     * Example: [1 => 'A', 2 => 'C', 3 => 'B']
     */
    public function submitQuiz(int $attemptId, array $answers): QuizAttempt
    {
        $attempt = QuizAttempt::with('quiz.questions')->findOrFail($attemptId);

        // Sirf pending attempt submit ho sakti hai
        if ($attempt->status === 'completed') {
            return $attempt;
        }

        $correct = 0;
        $wrong   = 0;

        foreach ($attempt->quiz->questions as $question) {
            $selected  = $answers[$question->id] ?? null;
            $isCorrect = ($selected !== null && strtoupper($selected) === strtoupper($question->correct_answer));

            // Har question ka answer save karo
            QuizAttemptAnswer::create([
                'quiz_attempt_id' => $attempt->id,
                'question_id'     => $question->id,
                'selected_option' => $selected,
                'is_correct'      => $isCorrect,
            ]);

            if ($isCorrect) {
                $correct++;
            } else {
                $wrong++;
            }
        }

        // Score = (correct / total) * 100
        $total = $attempt->total_questions;
        $score = $total > 0 ? round(($correct / $total) * 100) : 0;

        // Attempt update karo
        $attempt->update([
            'correct_answers' => $correct,
            'wrong_answers'   => $wrong,
            'score'           => $score,
            'status'          => 'completed',
        ]);

        return $attempt->fresh();
    }

    /**
     * STEP 8: User ki quiz history laao (saari completed attempts)
     */
    public function getUserHistory()
    {
        return QuizAttempt::with('quiz')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->latest()
            ->get();
    }

    /**
     * Ek specific attempt ka result laao (result page ke liye)
     */
    public function getAttemptResult(int $attemptId): QuizAttempt
    {
        return QuizAttempt::with(['quiz', 'answers.question'])
            ->where('user_id', Auth::id()) // security: sirf apna result
            ->findOrFail($attemptId);
    }

    /**
     * Quiz attempt ke saath questions laao (attempt page ke liye)
     */
    public function getQuizForAttempt(int $attemptId): QuizAttempt
    {
        return QuizAttempt::with(['quiz.questions'])
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($attemptId);
    }
}