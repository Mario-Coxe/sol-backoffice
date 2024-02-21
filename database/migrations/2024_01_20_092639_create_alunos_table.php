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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(1);
            $table->string('name');
            $table->string('bi');
            $table->enum('sex', ['Masculino', 'Femenino']);
            $table->string('address');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->foreignId('class_id')->constrained('turmas')->onDelete('cascade');
            $table->foreignId('incharge_id')->constrained('encarregados')->onDelete('cascade');
            $table->enum('relationship', [
                'Pai',
                'Mãe',
                'Avô',
                'Tio',
                'Tia',
                'Padrasto',
                'Madrasta',
                'Irmão',
                'Irmã',
                'Outro',
            ]);

            $table->string('photo')->default('student-images/default.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
