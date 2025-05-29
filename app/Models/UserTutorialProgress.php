<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserTutorialProgress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'tutorial_id', 'completed', 'completed_at'];
    protected $casts = ['completed' => 'boolean', 'completed_at' => 'datetime'];
    public function user() { return $this->belongsTo(User::class); }
    public function tutorial() { return $this->belongsTo(Tutorial::class); }
}