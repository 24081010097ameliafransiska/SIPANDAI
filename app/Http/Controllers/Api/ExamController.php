<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $exams = Exam::where('guru_id', $request->user()->id)
            ->latest()
            ->paginate($request->query('per_page', 15));

        return response()->json($exams);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_ujian' => ['required', 'string', 'max:255'],
            'mata_pelajaran' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:100'],
            'tanggal_ujian' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'durasi' => ['required', 'integer', 'min:1'],
            'kode_ujian' => [
                'nullable',
                'string',
                'max:50',
                'unique:exams,kode_ujian',
            ],
            'status' => ['required', Rule::in(['draft', 'aktif', 'selesai'])],
        ]);

        $jamMulai = Carbon::createFromFormat('H:i', $data['jam_mulai']);
        $jamSelesai = $jamMulai->copy()->addMinutes($data['durasi']);

        $kodeUjian = $data['kode_ujian'] ?? null;

        if (!$kodeUjian) {
            do {
                $kodeUjian = strtoupper(Str::random(6));
            } while (Exam::where('kode_ujian', $kodeUjian)->exists());
        }

        $exam = Exam::create([
            'guru_id' => $request->user()->id,
            'nama_ujian' => $data['nama_ujian'],
            'mata_pelajaran' => $data['mata_pelajaran'],
            'kelas' => $data['kelas'],
            'tanggal_ujian' => $data['tanggal_ujian'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $jamSelesai->format('H:i'),
            'durasi' => $data['durasi'],
            'kode_ujian' => $kodeUjian,
            'status' => $data['status'],
        ]);

        return response()->json([
            'message' => 'Ujian berhasil dibuat.',
            'data' => $exam
        ], 201);
    }

    public function show(Request $request, Exam $exam)
    {
        $this->authorizeOwnership($request, $exam);

        return response()->json([
            'data' => $exam
        ]);
    }

    public function update(Request $request, Exam $exam)
    {
        $this->authorizeOwnership($request, $exam);

        $data = $request->validate([
            'nama_ujian' => ['sometimes', 'string', 'max:255'],
            'mata_pelajaran' => ['sometimes', 'string', 'max:255'],
            'kelas' => ['sometimes', 'string', 'max:100'],
            'tanggal_ujian' => ['sometimes', 'date'],
            'jam_mulai' => ['sometimes', 'date_format:H:i'],
            'durasi' => ['sometimes', 'integer', 'min:1'],
            'kode_ujian' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('exams', 'kode_ujian')->ignore($exam->id),
            ],
            'status' => ['sometimes', Rule::in(['draft', 'aktif', 'selesai'])],
        ]);

        if (isset($data['jam_mulai']) || isset($data['durasi'])) {
            $jamMulai = Carbon::createFromFormat(
                'H:i',
                $data['jam_mulai'] ?? Carbon::parse($exam->jam_mulai)->format('H:i')
            );

            $durasi = $data['durasi'] ?? $exam->durasi;

            $data['jam_selesai'] = $jamMulai
                ->copy()
                ->addMinutes($durasi)
                ->format('H:i');
        }

        $exam->update($data);

        return response()->json([
            'message' => 'Ujian berhasil diperbarui.',
            'data' => $exam->fresh()
        ]);
    }

    public function destroy(Request $request, Exam $exam)
    {
        $this->authorizeOwnership($request, $exam);

        $exam->delete();

        return response()->json([
            'message' => 'Ujian dihapus.'
        ]);
    }

    private function authorizeOwnership(Request $request, Exam $exam): void
    {
        abort_if(
            $exam->guru_id !== $request->user()->id,
            403,
            'Anda tidak memiliki akses ke ujian ini.'
        );
    }
}