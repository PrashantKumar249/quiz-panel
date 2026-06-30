<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Show all quizzes
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quiz.index', compact('quizzes'));
    }


    // Show create form
    public function create()
    {
        return view('quiz.create');
    }

    // Store quiz data
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'time_limit' => 'required|integer|min:1'
        ]);

        // Store data
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'time_limit' => $request->time_limit,
            'user_id' => Auth::id()
        ]);

        // Redirect with success message to the manage page directly
        return redirect()->route('admin.quiz.edit', $quiz->id)->with('success', 'Quiz Created Successfully! Now you can add questions.');
    }
}
