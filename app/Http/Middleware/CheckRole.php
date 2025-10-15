<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek dulu apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum, langsung lempar ke halaman login
            return redirect()->route('login');
        }

        // 2. Ambil data pengguna yang sedang login
        $user = Auth::user();

        // 3. Cek setiap peran yang kita izinkan untuk rute ini
        foreach ($roles as $role) {
            // 4. Jika peran pengguna cocok dengan salah satu peran yang diizinkan...
            if ($user->role->name == $role) {
                // ...izinkan dia masuk ke halaman berikutnya.
                return $next($request);
            }
        }

        // 5. Jika tidak ada peran yang cocok, tendang dia kembali ke halaman login.
        return redirect('/login')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
    }
}
