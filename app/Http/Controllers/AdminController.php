<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Statistik Kartu Atas
        $totalProjects = Project::count();
        $totalClients = Client::count();
        $totalUsers = User::count();
        $activeProjects = Project::where('status', 'In Progress')->count();

        // 2. Data untuk Tabel (5 Proyek Terbaru)
        // Kita pakai 'with' biar hemat query database (Eager Loading)
        $recentProjects = Project::with('client')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // Kirim semua ke view
        return view('dashboard.admin', compact(
            'totalProjects',
            'totalClients',
            'totalUsers',
            'activeProjects',
            'recentProjects'
        ));
    }
}
