<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Nama lengkap pengguna
            $table->string('name');

            // Email hanya untuk guru
            $table->string('email')->nullable()->unique();

            // NISN hanya untuk siswa
            $table->string('nisn')->nullable()->unique();

            // Tanggal lahir siswa
            $table->date('tanggal_lahir')->nullable();

            // Password masih disimpan untuk kebutuhan
            // autentikasi internal Laravel
            $table->string('password')->nullable();

            // Role pengguna
            $table->enum('role', ['guru', 'siswa'])->default('siswa');

            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};