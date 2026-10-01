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
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        Question::create([
            'exam_id' => $exam->id,
            'pertanyaan' => $validated['pertanyaan'],
            'pilihan_a' => $validated['pilihan_a'],
            'pilihan_b' => $validated['pilihan_b'],
            'pilihan_c' => $validated['pilihan_c'],
            'pilihan_d' => $validated['pilihan_d'],
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

        return view('guru.questions.edit', compact('exam', 'question'));
    }

    public function update(Request $request, Exam $exam, Question $question)
    {
        if ($exam->guru_id !== Auth::id()) {
            abort(403);
        }

        if ($question->exam_id !== $exam->id) {
            abort(404);
        }

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $question->update([
            'pertanyaan' => $validated['pertanyaan'],
            'pilihan_a' => $validated['pilihan_a'],
            'pilihan_b' => $validated['pilihan_b'],
            'pilihan_c' => $validated['pilihan_c'],
            'pilihan_d' => $validated['pilihan_d'],
            'jawaban_benar' => $validated['jawaban_benar'],
        ]);

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Exam $exam, Question $question)
    {
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