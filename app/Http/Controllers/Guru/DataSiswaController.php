<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    /**
     * Menampilkan data siswa
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa');

        // Pencarian nama atau NIS
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }

        // Filter kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        $siswas = $query
            ->orderBy('kelas')
            ->orderBy('no_absen')
            ->get();

        // Daftar kelas untuk filter
        $kelas = User::where('role', 'siswa')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('guru.data-siswa.index', compact(
            'siswas',
            'kelas'
        ));
    }
}