<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // <--- WAJIB DITAMBAH (Buat Query Raw PostgreSQL)
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    // --- DASHBOARD (REVISI: PLUS GRAFIK CHART) ---
    public function dashboard()
    {
        // 1. Statistik Card (YANG LAMA)
        $totalProjects = Project::count();
        $totalClients = Client::count();
        $totalUsers = User::count();

        $pendingProjects = Project::where('status', 'Pending')->count();
        $onProgressProjects = Project::where('status', 'In Progress')->count();
        $completedProjects = Project::where('status', 'Completed')->count();

        // 2. LOGIKA GRAFIK BARU (Khusus PostgreSQL)
        // Ambil jumlah proyek per bulan di tahun ini
        $projectsPerMonth = Project::select(
                DB::raw("CAST(EXTRACT(MONTH FROM created_at) AS INTEGER) as month"),
                DB::raw("COUNT(*) as count")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("CAST(EXTRACT(MONTH FROM created_at) AS INTEGER)"))
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');

        // Siapkan array data 12 bulan (Jan-Des), isi 0 kalau bulan itu kosong
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $projectsPerMonth[$i] ?? 0;
        }

        // 3. Recent Projects (YANG LAMA)
        $recentProjects = Project::with('client')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // Kirim variabel $chartData ke View
        return view('dashboard.admin', compact(
            'totalProjects', 'totalClients', 'totalUsers',
            'pendingProjects', 'onProgressProjects', 'completedProjects',
            'recentProjects',
            'chartData' // <--- JANGAN LUPA INI
        ));
    }

    // --- MANAJEMEN USER ---

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
