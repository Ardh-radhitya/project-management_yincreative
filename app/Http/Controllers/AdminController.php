<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Carbon\CarbonPeriod;

class AdminController extends Controller
{
    // --- DASHBOARD (REVISI: PLUS GRAFIK CHART DINAMIS) ---
    public function dashboard(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $range = $request->input('range');

        // Default: Jika baru buka, tampilin 30 hari terakhir
        if (!$startDate && !$endDate && !$range) {
            $range = '1m';
        }

        if ($range) {
            $endDate = now()->format('Y-m-d');
            switch ($range) {
                case '5d': $startDate = now()->subDays(4)->format('Y-m-d'); break;
                case '1w': $startDate = now()->subWeek()->format('Y-m-d'); break;
                case '1m': $startDate = now()->subDays(29)->format('Y-m-d'); break;
                case '1y': $startDate = now()->subYear()->format('Y-m-d'); break;
            }
        }

        // 1. Query Statistik Card
        $query = Project::query();
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
        }

        $totalProjects = (clone $query)->count();
        $totalClients = Client::count();
        $totalUsers = User::count();
        $pendingProjects = (clone $query)->where('status', 'Pending')->count();
        $onProgressProjects = (clone $query)->where('status', 'In Progress')->count();
        $completedProjects = (clone $query)->where('status', 'Completed')->count();

        // 2. Logika Grafik (Switch Harian / Bulanan)
        $chartLabels = [];
        $chartData = [];

        if ($range == '1y') {
            // JIKA RENTANG 1 TAHUN -> Tampilkan per Bulan (Logic PostgreSQL)
            $projectsPerMonth = Project::select(
                    DB::raw("CAST(EXTRACT(MONTH FROM created_at) AS INTEGER) as month"),
                    DB::raw("COUNT(*) as count")
                )
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("CAST(EXTRACT(MONTH FROM created_at) AS INTEGER)"))
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month');

            $bulanIndonesia = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
            foreach ($bulanIndonesia as $index => $namaBulan) {
                $chartLabels[] = $namaBulan;
                $chartData[] = $projectsPerMonth[$index + 1] ?? 0;
            }
        } else {
            // JIKA RENTANG LAIN (5D, 1W, 1M) -> Tampilkan per Tanggal (d/m)
            $projectsPerDay = Project::select(
                    DB::raw("DATE(created_at) as date"),
                    DB::raw("COUNT(*) as count")
                )
                ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
                ->groupBy(DB::raw("DATE(created_at)"))
                ->orderBy('date')
                ->get()
                ->pluck('count', 'date');

            $period = CarbonPeriod::create($startDate, $endDate);
            foreach ($period as $date) {
                $formattedDate = $date->format('Y-m-d');
                $chartLabels[] = $date->format('d/m');
                $chartData[] = $projectsPerDay[$formattedDate] ?? 0;
            }
        }

        $recentProjects = (clone $query)->with('client')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard.admin', compact(
            'totalProjects', 'totalClients', 'totalUsers',
            'pendingProjects', 'onProgressProjects', 'completedProjects',
            'recentProjects', 'chartData', 'chartLabels', 'startDate', 'endDate', 'range'
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
