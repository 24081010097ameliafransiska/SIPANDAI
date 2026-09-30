<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardDataController extends Controller
{
    /**
     * GET /guru/dashboard/data
     *
     * Dipakai oleh JavaScript di dashboard.blade.php untuk polling
     * (statistik + aktivitas terbaru) tanpa reload halaman.
     * Auth memakai session biasa (middleware 'auth' web).
     */
    public function data(Request $request)
    {
        $guru = $request->user();

        $ujianGuru = Exam::where('guru_id', $guru->id);

        $rataRata = Result::whereHas('exam', fn ($q) => $q->where('guru_id', $guru->id))
            ->avg('nilai');

        $stats = [
            'ujian_aktif' => (clone $ujianGuru)->where('status', 'aktif')->count(),
            'siswa_terdaftar' => User::where('role', 'siswa')->count(),
            'ujian_selesai' => (clone $ujianGuru)->where('status', 'selesai')->count(),
            'rata_rata_nilai' => round((float) ($rataRata ?? 0), 2),
        ];

        $hasil = Result::with(['exam', 'siswa'])
            ->whereHas('exam', fn ($q) => $q->where('guru_id', $guru->id))
            ->latest('submitted_at')
            ->take(6)
            ->get()
            ->map(function ($r) {
                $waktu = $r->submitted_at ?? $r->created_at;

                return [
                    'type' => 'hasil',
                    'icon' => 'fa-solid fa-clipboard-check',
                    'title' => ($r->siswa->name ?? 'Siswa').' menyelesaikan ujian',
                    'desc' => ($r->exam->nama_ujian ?? 'Ujian').' • Nilai '.number_format((float) ($r->nilai ?? 0), 2, ',', '.'),
                    'time_human' => optional($waktu)?->locale('id')->diffForHumans(),
                    'timestamp' => optional($waktu)?->timestamp,
                ];
            });

        $ujian = Exam::where('guru_id', $guru->id)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($u) {
                $status = strtolower((string) $u->status);

                $icon = match ($status) {
                    'aktif' => 'fa-solid fa-circle-play',
                    'selesai' => 'fa-solid fa-circle-check',
                    default => 'fa-solid fa-calendar-check',
                };

                $desc = match ($status) {
                    'aktif' => 'Ujian sedang aktif dan dapat dikerjakan siswa.',
                    'selesai' => 'Ujian telah selesai.',
                    default => 'Ujian berhasil dibuat di SIPANDAI.',
                };

                return [
                    'type' => 'ujian',
                    'icon' => $icon,
                    'title' => 'Ujian "'.($u->nama_ujian ?? 'Ujian').'"',
                    'desc' => $desc,
                    'time_human' => optional($u->created_at)?->locale('id')->diffForHumans(),
                    'timestamp' => optional($u->created_at)?->timestamp,
                ];
            });

        $activities = $hasil->concat($ujian)
            ->sortByDesc('timestamp')
            ->take(5)
            ->values();

        return response()->json([
            'stats' => $stats,
            'activities' => $activities,
        ]);
    }
}