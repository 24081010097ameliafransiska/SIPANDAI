<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    
    public function store(Request $request, Exam $exam)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        if ($request->has('questions')) {

            $questions = $request->input('questions');

            if (!is_array($questions) || count($questions) < 1) {
                return response()->json([
                    'message' => 'Minimal harus ada 1 soal.'
                ], 422);
            }

            if (count($questions) > 100) {
                return response()->json([
                    'message' => 'Maksimal 100 soal dalam sekali simpan.'
                ], 422);
            }

            $validatedQuestions = [];

            foreach ($questions as $index => $question) {

                $number = $index + 1;

                if (!is_array($question)) {
                    return response()->json([
                        'message' => "Data soal nomor {$number} tidak valid."
                    ], 422);
                }

                $validated = validator($question, [
                    'pertanyaan' => ['required', 'string'],
                    'pilihan_a' => ['required', 'string'],
                    'pilihan_b' => ['required', 'string'],
                    'pilihan_c' => ['required', 'string'],
                    'pilihan_d' => ['required', 'string'],
                    'jawaban_benar' => ['required', 'in:A,B,C,D'],
                ])->validate();

                $validatedQuestions[] = $validated;
            }

            DB::transaction(function () use ($exam, $validatedQuestions) {

                foreach ($validatedQuestions as $data) {

                    
                    $question = new Question();

                    $question->exam_id = $exam->id;
                    $question->pertanyaan = $data['pertanyaan'];
                    $question->pilihan_a = $data['pilihan_a'];
                    $question->pilihan_b = $data['pilihan_b'];
                    $question->pilihan_c = $data['pilihan_c'];
                    $question->pilihan_d = $data['pilihan_d'];
                    $question->jawaban_benar = strtoupper($data['jawaban_benar']);

                    $question->save();
                }
            });

            return response()->json([
                'success' => true,
                'message' => count($validatedQuestions) . ' soal berhasil disimpan.',
                'count' => count($validatedQuestions),
            ]);
        }

        
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string'],
            'pilihan_a' => ['required', 'string'],
            'pilihan_b' => ['required', 'string'],
            'pilihan_c' => ['required', 'string'],
            'pilihan_d' => ['required', 'string'],
            'jawaban_benar' => ['required', 'in:A,B,C,D'],
        ]);

        $question = new Question();
        $question->exam_id = $exam->id;
        $question->pertanyaan = $validated['pertanyaan'];
        $question->pilihan_a = $validated['pilihan_a'];
        $question->pilihan_b = $validated['pilihan_b'];
        $question->pilihan_c = $validated['pilihan_c'];
        $question->pilihan_d = $validated['pilihan_d'];
        $question->jawaban_benar = strtoupper($validated['jawaban_benar']);
        $question->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil ditambahkan.',
                'id' => $question->id,
            ]);
        }

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    
    public function edit(Exam $exam, Question $question)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        if ((int) $question->exam_id !== (int) $exam->id) {
            abort(404);
        }

        $views = [
            'guru.exams.questions.edit',
            'guru.exams.question.edit',
            'guru.questions.edit',
        ];

        foreach ($views as $view) {
            if (view()->exists($view)) {
                return view($view, compact('exam', 'question'));
            }
        }

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('error', 'Halaman edit soal belum tersedia.');
    }

    
    public function update(Request $request, Exam $exam, Question $question)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        if ((int) $question->exam_id !== (int) $exam->id) {
            abort(404);
        }

        $validated = $request->validate([
            'pertanyaan' => ['required', 'string'],
            'pilihan_a' => ['required', 'string'],
            'pilihan_b' => ['required', 'string'],
            'pilihan_c' => ['required', 'string'],
            'pilihan_d' => ['required', 'string'],
            'jawaban_benar' => ['required', 'in:A,B,C,D'],
        ]);

        $question->pertanyaan = $validated['pertanyaan'];
        $question->pilihan_a = $validated['pilihan_a'];
        $question->pilihan_b = $validated['pilihan_b'];
        $question->pilihan_c = $validated['pilihan_c'];
        $question->pilihan_d = $validated['pilihan_d'];
        $question->jawaban_benar = strtoupper($validated['jawaban_benar']);
        $question->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil diperbarui.',
            ]);
        }

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    
    public function destroy(Exam $exam, Question $question)
    {
        if ((int) $exam->guru_id !== (int) Auth::id()) {
            abort(403);
        }

        if ((int) $question->exam_id !== (int) $exam->id) {
            abort(404);
        }

        $question->delete();

        return redirect()
            ->route('guru.exams.show', $exam)
            ->with('success', 'Soal berhasil dihapus.');
    }
}
