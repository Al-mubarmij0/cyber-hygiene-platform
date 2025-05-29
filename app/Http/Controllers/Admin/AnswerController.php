<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question; // Needed for dropdown
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index() { $answers = Answer::with('question')->orderBy('id', 'desc')->get(); return view('admin.answers.index', compact('answers')); }
    public function create() { $questions = Question::orderBy('question_text')->get(); return view('admin.answers.create', compact('questions')); }
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_text' => 'required|string',
            'is_correct' => 'boolean', // Will be 0 or 1 if checkbox
        ]);
        Answer::create([
            'question_id' => $request->question_id,
            'answer_text' => $request->answer_text,
            'is_correct' => $request->has('is_correct'), // Check if checkbox was ticked
        ]);
        return redirect()->route('admin.answers.index')->with('success', 'Answer created successfully!');
    }
    public function show(Answer $answer) { /* Not typically needed */ return redirect()->route('admin.answers.index'); }
    public function edit(Answer $answer) { $questions = Question::orderBy('question_text')->get(); return view('admin.answers.edit', compact('answer', 'questions')); }
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_text' => 'required|string',
            'is_correct' => 'boolean',
        ]);
        $answer->update([
            'question_id' => $request->question_id,
            'answer_text' => $request->answer_text,
            'is_correct' => $request->has('is_correct'),
        ]);
        return redirect()->route('admin.answers.index')->with('success', 'Answer updated successfully!');
    }
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect()->route('admin.answers.index')->with('success', 'Answer deleted successfully!');
    }
}