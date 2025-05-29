<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index() { $quizzes = Quiz::orderBy('title')->get(); return view('admin.quizzes.index', compact('quizzes')); }
    public function create() { return view('admin.quizzes.create'); }
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255', 'description' => 'nullable|string']);
        Quiz::create($request->all());
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully!');
    }
    public function show(Quiz $quiz) { /* Not typically needed */ return redirect()->route('admin.quizzes.index'); }
    public function edit(Quiz $quiz) { return view('admin.quizzes.edit', compact('quiz')); }
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate(['title' => 'required|string|max:255', 'description' => 'nullable|string']);
        $quiz->update($request->all());
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully!');
    }
    public function destroy(Quiz $quiz)
    {
        try { $quiz->delete(); return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully!'); }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('admin.quizzes.index')->with('error', 'Cannot delete quiz. It has associated questions or tutorials.');
            }
            return redirect()->route('admin.quizzes.index')->with('error', 'An error occurred while deleting the quiz.');
        }
    }
}