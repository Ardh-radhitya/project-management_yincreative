<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            // PERBAIKAN DI SINI:
            // Kita ubah kedua nilai menjadi huruf kecil sebelum membandingkan.
            if (strtolower($user->role->name) == strtolower($role)) {
                return $next($request);
            }
        }

        return redirect('/login')->with('error', 'Anda tidak memiliki hak akses.');
    }
}
