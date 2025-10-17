<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // <-- Tambahkan ini untuk mengambil data Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Tambahkan ini untuk hashing password

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get(); // Mengambil user beserta data rolenya
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Ambil semua role untuk ditampilkan di dropdown
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // --- VALIDASI DITAMBAHKAN DI SINI ---
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Buat user baru dengan data yang sudah divalidasi
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Jangan lupa hash password
            'role_id' => $validatedData['role_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        // Biasanya tidak digunakan jika ada halaman index, tapi bisa disiapkan
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // --- VALIDASI UNTUK UPDATE ---
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        // Jika password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
