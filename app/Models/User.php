<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ExamAttempt;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nis',
        'nisn',
        'kelas',
        'no_absen',
        'tanggal_lahir',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /*
     * RELASI GURU
     */

    public function exams()
    {
        return $this->hasMany(Exam::class, 'guru_id');
    }

    /*
     * RELASI SISWA
     */

    public function answers()
    {
        return $this->hasMany(Answer::class, 'siswa_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'siswa_id');
    }

    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class, 'siswa_id');
    }

    /*
     * RELASI GURU YANG MEMBERIKAN PERSETUJUAN
     */

    public function approvedAttempts()
    {
        return $this->hasMany(
            ExamAttempt::class,
            'approved_by'
        );
    }

    /*
     * CEK ROLE
     */

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
}