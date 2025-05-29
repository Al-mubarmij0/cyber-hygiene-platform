<?php

// In routes/web.php

// Core App Controllers (from Breeze)
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LearningFlowController; // Will create this later for guided learning

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\TutorialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public/Guest Routes
Route::get('/', function () {
    return view('welcome'); // Laravel's default welcome page
});

// Authenticated User Routes (Breeze default dashboard)
Route::middleware(['auth', 'verified'])->group(function () {
    // User dashboard (you can make this a specific controller later)
    Route::get('/dashboard', function () {
        return view('dashboard'); // Breeze default dashboard view
    })->name('dashboard');

    // Profile management (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Guided Learning Feature Routes ---
    Route::prefix('learn')->name('learn.')->group(function () {
        Route::get('/', [LearningFlowController::class, 'start'])->name('start');
        Route::get('/{tutorial}/pre-quiz', [LearningFlowController::class, 'showPreQuiz'])->name('pre_quiz');
        Route::post('/{tutorial}/pre-quiz', [LearningFlowController::class, 'submitPreQuiz'])->name('submit_pre_quiz');
        Route::get('/{tutorial}/content', [LearningFlowController::class, 'showTutorialContent'])->name('content');
        Route::post('/{tutorial}/complete-tutorial', [LearningFlowController::class, 'completeTutorial'])->name('complete_tutorial');
        Route::get('/{tutorial}/post-quiz', [LearningFlowController::class, 'showPostQuiz'])->name('post_quiz');
        Route::post('/{tutorial}/post-quiz', [LearningFlowController::class, 'submitPostQuiz'])->name('submit_post_quiz');
        Route::get('/{tutorial}/results', [LearningFlowController::class, 'showResults'])->name('results');
    });
});

// Admin Panel Routes (Requires 'auth' and an 'admin' role/middleware - we'll simulate 'admin' for now)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Resource routes for Admin CRUD
    Route::resource('quizzes', QuizController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('answers', AnswerController::class);
    Route::resource('tutorials', TutorialController::class);
});


require __DIR__.'/auth.php'; // Breeze authentication routes