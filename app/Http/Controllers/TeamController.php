<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil Tugas Saya (Yang belum selesai/Done)
        $myTasks = Task::where('assigned_to_user_id', $userId)
                        ->where('status', '!=', 'Done') // Hanya yang aktif
                        ->with('project') // Eager load relasi project
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 2. Ambil Proyek Aktif Saya
        // Logika: Proyek di mana user ini memiliki setidaknya satu tugas
        $myProjects = Project::whereHas('tasks', function($query) use ($userId) {
                            $query->where('assigned_to_user_id', $userId);
                        })
                        ->with('client') // Eager load client biar gak error di view
                        ->where('status', '!=', 'Completed') // Hanya proyek aktif
                        ->distinct()
                        ->get();

        // Kirim data ke view
        return view('dashboard.team', compact('myTasks', 'myProjects'));
    }
}
