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

            // Ujian
            $table->foreignId('exam_id')
                  ->constrained('exams')
                  ->cascadeOnDelete();

            // Siswa
            $table->foreignId('siswa_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Soal
            $table->foreignId('question_id')
                  ->constrained('questions')
                  ->cascadeOnDelete();

            // Jawaban siswa
            $table->enum('jawaban', [
                'A',
                'B',
                'C',
                'D'
            ])->nullable();

            // Apakah benar?
            $table->boolean('benar')->default(false);

            // Nilai soal
            $table->integer('nilai')->default(0);

            $table->timestamps();

            // Satu siswa tidak boleh memiliki
            // dua jawaban untuk soal yang sama
            $table->unique([
                'exam_id',
                'siswa_id',
                'question_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};