<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskProgress; // <--- INI PERBAIKAN UTAMANYA (Impor Model TaskProgress)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- Penting untuk mengambil ID user yang login

class TaskController extends Controller
{
    /**
     * Menampilkan form untuk membuat task baru.
     */
    public function create(Project $project)
    {
        $teamMembers = User::whereHas('role', function ($query) {
            $query->where('name', 'Team');
        })->get();
        return view('tasks.create', compact('project', 'teamMembers'));
    }

    /**
     * Menyimpan task baru.
     */
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
        return redirect()->route('projects.show', $project->id)->with('success', 'Tugas berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit task.
     */
    public function edit(Task $task)
    {
        $project = $task->project;
        $teamMembers = User::whereHas('role', function ($query) {
            $query->where('name', 'Team');
        })->get();
        return view('tasks.edit', compact('task', 'project', 'teamMembers'));
    }

    /**
     * Memperbarui task di database.
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'assigned_to_user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validatedData);

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * FUNGSI BARU: Memperbarui status task saja (untuk dropdown di list).
     */
    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:To Do,In Progress,Done',
        ]);

        $task->update(['status' => $validated['status']]);

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Status tugas berhasil diperbarui.');
    }

    /**
     * FUNGSI BARU: Menyimpan laporan progress (komentar) pada tugas.
     * Ini untuk menjawab request dosbingmu.
     */
    public function storeProgress(Request $request, Task $task)
    {
        $request->validate([
            'progress_note' => 'required|string',
        ]);

        // Pastikan Model TaskProgress sudah di-import di atas!
        TaskProgress::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'progress_note' => $request->progress_note,
        ]);

        return back()->with('success', 'Laporan progress berhasil ditambahkan.');
    }

    /**
     * Menghapus task dari database.
     */
    public function destroy(Task $task)
    {
        $projectId = $task->project_id;
        $task->delete();
        return redirect()->route('projects.show', $projectId)->with('success', 'Tugas berhasil dihapus.');
    }

    public function index() { abort(404); }
    public function show(Task $task) { abort(404); }
}
