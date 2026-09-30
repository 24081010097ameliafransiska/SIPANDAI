<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            // Guru yang membuat ujian
            $table->foreignId('guru_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Informasi ujian
            $table->string('nama_ujian');
            $table->string('mata_pelajaran');
            $table->string('kelas');

            // Jadwal ujian
            $table->date('tanggal_ujian');
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // Durasi dalam menit
            $table->integer('durasi');

            // Kode yang dimasukkan siswa
            $table->string('kode_ujian')->unique();

            // Status ujian
            $table->enum('status', [
                'draft',
                'aktif',
                'selesai'
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};