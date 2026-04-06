<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuestionService;

class QuestionController extends Controller
{
    protected $questionService;

    // Dependency Injection
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    // Show form
    public function create($quiz_id)
    {
        return view('questions.create', compact('quiz_id'));
    }

    // Store question
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required'
        ]);

        // Service call
        $this->questionService->storeQuestion($request->all());

        return back()->with('success', 'Question Added Successfully!');
    }
}