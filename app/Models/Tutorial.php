<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tutorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'summary', 'content_type',
        'content_text', 'image_path', 'video_url', 'order', 'is_public',
        'pre_quiz_id', 'post_quiz_id',
    ];
    protected $casts = ['is_public' => 'boolean']; // Cast to boolean
    public function preQuiz() { return $this->belongsTo(Quiz::class, 'pre_quiz_id'); }
    public function postQuiz() { return $this->belongsTo(Quiz::class, 'post_quiz_id'); }
    public function userProgress() { return $this->hasMany(UserTutorialProgress::class); }
}