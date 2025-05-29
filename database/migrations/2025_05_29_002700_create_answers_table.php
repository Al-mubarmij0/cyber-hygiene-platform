<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Links to questions table
            $table->text('answer_text');
            $table->boolean('is_correct')->default(false); // Indicates if this is the correct answer
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('answers'); }
};