<?php

namespace App\Http\Controllers;
use App\Models\Tutorial;
use App\Models\Quiz;
use App\Models\UserQuizAttempt;
use App\Models\UserTutorialProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningFlowController extends Controller
{
    /**
     * Starts the learning flow by selecting a tutorial.
     */
    public function start()
    {
        // Option 1: Select a random public tutorial that has a pre-quiz assigned
        $tutorial = Tutorial::where('is_public', true)
                            ->whereNotNull('pre_quiz_id')
                            ->inRandomOrder()
                            ->first();

        // Fallback: If no tutorials with pre-quizzes, just pick any public tutorial
        if (!$tutorial) {
            $tutorial = Tutorial::where('is_public', true)->inRandomOrder()->first();
        }

        if (!$tutorial) {
            return redirect()->route('dashboard')->with('info', 'No tutorials available for a guided learning path right now.');
        }

        // Redirect to the pre-quiz if available, otherwise directly to content
        if ($tutorial->pre_quiz_id) {
            return redirect()->route('learn.pre_quiz', $tutorial);
        } else {
            return redirect()->route('learn.content', $tutorial)->with('info', 'This tutorial does not have a pre-quiz assigned.');
        }
    }

    /**
     * Displays the pre-quiz for a specific tutorial.
     */
    public function showPreQuiz(Tutorial $tutorial)
    {
        if (!$tutorial->preQuiz) {
            return redirect()->route('learn.content', $tutorial)->with('info', 'This tutorial does not have a pre-quiz assigned.');
        }

        $quiz = $tutorial->preQuiz->load('questions.answers');
        return view('learning.pre_quiz', compact('tutorial', 'quiz'));
    }

    /**
     * Handles submission of the pre-quiz.
     */
    public function submitPreQuiz(Request $request, Tutorial $tutorial)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer',
        ]);

        $score = 0;
        $totalQuestions = $tutorial->preQuiz->questions->count();

        foreach ($tutorial->preQuiz->questions as $question) {
            $correctAnswer = $question->answers->where('is_correct', true)->first();
            $correctAnswerId = $correctAnswer ? $correctAnswer->id : null;
            $userAnswerId = $request->input('answers.' . $question->id);

            if ($userAnswerId == $correctAnswerId) {
                $score++;
            }
        }

        // Store quiz attempt
        UserQuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $tutorial->preQuiz->id,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'type' => 'pre',
        ]);

        return redirect()->route('learn.content', $tutorial)->with('pre_quiz_score', $score);
    }

    /**
     * Displays the tutorial content.
     */
    public function showTutorialContent(Tutorial $tutorial)
    {
        return view('learning.tutorial_content', compact('tutorial'));
    }

    /**
     * Marks tutorial as complete and proceeds.
     */
    public function completeTutorial(Request $request, Tutorial $tutorial)
    {
        // Mark tutorial as completed for the user
        UserTutorialProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'tutorial_id' => $tutorial->id],
            ['completed' => true, 'completed_at' => now()]
        );

        if ($tutorial->postQuiz) {
            return redirect()->route('learn.post_quiz', $tutorial);
        }

        return redirect()->route('learn.results', $tutorial)->with('info', 'Tutorial completed! No post-quiz assigned.');
    }

    /**
     * Displays the post-quiz for a specific tutorial.
     */
    public function showPostQuiz(Tutorial $tutorial)
    {
        if (!$tutorial->postQuiz) {
            return redirect()->route('learn.results', $tutorial)->with('info', 'This tutorial does not have a post-quiz assigned.');
        }

        $quiz = $tutorial->postQuiz->load('questions.answers');
        return view('learning.post_quiz', compact('tutorial', 'quiz'));
    }

    /**
     * Handles submission of the post-quiz.
     */
    public function submitPostQuiz(Request $request, Tutorial $tutorial)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer',
        ]);

        $score = 0;
        $totalQuestions = $tutorial->postQuiz->questions->count();

        foreach ($tutorial->postQuiz->questions as $question) {
            $correctAnswer = $question->answers->where('is_correct', true)->first();
            $correctAnswerId = $correctAnswer ? $correctAnswer->id : null;
            $userAnswerId = $request->input('answers.' . $question->id);

            if ($userAnswerId == $correctAnswerId) {
                $score++;
            }
        }

        // Store quiz attempt
        UserQuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $tutorial->postQuiz->id,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'type' => 'post',
        ]);

        return redirect()->route('learn.results', $tutorial)->with('post_quiz_score', $score);
    }

    /**
     * Displays the learning outcome/results for a tutorial.
     */
    public function showResults(Tutorial $tutorial)
    {
        $preQuizScore = session('pre_quiz_score');
        $postQuizScore = session('post_quiz_score');

        return view('learning.results', compact('tutorial', 'preQuizScore', 'postQuizScore'));
    }
}