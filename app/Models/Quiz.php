<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];
    public function questions() { return $this->hasMany(Question::class); }
    public function tutorialsAsPreQuiz() { return $this->hasMany(Tutorial::class, 'pre_quiz_id'); }
    public function tutorialsAsPostQuiz() { return $this->hasMany(Tutorial::class, 'post_quiz_id'); }
    public function userAttempts() { return $this->hasMany(UserQuizAttempt::class); }
}