<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() { return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors(['email' => 'Email atau password yang diberikan tidak cocok.'])->onlyInput('email');
    }

    protected function authenticated(Request $request, $user)
    {
        $role = $user->role->name;

        switch ($role) {
            case 'Admin':
                return redirect()->route('dashboard.admin');
            case 'Team':
                return redirect()->route('dashboard.team');
            case 'Client':
                return redirect()->route('dashboard.client');
            default:
                return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
