<?php

namespace App\Http\Controllers;

use App\Services\UserQuizService;
use Illuminate\Http\Request;

class UserQuizController extends Controller
{
    protected UserQuizService $userQuizService;

    // Service inject hoga automatically (Laravel DI)
    public function __construct(UserQuizService $userQuizService)
    {
        $this->userQuizService = $userQuizService;
    }

    /**
     * STEP 2 & 3: User Dashboard — available quizzes dikhao
     * Route: GET /dashboard
     */
    public function dashboard()
    {
        $quizzes = $this->userQuizService->getAvailableQuizzes();

        return view('user.dashboard', compact('quizzes'));
    }

    /**
     * STEP 4 & 5: Quiz Start karo
     * Route: POST /user/quiz/{quizId}/start
     */
    public function startQuiz(int $quizId)
    {
        $attempt = $this->userQuizService->startQuiz($quizId);

        // Quiz attempt page par redirect karo
        return redirect()->route('user.quiz.attempt', $attempt->id);
    }

    /**
     * STEP 6: Quiz Attempt Page — questions dikhao with timer
     * Route: GET /user/quiz/attempt/{attemptId}
     */
    public function attemptPage(int $attemptId)
    {
        $attempt = $this->userQuizService->getQuizForAttempt($attemptId);

        return view('user.quiz-attempt', compact('attempt'));
    }

    /**
     * STEP 7: Quiz Submit karo
     * Route: POST /user/quiz/submit
     */
    public function submitQuiz(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|integer',
            'answers'    => 'nullable|array',  // answers optional (time out bhi ho sakta hai)
        ]);

        $attempt = $this->userQuizService->submitQuiz(
            $request->attempt_id,
            $request->answers ?? []
        );

        // Result page par redirect karo
        return redirect()->route('user.quiz.result', $attempt->id);
    }

    /**
     * STEP 7 Result: Result dikhao
     * Route: GET /user/quiz/result/{attemptId}
     */
    public function resultPage(int $attemptId)
    {
        $attempt = $this->userQuizService->getAttemptResult($attemptId);

        return view('user.quiz-result', compact('attempt'));
    }

    /**
     * STEP 8: User History — saari attempts dikhao
     * Route: GET /user/history
     */
    public function history()
    {
        $history = $this->userQuizService->getUserHistory();

        return view('user.history', compact('history'));
    }
}