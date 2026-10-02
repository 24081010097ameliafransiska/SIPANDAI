<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\ExamResult;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $exams = Exam::whereRaw('LOWER(status) = ?', ['aktif'])
            ->orderByDesc('tanggal_ujian')
            ->get();

        return view('siswa.dashboard', compact('user', 'exams'));
    }

    public function masukUjian(Request $request)
    {
        $request->validate([
            'kode_ujian' => 'required|string',
            'foto_absen' => 'required|string',
        ], [
            'kode_ujian.required' => 'Kode ujian wajib diisi.',
            'foto_absen.required' => 'Foto absen wajib diambil sebelum masuk ujian.',
        ]);

        $kode = strtoupper(trim($request->kode_ujian));

        $exam = Exam::whereRaw(
            'UPPER(kode_ujian) = ?',
            [$kode]
        )->first();

        if (!$exam) {
            return back()
                ->withInput()
                ->with('error', 'Kode ujian tidak ditemukan.');
        }

        if (strtolower(trim($exam->status)) !== 'aktif') {
            return back()
                ->withInput()
                ->with('error', 'Ujian ini belum aktif atau sudah selesai.');
        }

        $siswaId = Auth::id();

        $fotoAbsen = $request->input('foto_absen');

        if (
            !is_string($fotoAbsen) ||
            !str_starts_with($fotoAbsen, 'data:image/')
        ) {
            return back()
                ->withInput()
                ->with('error', 'Foto absen tidak valid. Silakan ambil foto kembali.');
        }

        try {
            $parts = explode(',', $fotoAbsen, 2);

            if (count($parts) !== 2) {
                throw new \Exception('Format foto tidak valid.');
            }

            $imageData = base64_decode($parts[1], true);

            if ($imageData === false) {
                throw new \Exception('Data foto tidak dapat dibaca.');
            }

            if (strlen($imageData) > 5 * 1024 * 1024) {
                return back()
                    ->withInput()
                    ->with('error', 'Ukuran foto terlalu besar. Silakan ambil foto kembali.');
            }

            $imageInfo = @getimagesizefromstring($imageData);

            if ($imageInfo === false) {
                throw new \Exception('Data bukan gambar yang valid.');
            }

            $mime = $imageInfo['mime'] ?? '';

            $allowedMime = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp',
            ];

            if (!in_array($mime, $allowedMime, true)) {
                throw new \Exception('Format foto tidak didukung.');
            }

            $filename = 'absen_' .
                $siswaId . '_' .
                $exam->id . '_' .
                time() . '_' .
                uniqid() .
                '.jpg';

            Storage::disk('public')->put(
                'foto-absen/' . $filename,
                $imageData
            );

            $fotoPath = 'foto-absen/' . $filename;
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Foto absen gagal diproses. Silakan ambil foto kembali.');
        }

        $attempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('siswa_id', $siswaId)
            ->orderByDesc('attempt_number')
            ->first();

        if (!$attempt) {
            $newAttempt = ExamAttempt::create([
                'exam_id' => $exam->id,
                'siswa_id' => $siswaId,
                'attempt_number' => 1,
                'status' => 'active',
                'started_at' => now(),
                'foto_absen' => $fotoPath,
            ]);

            session([
                'exam_id' => $exam->id,
                'exam_attempt_id' => $newAttempt->id,
            ]);

            return redirect()->route('siswa.exam', $exam->id);
        }

        if ($attempt->status === 'active') {
            if (
                !empty($attempt->foto_absen) &&
                Storage::disk('public')->exists($attempt->foto_absen)
            ) {
                Storage::disk('public')->delete($attempt->foto_absen);
            }

            $attempt->update([
                'foto_absen' => $fotoPath,
            ]);

            session([
                'exam_id' => $exam->id,
                'exam_attempt_id' => $attempt->id,
            ]);

            return redirect()->route('siswa.exam', $exam->id);
        }

        if ($attempt->status === 'submitted') {
            if (
                !empty($fotoPath) &&
                Storage::disk('public')->exists($fotoPath)
            ) {
                Storage::disk('public')->delete($fotoPath);
            }

            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Kamu sudah pernah mengikuti ujian ini. Jika ingin mengikuti ujian ulang, silakan menemui guru dan menyampaikan alasan yang jelas.'
                );
        }

        if ($attempt->status === 'waiting_approval') {
            if (
                !empty($fotoPath) &&
                Storage::disk('public')->exists($fotoPath)
            ) {
                Storage::disk('public')->delete($fotoPath);
            }

            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Permintaan ujian ulang kamu masih menunggu persetujuan guru.'
                );
        }

        if ($attempt->status === 'approved') {
            $newAttempt = ExamAttempt::create([
                'exam_id' => $exam->id,
                'siswa_id' => $siswaId,
                'attempt_number' => ((int) $attempt->attempt_number) + 1,
                'status' => 'active',
                'started_at' => now(),
                'foto_absen' => $fotoPath,
            ]);

            session([
                'exam_id' => $exam->id,
                'exam_attempt_id' => $newAttempt->id,
            ]);

            return redirect()->route('siswa.exam', $exam->id);
        }

        if (
            !empty($fotoPath) &&
            Storage::disk('public')->exists($fotoPath)
        ) {
            Storage::disk('public')->delete($fotoPath);
        }

        return redirect()
            ->route('siswa.dashboard')
            ->with(
                'error',
                'Kamu belum memiliki izin untuk mengikuti ujian ini.'
            );
    }

    public function exam(Exam $exam)
    {
        $siswaId = Auth::id();

        $attempt = ExamAttempt::where(
            'id',
            session('exam_attempt_id')
        )
            ->where('exam_id', $exam->id)
            ->where('siswa_id', $siswaId)
            ->where('status', 'active')
            ->first();

        if (!$attempt) {
            $attempt = ExamAttempt::where(
                'exam_id',
                $exam->id
            )
                ->where('siswa_id', $siswaId)
                ->where('status', 'active')
                ->orderByDesc('attempt_number')
                ->first();
        }

        if (!$attempt) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Kamu tidak memiliki akses untuk mengerjakan ujian ini.'
                );
        }

        session([
            'exam_id' => $exam->id,
            'exam_attempt_id' => $attempt->id,
        ]);

        if (empty($attempt->randomized_data)) {
            $questions = Question::where(
                'exam_id',
                $exam->id
            )
                ->orderBy('id')
                ->get();

            $questionOrder = $questions
                ->pluck('id')
                ->shuffle()
                ->values()
                ->toArray();

            $options = [];

            foreach ($questions as $question) {
                $originalOptions = [
                    'A',
                    'B',
                    'C',
                    'D',
                ];

                $shuffledOptions = collect($originalOptions)
                    ->shuffle()
                    ->values()
                    ->toArray();

                $options[$question->id] = [
                    'A' => $shuffledOptions[0],
                    'B' => $shuffledOptions[1],
                    'C' => $shuffledOptions[2],
                    'D' => $shuffledOptions[3],
                ];
            }

            $attempt->update([
                'randomized_data' => [
                    'question_order' => $questionOrder,
                    'options' => $options,
                ],
            ]);
        }

        $randomizedData = $attempt->randomized_data ?? [];

        $questionOrder = $randomizedData['question_order'] ?? [];

        $questions = Question::where(
            'exam_id',
            $exam->id
        )
            ->whereIn('id', $questionOrder)
            ->get()
            ->sortBy(function ($question) use ($questionOrder) {
                return array_search(
                    $question->id,
                    $questionOrder
                );
            })
            ->values();

        $options = $randomizedData['options'] ?? [];

        return view(
            'siswa.exam',
            compact(
                'exam',
                'questions',
                'attempt',
                'options'
            )
        );
    }

    public function submit(
        Request $request,
        Exam $exam
    ) {
        $siswaId = Auth::id();

        $attempt = ExamAttempt::where(
            'id',
            session('exam_attempt_id')
        )
            ->where('exam_id', $exam->id)
            ->where('siswa_id', $siswaId)
            ->where('status', 'active')
            ->first();

        if (!$attempt) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Sesi ujian tidak ditemukan atau ujian sudah dikumpulkan.'
                );
        }

        $randomizedData = $attempt->randomized_data ?? [];

        $optionMapping = $randomizedData['options'] ?? [];

        $questionOrder = $randomizedData['question_order'] ?? [];

        if (!empty($questionOrder)) {
            $questions = Question::where(
                'exam_id',
                $exam->id
            )
                ->whereIn('id', $questionOrder)
                ->get()
                ->sortBy(function ($question) use ($questionOrder) {
                    return array_search(
                        $question->id,
                        $questionOrder
                    );
                })
                ->values();
        } else {
            $questions = Question::where(
                'exam_id',
                $exam->id
            )
                ->orderBy('id')
                ->get();
        }

        $jumlahBenar = 0;
        $jumlahSalah = 0;

        foreach ($questions as $question) {
            $jawabanTampilan = $request->input(
                'jawaban.' . $question->id
            );

            $jawabanAsli = null;

            if (
                $jawabanTampilan !== null &&
                $jawabanTampilan !== '' &&
                isset($optionMapping[$question->id][$jawabanTampilan])
            ) {
                $jawabanAsli = $optionMapping[$question->id][$jawabanTampilan];
            } elseif (
                $jawabanTampilan !== null &&
                $jawabanTampilan !== ''
            ) {
                $jawabanAsli = $jawabanTampilan;
            }

            Answer::updateOrCreate(
                [
                    'exam_id' => $exam->id,
                    'question_id' => $question->id,
                    'siswa_id' => $siswaId,
                ],
                [
                    'jawaban' => $jawabanAsli,
                ]
            );

            if (
                $jawabanAsli !== null &&
                $jawabanAsli !== '' &&
                strtoupper(trim($jawabanAsli)) ===
                strtoupper(trim($question->jawaban_benar))
            ) {
                $jumlahBenar++;
            } else {
                $jumlahSalah++;
            }
        }

        $jumlahSoal = $questions->count();

        $nilai = $jumlahSoal > 0
            ? ($jumlahBenar / $jumlahSoal) * 100
            : 0;

        $nilai = round($nilai, 2);

        ExamResult::updateOrCreate(
            [
                'exam_id' => $exam->id,
                'siswa_id' => $siswaId,
            ],
            [
                'jumlah_benar' => $jumlahBenar,
                'jumlah_salah' => $jumlahSalah,
                'total_soal' => $jumlahSoal,
                'nilai' => $nilai,
                'submit_type' => 'submit',
                'submitted_at' => now(),
            ]
        );

        $attempt->update([
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        session([
            'exam_result' => [
                'exam_id' => $exam->id,
                'nilai' => $nilai,
                'jumlah_benar' => $jumlahBenar,
                'jumlah_salah' => $jumlahSalah,
                'jumlah_soal' => $jumlahSoal,
            ],
        ]);

        session()->forget([
            'exam_id',
            'exam_attempt_id',
        ]);

        return redirect()->route(
            'siswa.exam.result',
            $exam->id
        );
    }

    public function result(Exam $exam)
    {
        $siswaId = Auth::id();

        $result = ExamResult::where(
            'exam_id',
            $exam->id
        )
            ->where('siswa_id', $siswaId)
            ->first();

        if (!$result) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Hasil ujian belum tersedia.'
                );
        }

        $jumlahSoal = $result->total_soal
            ?? Question::where(
                'exam_id',
                $exam->id
            )->count();

        return view(
            'siswa.exam-result',
            compact(
                'exam',
                'result',
                'jumlahSoal'
            )
        );
    }
}