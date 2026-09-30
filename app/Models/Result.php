<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'siswa_id',
        'jumlah_benar',
        'jumlah_salah',
        'nilai',
        'submit_type',
        'submitted_at',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'submitted_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Ujian
    |--------------------------------------------------------------------------
    */

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Siswa
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}