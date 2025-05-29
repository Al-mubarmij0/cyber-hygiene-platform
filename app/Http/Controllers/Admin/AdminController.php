<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Constructor for middleware (e.g., to check if user is an admin)
    public function __construct()
    {
        // $this->middleware('admin'); // Uncomment when you have an 'admin' middleware or role check
    }

    public function index()
    {
        $tutorialCount = Tutorial::count();
        $quizCount = Quiz::count();
        $questionCount = Question::count();
        $answerCount = Answer::count();
        return view('admin.dashboard', compact('tutorialCount', 'quizCount', 'questionCount', 'answerCount'));
    }
}