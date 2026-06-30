<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    // =========================================================
    // DASHBOARD
    // =========================================================

    /**
     * Admin Dashboard — stats + charts
     * Route: GET /admin/dashboard
     */
    public function dashboard()
    {
        $stats = $this->adminService->getDashboardStats();
        return view('admin.dashboard', $stats);
    }

    // =========================================================
    // USER MANAGEMENT
    // =========================================================

    /**
     * Saare users ki list
     * Route: GET /admin/users
     */
    public function users()
    {
        $users = $this->adminService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    /**
     * User ko block/unblock karo
     * Route: POST /admin/users/{id}/toggle-block
     */
    public function toggleBlock(int $id)
    {
        $user = $this->adminService->toggleUserBlock($id);
        $status = $user->is_active ? 'Unblocked' : 'Blocked';
        return back()->with('success', "User $status successfully!");
    }

    /**
     * Ek user ki detail — saare attempts
     * Route: GET /admin/users/{id}
     */
    public function userDetail(int $id)
    {
        $user = $this->adminService->getUserDetail($id);
        return view('admin.users.detail', compact('user'));
    }

    // =========================================================
    // QUIZ RESULTS
    // =========================================================

    /**
     * Saare quizzes + stats (pass/fail/avg)
     * Route: GET /admin/results
     */
    public function results()
    {
        $quizzes = $this->adminService->getQuizzesWithStats();
        return view('admin.results.index', compact('quizzes'));
    }

    /**
     * Ek quiz ke saare user results
     * Route: GET /admin/results/{quizId}
     */
    public function quizResults(int $quizId)
    {
        $attempts = $this->adminService->getQuizResults($quizId);
        $quiz = Quiz::findOrFail($quizId);
        return view('admin.results.quiz-results', compact('attempts', 'quiz'));
    }

    /**
     * Ek attempt ka poora answer review
     * Route: GET /admin/results/attempt/{attemptId}
     */
    public function attemptDetail(int $attemptId)
    {
        $attempt = $this->adminService->getAttemptDetail($attemptId);
        return view('admin.results.attempt-detail', compact('attempt'));
    }

    // =========================================================
    // QUIZ EDIT & DELETE
    // =========================================================

    /**
     * Saare quizzes list (manage page)
     * Route: GET /admin/quiz/list
     */
    public function quizList()
    {
        $quizzes = Quiz::latest()->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    /**
     * Quiz edit form
     * Route: GET /admin/quiz/{id}/edit
     */
    public function editQuiz(int $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Quiz update karo
     * Route: POST /admin/quiz/{id}/update
     */
    public function updateQuiz(Request $request, int $id)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'time_limit' => 'required|integer|min:1',
        ]);

        $this->adminService->updateQuiz($id, $request->only('title', 'description', 'time_limit'));

        return redirect()->route('admin.quiz.list')->with('success', 'Quiz updated successfully!');
    }

    /**
     * Quiz delete karo
     * Route: GET /admin/quiz/{id}/delete
     */
    public function deleteQuiz(int $id)
    {
        $this->adminService->deleteQuiz($id);
        return redirect()->route('admin.quiz.list')->with('success', 'Quiz deleted successfully!');
    }
}