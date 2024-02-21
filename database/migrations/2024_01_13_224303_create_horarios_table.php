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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('turmas')->onDelete('cascade');
            $table->foreignId('subjet_id')->constrained('disciplinas')->onDelete('cascade');
            $table->boolean('is_active')->default(1);
            $table->string('day_of_week');
            $table->string("start_time");
            $table->string("end_time");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};