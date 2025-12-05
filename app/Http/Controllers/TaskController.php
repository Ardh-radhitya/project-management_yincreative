<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks()->with('user')->get();
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        $teamMembers = User::whereHas('role', function ($query) {
            $query->where('name', 'Team');
        })->get();
        return view('tasks.create', compact('project', 'teamMembers'));
    }

    public function store(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'assigned_to_user_id' => 'nullable|exists:users,id',
        ]);
        $validatedData['project_id'] = $project->id;
        Task::create($validatedData);

        // [PERBAIKAN 1] Redirect ke Daftar Tugas, bukan Detail Proyek
        return redirect()->route('projects.tasks.index', $project->id)
                        ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task)
    {
        $project = $task->project;
        $teamMembers = User::whereHas('role', function ($query) {
            $query->where('name', 'Team');
        })->get();
        return view('tasks.edit', compact('task', 'project', 'teamMembers'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'assigned_to_user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validatedData);

        // [PERBAIKAN 2] Redirect ke Daftar Tugas
        return redirect()->route('projects.tasks.index', $task->project_id)
                        ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:To Do,In Progress,Done',
        ]);

        $task->update(['status' => $validated['status']]);

        // [PERBAIKAN 3] Redirect ke Daftar Tugas (Penting untuk Dropdown)
        return redirect()->route('projects.tasks.index', $task->project_id)
                        ->with('success', 'Status tugas berhasil diperbarui.');
    }

    public function storeProgress(Request $request, Task $task)
    {
        $request->validate([
            'progress_note' => 'required|string',
        ]);

        TaskProgress::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'progress_note' => $request->progress_note,
        ]);

        // Kalau ini pakai back() saja sudah aman karena usernya ada di halaman itu
        return back()->with('success', 'Laporan progress berhasil ditambahkan.');
    }

    public function destroy(Task $task)
    {
        $projectId = $task->project_id;
        $task->delete();

        // [PERBAIKAN 4] Redirect ke Daftar Tugas
        return redirect()->route('projects.tasks.index', $projectId)
                        ->with('success', 'Tugas berhasil dihapus.');
    }
}
