<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id == 1) return redirect()->route('admin.dashboard');
            if ($user->role_id == 2) return redirect()->route('team.dashboard');
            if ($user->role_id == 3) return redirect()->route('client.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }
}
