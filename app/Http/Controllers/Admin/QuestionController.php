<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz; // Needed for dropdown
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index() { $questions = Question::with('quiz')->orderBy('id', 'desc')->get(); return view('admin.questions.index', compact('questions')); }
    public function create() { $quizzes = Quiz::orderBy('title')->get(); return view('admin.questions.create', compact('quizzes')); }
    public function store(Request $request)
    {
        $request->validate(['quiz_id' => 'required|exists:quizzes,id', 'question_text' => 'required|string']);
        Question::create($request->all());
        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully!');
    }
    public function show(Question $question) { /* Not typically needed */ return redirect()->route('admin.questions.index'); }
    public function edit(Question $question) { $quizzes = Quiz::orderBy('title')->get(); return view('admin.questions.edit', compact('question', 'quizzes')); }
    public function update(Request $request, Question $question)
    {
        $request->validate(['quiz_id' => 'required|exists:quizzes,id', 'question_text' => 'required|string']);
        $question->update($request->all());
        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully!');
    }
    public function destroy(Question $question)
    {
        try { $question->delete(); return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully!'); }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('admin.questions.index')->with('error', 'Cannot delete question. It has associated answers.');
            }
            return redirect()->route('admin.questions.index')->with('error', 'An error occurred while deleting the question.');
        }
    }
}