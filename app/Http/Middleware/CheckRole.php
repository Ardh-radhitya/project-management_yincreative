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
            // Membandingkan dengan huruf kecil agar Admin/admin tidak masalah
            if (strtolower($user->role->name) == strtolower($role)) {
                return $next($request);
            }
        }

        // Pakai abort untuk mencegah "Too Many Redirects"
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}
