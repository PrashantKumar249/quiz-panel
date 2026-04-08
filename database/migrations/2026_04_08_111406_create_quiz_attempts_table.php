<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();

            // Kon user ne quiz diya
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Kaun sa quiz
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');

            // Result
            $table->integer('total_questions')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('wrong_answers')->default(0);
            $table->integer('score')->default(0); // percentage ya marks

            // Status: pending, completed
            $table->enum('status', ['pending', 'completed'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};