<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route(
                $role === 'guru' ? 'guru.login' : 'siswa.login'
            );
        }

        if (auth()->user()->role !== $role) {
            if (auth()->user()->role === 'guru') {
                return redirect()->route('guru.dashboard');
            }

            if (auth()->user()->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }

            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('siswa.login');
        }

        return $next($request);
    }
}