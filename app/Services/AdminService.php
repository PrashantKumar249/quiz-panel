<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Question;
use App\Models\QuizAttempt;

class AdminService
{
    // =========================================================
    // DASHBOARD STATS
    // =========================================================

    /**
     * Admin dashboard ke liye saari stats ek jagah
     */
    public function getDashboardStats(): array
    {
        $totalUsers      = User::where('role', 'user')->count();
        $totalQuizzes    = Quiz::count();
        $totalQuestions  = Question::count();
        $totalAttempts   = QuizAttempt::where('status', 'completed')->count();
        $avgScore        = QuizAttempt::where('status', 'completed')->avg('score') ?? 0;
        $passCount       = QuizAttempt::where('status', 'completed')->where('score', '>=', 50)->count();
        $failCount       = QuizAttempt::where('status', 'completed')->where('score', '<', 50)->count();

        // Last 7 days attempts (chart ke liye)
        $weeklyData = QuizAttempt::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, AVG(score) as avg_score')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Quiz wise attempt count (chart ke liye)
        $quizWiseData = Quiz::withCount(['attempts' => function ($q) {
            $q->where('status', 'completed');
        }])->get();

        return compact(
            'totalUsers', 'totalQuizzes', 'totalQuestions',
            'totalAttempts', 'avgScore', 'passCount', 'failCount',
            'weeklyData', 'quizWiseData'
        );
    }

    // =========================================================
    // USER MANAGEMENT
    // =========================================================

    /**
     * Saare users (admin nahi) with unke attempt stats
     */
    public function getAllUsers()
    {
        return User::where('role', 'user')
            ->withCount('quizAttempts')
            ->with(['quizAttempts' => function ($q) {
                $q->where('status', 'completed')->latest()->limit(1);
            }])
            ->latest()
            ->get();
    }

    /**
     * User ko block karo (is_active = false)
     */
    public function toggleUserBlock(int $userId): User
    {
        $user = User::where('role', 'user')->findOrFail($userId);
        $user->update(['is_active' => !$user->is_active]);
        return $user;
    }

    /**
     * Ek user ki detail + uske saare attempts
     */
    public function getUserDetail(int $userId): User
    {
        return User::with(['quizAttempts.quiz'])
            ->where('role', 'user')
            ->findOrFail($userId);
    }

    // =========================================================
    // QUIZ RESULTS
    // =========================================================

    /**
     * Saare quizzes + unke attempt stats
     */
    public function getQuizzesWithStats()
    {
        return Quiz::withCount([
            'attempts as total_attempts'  => fn($q) => $q->where('status', 'completed'),
            'attempts as pass_count'      => fn($q) => $q->where('status', 'completed')->where('score', '>=', 50),
            'attempts as fail_count'      => fn($q) => $q->where('status', 'completed')->where('score', '<', 50),
        ])
        ->withAvg(['attempts as avg_score' => fn($q) => $q->where('status', 'completed')], 'score')
        ->latest()
        ->get();
    }

    /**
     * Ek quiz ke saare user results
     */
    public function getQuizResults(int $quizId)
    {
        return QuizAttempt::with(['user', 'quiz'])
            ->where('quiz_id', $quizId)
            ->where('status', 'completed')
            ->latest()
            ->get();
    }

    /**
     * Ek user ka ek quiz ka detailed result (answer review)
     */
    public function getAttemptDetail(int $attemptId): QuizAttempt
    {
        return QuizAttempt::with(['user', 'quiz', 'answers.question'])
            ->findOrFail($attemptId);
    }

    // =========================================================
    // QUIZ CRUD (Edit & Delete)
    // =========================================================

    /**
     * Quiz update karo
     */
    public function updateQuiz(int $quizId, array $data): Quiz
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->update($data);
        return $quiz;
    }

    /**
     * Quiz delete karo (questions + attempts sab cascade se hatenge)
     */
    public function deleteQuiz(int $quizId): void
    {
        Quiz::findOrFail($quizId)->delete();
    }
}