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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('anos_letivos')->onDelete('cascade');
            $table->foreignId('responsible_professor_id')->constrained('professores')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('cursos')->onDelete('cascade');
            $table->boolean('is_active')->default(1);
            $table->string('name');
            $table->string('classroom_number')->nullable();
            $table->enum('degree', ['10ª', '11ª', '12ª', '13ª']);
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
