<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class TeamController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Team.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil SEMUA tugas yang ditugaskan ke user ini (Apapun statusnya)
        // Kita hapus filter whereIn('status', ...) agar task 'Done' tetap muncul
        $myTasks = $user->assignedTasks()
                        ->with('project')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 2. Ambil daftar ID proyek dari tugas-tugas tersebut
        $projectIds = $myTasks->pluck('project_id')->unique();

        // 3. Ambil data proyek (Apapun statusnya)
        // Kita hapus filter where('status', 'In Progress') agar proyek 'Pending'/'Completed' tetap muncul
        $myProjects = Project::with('client')
                            ->whereIn('id', $projectIds)
                            ->get();

        return view('dashboard.team', compact('myProjects', 'myTasks'));
    }
}
