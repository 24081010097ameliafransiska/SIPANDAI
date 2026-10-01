<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create(Exam $exam)
    {
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        return view('guru.questions.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'opsi_a.required' => 'Opsi A wajib diisi.',
            'opsi_b.required' => 'Opsi B wajib diisi.',
            'opsi_c.required' => 'Opsi C wajib diisi.',
            'opsi_d.required' => 'Opsi D wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D.',
        ]);

        Question::create([
            'exam_id' => $exam->id,
            'pertanyaan' => $validated['pertanyaan'],
            'opsi_a' => $validated['opsi_a'],
            'opsi_b' => $validated['opsi_b'],
            'opsi_c' => $validated['opsi_c'],
            'opsi_d' => $validated['opsi_d'],
            'jawaban_benar' => $validated['jawaban_benar'],
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Exam $exam, Question $question)
    {
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        return view(
            'guru.questions.edit',
            compact('exam', 'question')
        );
    }

    public function update(
        Request $request,
        Exam $exam,
        Question $question
    ) {
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'opsi_a.required' => 'Opsi A wajib diisi.',
            'opsi_b.required' => 'Opsi B wajib diisi.',
            'opsi_c.required' => 'Opsi C wajib diisi.',
            'opsi_d.required' => 'Opsi D wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D.',
        ]);

        $question->update([
            'pertanyaan' => $validated['pertanyaan'],
            'opsi_a' => $validated['opsi_a'],
            'opsi_b' => $validated['opsi_b'],
            'opsi_c' => $validated['opsi_c'],
            'opsi_d' => $validated['opsi_d'],
            'jawaban_benar' => $validated['jawaban_benar'],
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(
        Exam $exam,
        Question $question
    ) {
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        $question->delete();

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil dihapus.');
    }
}