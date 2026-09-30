<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showGuruLogin()
    {
        return view('auth.guru-login');
    }

    public function showSiswaLogin()
    {
        return view('auth.siswa-login');
    }

    public function loginGuru(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Bersihkan session login sebelumnya
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'guru',
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Simpan role login ke session
            $request->session()->put('login_role', 'guru');

            return redirect()->route('guru.dashboard');
        }

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Email atau password guru salah.',
            ]);
    }

    public function loginSiswa(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'tanggal_lahir' => 'required|date',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
        ]);

        $siswa = User::where('nisn', $request->nisn)
            ->where('role', 'siswa')
            ->first();

        if (!$siswa) {
            return back()
                ->withInput()
                ->withErrors([
                    'nisn' => 'NISN tidak ditemukan.',
                ]);
        }

        if (
            !$siswa->tanggal_lahir ||
            $siswa->tanggal_lahir->format('Y-m-d') !== $request->tanggal_lahir
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal_lahir' => 'Tanggal lahir tidak sesuai.',
                ]);
        }

        // Bersihkan session login sebelumnya
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Login sebagai siswa
        Auth::login($siswa);

        // Regenerate session setelah login
        $request->session()->regenerate();

        // Simpan role login ke session
        $request->session()->put('login_role', 'siswa');

        return redirect()->route('siswa.dashboard');
    }

    public function logout(Request $request)
    {
        $role = Auth::user()?->role;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($role === 'guru') {
            return redirect()->route('guru.login');
        }

        return redirect()->route('siswa.login');
    }
}