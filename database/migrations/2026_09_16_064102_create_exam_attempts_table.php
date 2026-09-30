<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();

            // Ujian yang diikuti
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            // Siswa yang mengikuti
            $table->foreignId('siswa_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Percobaan keberapa
            $table->unsignedInteger('attempt_number')->default(1);

            // Status percobaan
            $table->enum('status', [
                'active',
                'submitted',
                'waiting_approval',
                'approved',
            ])->default('active');

            // Waktu mulai dan selesai
            $table->dateTime('started_at')->nullable();
            $table->dateTime('submitted_at')->nullable();

            // Guru yang memberikan izin ujian ulang
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Waktu persetujuan
            $table->dateTime('approved_at')->nullable();

            $table->timestamps();

            // Satu siswa boleh punya banyak percobaan,
            // tetapi nomor percobaan dalam satu ujian harus unik.
            $table->unique(
                ['exam_id', 'siswa_id', 'attempt_number'],
                'exam_siswa_attempt_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};