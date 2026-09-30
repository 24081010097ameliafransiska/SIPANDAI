<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = User::where('role', 'siswa')
            ->when($request->query('search'), function ($q, $search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->select([
                'id',
                'name',
                'nis',
                'nisn',
                'kelas',
            ])
            ->orderBy('name')
            ->paginate($request->query('per_page', 15));

        return response()->json($students);
    }

    public function show(User $student)
    {
        abort_if($student->role !== 'siswa', 404);

        return response()->json([
            'data' => [
                'id' => $student->id,
                'name' => $student->name,
                'nis' => $student->nis,
                'nisn' => $student->nisn,
                'kelas' => $student->kelas,
            ]
        ]);
    }
}