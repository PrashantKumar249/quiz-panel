<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuestionService;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    protected $questionService;

    // Dependency Injection
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    // Show add form
    public function create($quiz_id)
    {
        return view('questions.create', compact('quiz_id'));
    }

    // Store question
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required'
        ]);

        $data = $request->only([
            'quiz_id',
            'question',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'correct_answer'
        ]);

        $this->questionService->storeQuestion($data);

        return back()->with('success', 'Question Added Successfully!');
    }

    // Show all questions of a quiz
    public function index($quiz_id)
    {
        return redirect()->route('admin.quiz.edit', $quiz_id);
    }

    // Show edit form
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('questions.edit', compact('question'));
    }

    // Update question
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'question',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'correct_answer'
        ]);

        $this->questionService->updateQuestion($id, $data);

        return redirect()->route('admin.quiz.edit', $request->quiz_id)
            ->with('success', 'Question Updated Successfully!');
    }

    // Delete question
    public function destroy($id)
    {
        $this->questionService->deleteQuestion($id);

        return back()->with('success', 'Question Deleted Successfully!');
    }
}