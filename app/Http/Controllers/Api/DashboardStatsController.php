<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardStatsController extends Controller
{
    /**
     * GET /api/dashboard/stats
     * Ringkasan angka: ujian aktif, siswa terdaftar, ujian selesai, rata-rata nilai.
     */
    public function index(Request $request)
    {
        $guru = $request->user();

        $ujianGuru = Exam::where('guru_id', $guru->id);

        $statRata = Result::whereHas('exam', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->avg('nilai');

        return response()->json([
            'data' => [
                'ujian_aktif' => (clone $ujianGuru)->where('status', 'aktif')->count(),
                'siswa_terdaftar' => User::where('role', 'siswa')->count(),
                'ujian_selesai' => (clone $ujianGuru)->where('status', 'selesai')->count(),
                'rata_rata_nilai' => $statRata !== null ? round((float) $statRata, 2) : 0,
            ],
        ]);
    }

    /**
     * GET /api/dashboard/activities?limit=5
     * Gabungan aktivitas terbaru (hasil ujian masuk + ujian baru dibuat).
     */
    public function activities(Request $request)
    {
        $guru = $request->user();
        $limit = (int) $request->query('limit', 5);

        $hasil = Result::with(['exam', 'siswa'])
            ->whereHas('exam', fn ($q) => $q->where('guru_id', $guru->id))
            ->latest('submitted_at')
            ->take(6)
            ->get()
            ->map(function ($r) {
                $waktu = $r->submitted_at ?? $r->created_at;

                return [
                    'type' => 'hasil',
                    'title' => ($r->siswa->name ?? 'Siswa').' menyelesaikan ujian',
                    'desc' => ($r->exam->nama_ujian ?? 'Ujian').' • Nilai '.number_format((float) ($r->nilai ?? 0), 2, ',', '.'),
                    'time' => optional($waktu)->toIso8601String(),
                    'timestamp' => optional($waktu)->timestamp,
                ];
            });

        $ujian = Exam::where('guru_id', $guru->id)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($u) {
                return [
                    'type' => 'ujian',
                    'title' => 'Ujian "'.($u->nama_ujian ?? 'Ujian').'"',
                    'desc' => 'Status: '.$u->status,
                    'time' => optional($u->created_at)->toIso8601String(),
                    'timestamp' => optional($u->created_at)->timestamp,
                ];
            });

        $activities = $hasil->concat($ujian)
            ->sortByDesc('timestamp')
            ->take($limit)
            ->values();

        return response()->json(['data' => $activities]);
    }
}