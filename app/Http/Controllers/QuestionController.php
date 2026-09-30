<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Menampilkan form tambah soal
     */
    public function create(Exam $exam)
    {
        // Pastikan ujian milik guru yang sedang login
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        return view('guru.questions.create', compact('exam'));
    }

    /**
     * Menyimpan soal baru
     */
    public function store(Request $request, Exam $exam)
    {
        // Pastikan ujian milik guru yang sedang login
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        // Validasi input
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN SOAL
        |--------------------------------------------------------------------------
        |
        | Form menggunakan:
        | pilihan_a
        | pilihan_b
        | pilihan_c
        | pilihan_d
        |
        | Database menggunakan:
        | opsi_a
        | opsi_b
        | opsi_c
        | opsi_d
        |
        */

        Question::create([
            'exam_id' => $exam->id,
            'pertanyaan' => $validated['pertanyaan'],
            'opsi_a' => $validated['pilihan_a'],
            'opsi_b' => $validated['pilihan_b'],
            'opsi_c' => $validated['pilihan_c'],
            'opsi_d' => $validated['pilihan_d'],
            'jawaban_benar' => $validated['jawaban_benar'],
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit soal
     */
    public function edit(Exam $exam, Question $question)
    {
        // Pastikan ujian milik guru yang sedang login
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan soal memang milik ujian tersebut
        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        return view(
            'guru.questions.edit',
            compact('exam', 'question')
        );
    }

    /**
     * Memperbarui soal
     */
    public function update(
        Request $request,
        Exam $exam,
        Question $question
    ) {
        // Pastikan ujian milik guru yang sedang login
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan soal memang milik ujian tersebut
        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        // Validasi
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D.',
        ]);

        // Update soal
        $question->update([
            'pertanyaan' => $validated['pertanyaan'],
            'opsi_a' => $validated['pilihan_a'],
            'opsi_b' => $validated['pilihan_b'],
            'opsi_c' => $validated['pilihan_c'],
            'opsi_d' => $validated['pilihan_d'],
            'jawaban_benar' => $validated['jawaban_benar'],
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Menghapus soal
     */
    public function destroy(
        Exam $exam,
        Question $question
    ) {
        // Pastikan ujian milik guru yang sedang login
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan soal memang milik ujian tersebut
        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        $question->delete();

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil dihapus.');
    }
}