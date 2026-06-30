<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserQuizController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| User Routes — Dashboard + Quiz Flow + History
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // STEP 2 & 3: Dashboard — available quizzes dikhao
    Route::get('/dashboard', [UserQuizController::class, 'dashboard'])
        ->name('dashboard');

    // STEP 4 & 5: Quiz Start karo
    Route::post('/user/quiz/{quizId}/start', [UserQuizController::class, 'startQuiz'])
        ->name('user.quiz.start');

    // STEP 6: Quiz Attempt Page (questions + timer)
    Route::get('/user/quiz/attempt/{attemptId}', [UserQuizController::class, 'attemptPage'])
        ->name('user.quiz.attempt');

    // STEP 7: Quiz Submit
    Route::post('/user/quiz/submit', [UserQuizController::class, 'submitQuiz'])
        ->name('user.quiz.submit');

    // STEP 7 Result: Result Page
    Route::get('/user/quiz/result/{attemptId}', [UserQuizController::class, 'resultPage'])
        ->name('user.quiz.result');

    // STEP 8: History
    Route::get('/user/history', [UserQuizController::class, 'history'])
        ->name('user.history');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Dashboard + Quiz + Questions + Users + Results)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ---- Quiz Management ----
    Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/list', [AdminController::class, 'quizList'])->name('quiz.list');
    Route::get('/quiz/{id}/edit', [AdminController::class, 'editQuiz'])->name('quiz.edit');
    Route::post('/quiz/{id}/update', [AdminController::class, 'updateQuiz'])->name('quiz.update');
    Route::get('/quiz/{id}/delete', [AdminController::class, 'deleteQuiz'])->name('quiz.delete');

    // ---- Question Management ---- (specific before dynamic)
    Route::get('/questions/create/{quiz_id}', [QuestionController::class, 'create'])->name('questions.create');
    Route::get('/questions/edit/{id}', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::get('/questions/delete/{id}', [QuestionController::class, 'destroy'])->name('questions.delete');
    Route::post('/questions/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/questions/update/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::get('/questions/{quiz_id}', [QuestionController::class, 'index'])->name('questions.index');

    // ---- User Management ----
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}', [AdminController::class, 'userDetail'])->name('user.detail');
    Route::post('/users/{id}/toggle-block', [AdminController::class, 'toggleBlock'])->name('user.toggle-block');

    // ---- Results ---- (specific before dynamic)
    Route::get('/results', [AdminController::class, 'results'])->name('results');
    Route::get('/results/attempt/{attemptId}', [AdminController::class, 'attemptDetail'])->name('attempt.detail');
    Route::get('/results/{quizId}', [AdminController::class, 'quizResults'])->name('quiz.results');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login/Register)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';