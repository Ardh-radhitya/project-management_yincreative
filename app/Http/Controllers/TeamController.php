<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini
use App\Models\Project;                // <-- Tambahkan ini

class TeamController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Team.
     */
    public function index()
    {
        // 1. Dapatkan user yang sedang login
        $user = Auth::user();

        // 2. Ambil semua tugas yang ditugaskan ke user ini
        // Kita juga ambil relasi 'project' agar tahu tugas ini milik proyek mana
        $myTasks = $user->assignedTasks()
                        ->with('project') // Ambil data proyek terkait
                        ->whereIn('status', ['To Do', 'In Progress']) // Hanya yang belum selesai
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 3. Ambil daftar ID proyek yang unik dari tugas-tugas tadi
        $projectIds = $myTasks->pluck('project_id')->unique();

        // 4. Ambil data lengkap proyek-proyek tersebut
        $myProjects = Project::with('client') // Ambil juga data kliennya
                            ->whereIn('id', $projectIds)
                            ->where('status', 'In Progress') // Hanya proyek yang 'In Progress'
                            ->get();

        // 5. Kirim data ke view
        return view('dashboard.team', compact('myProjects', 'myTasks'));
    }
}
