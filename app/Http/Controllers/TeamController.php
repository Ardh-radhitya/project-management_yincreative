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

        // 1. mengambil SEMUA tugas yang ditugaskan ke user ini (Apapun statusnya)
        $myTasks = $user->assignedTasks()
                        ->with('project')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 2. Mengmbil daftar ID proyek dari tugas-tugas tersebut
        $projectIds = $myTasks->pluck('project_id')->unique();

        // 3. Mengambil data proyek (Apapun statusnya)
        $myProjects = Project::with('client')
                            ->whereIn('id', $projectIds)
                            ->get();

        return view('dashboard.team', compact('myProjects', 'myTasks'));
    }
}
