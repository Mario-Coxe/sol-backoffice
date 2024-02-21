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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(1);
            $table->foreignId('professor_id')->constrained('professores')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('disciplinas')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('turmas')->onDelete('cascade');
            $table->string('description');
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
