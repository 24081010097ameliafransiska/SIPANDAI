<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'pertanyaan',

        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',

        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',

        'jawaban_benar',
        'bobot',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}