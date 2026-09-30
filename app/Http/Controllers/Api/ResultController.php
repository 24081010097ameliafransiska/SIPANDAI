<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $results = Result::with(['exam', 'siswa'])
            ->whereHas('exam', function ($q) use ($request) {
                $q->where('guru_id', $request->user()->id);

                if ($request->filled('exam_id')) {
                    $q->where('id', $request->query('exam_id'));
                }
            })
            ->latest('submitted_at')
            ->paginate($request->query('per_page', 15));

        return response()->json($results);
    }

    public function show(Request $request, Result $result)
    {
        abort_if(
            $result->exam->guru_id !== $request->user()->id,
            403,
            'Anda tidak memiliki akses ke hasil ini.'
        );

        return response()->json([
            'data' => $result->load(['exam', 'siswa'])
        ]);
    }
}