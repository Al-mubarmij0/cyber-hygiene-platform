<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->enum('content_type', ['text', 'image', 'video', 'mixed']); // Type of content
            $table->longText('content_text')->nullable(); // For text content
            $table->string('image_path')->nullable();    // For image file path
            $table->string('video_url')->nullable();     // For video URL (e.g., YouTube)
            $table->integer('order')->default(0); // For ordering tutorials
            $table->boolean('is_public')->default(true); // Whether it's visible on frontend
            $table->foreignId('pre_quiz_id')->nullable()->constrained('quizzes')->onDelete('set null'); // Pre-quiz link
            $table->foreignId('post_quiz_id')->nullable()->constrained('quizzes')->onDelete('set null'); // Post-quiz link
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('tutorials'); }
};