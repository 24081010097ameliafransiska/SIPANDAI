<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::where('guru_id', Auth::id())
            ->latest()
            ->get();

        return view('guru.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('guru.exams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'tanggal_ujian' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1',
            'kode_ujian' => [
                'nullable',
                'string',
                'max:50',
                'unique:exams,kode_ujian',
            ],
        ], [
            'nama_ujian.required' => 'Nama ujian wajib diisi.',
            'mata_pelajaran.required' => 'Mata pelajaran wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
            'tanggal_ujian.required' => 'Tanggal ujian wajib diisi.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'durasi.required' => 'Durasi ujian wajib diisi.',
            'durasi.min' => 'Durasi minimal 1 menit.',
            'kode_ujian.unique' => 'Kode ujian tersebut sudah digunakan.',
        ]);

        $jamMulai = Carbon::createFromFormat(
            'H:i',
            $validated['jam_mulai']
        );

        $jamSelesai = $jamMulai
            ->copy()
            ->addMinutes($validated['durasi']);

        $kodeUjian = $validated['kode_ujian'] ?? null;

        if (!$kodeUjian) {
            do {
                $kodeUjian = strtoupper(Str::random(6));
            } while (
                Exam::where('kode_ujian', $kodeUjian)->exists()
            );
        }

        $exam = Exam::create([
            'guru_id' => Auth::id(),
            'nama_ujian' => $validated['nama_ujian'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'kelas' => $validated['kelas'],
            'tanggal_ujian' => $validated['tanggal_ujian'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $jamSelesai->format('H:i:s'),
            'durasi' => $validated['durasi'],
            'kode_ujian' => strtoupper($kodeUjian),
            'status' => 'draft',
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with(
                'success',
                'Ujian berhasil dibuat. Silakan tambahkan soal.'
            );
    }

    public function show(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        $exam->load('questions');

        return view(
            'guru.exams.show',
            compact('exam')
        );
    }

    public function edit(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        return view(
            'guru.exams.edit',
            compact('exam')
        );
    }

    public function update(
        Request $request,
        Exam $exam
    ) {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'tanggal_ujian' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1',
            'kode_ujian' => [
                'required',
                'string',
                'max:50',
                'unique:exams,kode_ujian,' . $exam->id,
            ],
            'status' => [
                'required',
                'in:draft,aktif,selesai',
            ],
        ]);

        $jamMulai = Carbon::createFromFormat(
            'H:i',
            $validated['jam_mulai']
        );

        $jamSelesai = $jamMulai
            ->copy()
            ->addMinutes($validated['durasi']);

        $exam->update([
            'nama_ujian' => $validated['nama_ujian'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'kelas' => $validated['kelas'],
            'tanggal_ujian' => $validated['tanggal_ujian'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $jamSelesai->format('H:i:s'),
            'durasi' => $validated['durasi'],
            'kode_ujian' => strtoupper($validated['kode_ujian']),
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with(
                'success',
                'Ujian berhasil diperbarui.'
            );
    }

    public function activate(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        if ($exam->questions()->count() === 0) {
            return redirect()
                ->route('guru.exams.show', $exam)
                ->with(
                    'error',
                    'Ujian belum memiliki soal. Tambahkan soal terlebih dahulu.'
                );
        }

        $exam->update([
            'status' => 'aktif',
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with(
                'success',
                'Ujian berhasil diaktifkan. Siswa sekarang dapat mengikuti ujian menggunakan kode ujian.'
            );
    }

    public function finish(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        if ($exam->status !== 'aktif') {
            return redirect()
                ->route('guru.exams.show', $exam)
                ->with(
                    'error',
                    'Ujian belum berstatus aktif.'
                );
        }

        $exam->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with(
                'success',
                'Ujian berhasil diselesaikan.'
            );
    }

    public function destroy(Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        $exam->delete();

        return redirect()
            ->route('guru.results.index')
            ->with(
                'success',
                'Ujian berhasil dihapus.'
            );
    }
}