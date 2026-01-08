<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    // --- DASHBOARD (REVISI: TAMBAH STATISTIK LENGKAP) ---
    public function dashboard()
    {
        // 1. Statistik Lengkap
        $totalProjects = Project::count();
        $totalClients = Client::count();
        $totalUsers = User::count();

        // Ini variabel baru yang dibutuhkan view kamu:
        $pendingProjects = Project::where('status', 'Pending')->count();
        $onProgressProjects = Project::where('status', 'In Progress')->count();
        $completedProjects = Project::where('status', 'Completed')->count();

        // 2. Data untuk Tabel (5 Proyek Terbaru)
        $recentProjects = Project::with('client')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('dashboard.admin', compact(
            'totalProjects',
            'totalClients',
            'totalUsers',
            'pendingProjects',      // <-- Tambahan baru
            'onProgressProjects',   // <-- Tambahan baru
            'completedProjects',    // <-- Tambahan baru
            'recentProjects'
        ));
    }

    // --- MANAJEMEN USER (BARU) ---

    public function indexUsers()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function storeUser(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Data user diperbarui.');
    }

    public function destroyUser(User $user)
    {
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
