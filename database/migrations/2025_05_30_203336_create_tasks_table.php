<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('notes')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamp('deadline')->nullable();
            $table->json('subtasks')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'completed']);
            $table->index(['user_id', 'deadline']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};