<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Models\Quiz;
use App\Models\Question;

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
| Dashboard (User)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Dashboard + Quiz + Questions)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // ✅ Admin Dashboard (STEP 1)
    Route::get('/admin/dashboard', function () {
        $quizCount = Quiz::count();
        $questionCount = Question::count();

        return view('admin.dashboard', compact('quizCount', 'questionCount'));
    });
    // Quiz
    Route::get('/quiz/create', [QuizController::class, 'create']);
    Route::post('/quiz/store', [QuizController::class, 'store']);
    Route::get('/quiz/list', [QuizController::class, 'index']);

    // Questions - Create & Store
    Route::get('/questions/create/{quiz_id}', [QuestionController::class, 'create']);
    Route::post('/questions/store', [QuestionController::class, 'store']);

    // Questions - List
    Route::get('/questions/{quiz_id}', [QuestionController::class, 'index']);

    // Questions - Edit / Update / Delete
    Route::get('/questions/edit/{id}', [QuestionController::class, 'edit']);
    Route::post('/questions/update/{id}', [QuestionController::class, 'update']);
    Route::get('/questions/delete/{id}', [QuestionController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login/Register)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
