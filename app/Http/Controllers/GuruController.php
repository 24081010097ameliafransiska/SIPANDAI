<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function dashboard()
    {
        $guru = Auth::user();

        $ujian = Exam::where('guru_id', $guru->id)
            ->with([
                'results' => function ($query) {
                    $query->with('siswa')
                        ->orderByDesc('nilai');
                }
            ])
            ->withCount('results')
            ->latest()
            ->get();

        $hasilUjian = $ujian
            ->flatMap(function ($exam) {
                return $exam->results->map(function ($result) use ($exam) {
                    $result->nama_ujian = $exam->nama_ujian;
                    $result->mata_pelajaran = $exam->mata_pelajaran;
                    $result->kelas = $exam->kelas;

                    return $result;
                });
            })
            ->sortByDesc('created_at')
            ->values();

        $exam = $ujian->first();

        return view(
            'guru.dashboard',
            compact(
                'guru',
                'ujian',
                'hasilUjian',
                'exam'
            )
        );
    }
}