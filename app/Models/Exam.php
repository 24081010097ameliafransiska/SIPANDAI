<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamResult;
use App\Models\ExamAttempt;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'nama_ujian',
        'mata_pelajaran',
        'kelas',
        'tanggal_ujian',
        'jam_mulai',
        'jam_selesai',
        'durasi',
        'kode_ujian',
        'status',
    ];

    protected $casts = [
        'tanggal_ujian' => 'date',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class, 'exam_id');
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class, 'exam_id');
    }

    public function isActive()
    {
        $now = now();

        $start = $this->tanggal_ujian->copy()
            ->setTimeFromTimeString($this->jam_mulai);

        $end = $this->tanggal_ujian->copy()
            ->setTimeFromTimeString($this->jam_selesai);

        return $now->between($start, $end);
    }
}