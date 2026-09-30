<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExamResultController extends Controller
{
    public function examList()
    {
        $guru = Auth::user();

        $exams = Exam::where('guru_id', $guru->id)
            ->withCount('results')
            ->orderByDesc('tanggal_ujian')
            ->get();

        return view('guru.results.index', compact('exams'));
    }

    public function index(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke hasil ujian ini.');
        }

        $results = $exam->results()
            ->with('siswa')
            ->orderByDesc('nilai')
            ->get();

        $answersBySiswa = Answer::where('exam_id', $exam->id)
            ->with('question')
            ->get()
            ->groupBy('siswa_id');

        $attempts = $exam->attempts()
            ->with(['siswa', 'approvedBy'])
            ->orderBy('siswa_id')
            ->orderByDesc('attempt_number')
            ->get();

        $latestAttempts = $attempts
            ->groupBy('siswa_id')
            ->map(function ($studentAttempts) {
                return $studentAttempts->first();
            });

        $results->each(function ($result) use ($latestAttempts) {
            $attempt = $latestAttempts->get($result->siswa_id);

            $result->foto_absen = $attempt?->foto_absen;
            $result->attempt_number = $attempt?->attempt_number;
            $result->attempt_status = $attempt?->status;
        });

        return view(
            'guru.results.show',
            compact(
                'exam',
                'results',
                'answersBySiswa',
                'attempts',
                'latestAttempts'
            )
        );
    }

    public function apiResults(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke hasil ujian ini.');
        }

        $results = $exam->results()
            ->with('siswa')
            ->orderByDesc('nilai')
            ->get();

        return response()->json([
            'data' => $results
        ]);
    }

    public function approveRetake(Exam $exam, User $siswa)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke ujian ini.');
        }

        if ($siswa->role !== 'siswa') {
            return back()->with(
                'error',
                'Akun yang dipilih bukan akun siswa.'
            );
        }

        $attempt = $exam->attempts()
            ->where('siswa_id', $siswa->id)
            ->orderByDesc('attempt_number')
            ->first();

        if (!$attempt) {
            return back()->with(
                'error',
                'Data percobaan ujian siswa tidak ditemukan.'
            );
        }

        if ($attempt->status !== 'submitted') {
            if ($attempt->status === 'approved') {
                return back()->with(
                    'error',
                    'Ujian ulang untuk siswa ini sudah diizinkan.'
                );
            }

            if ($attempt->status === 'active') {
                return back()->with(
                    'error',
                    'Siswa masih sedang mengerjakan ujian.'
                );
            }

            return back()->with(
                'error',
                'Siswa belum menyelesaikan ujian atau belum dapat diberikan izin ujian ulang.'
            );
        }

        $attempt->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with(
            'success',
            'Ujian ulang untuk ' . $siswa->name . ' berhasil diizinkan.'
        );
    }
}