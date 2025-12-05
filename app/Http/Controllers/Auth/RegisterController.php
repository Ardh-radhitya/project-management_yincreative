<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Role; // [PENTING] Tambahkan Import Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // [PERBAIKAN DI SINI]
        $clientRole = Role::where('name', 'Client')->first();

        if (!$clientRole) {
            return back()->withErrors(['email' => 'Sistem Error: Role "Client" belum tersedia. Pastikan seeder sudah dijalankan.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $clientRole->id,
        ]);

        // 3. Buat Data Klien
        Client::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.client')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }
}
