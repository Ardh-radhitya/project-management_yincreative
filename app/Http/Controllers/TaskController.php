<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

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
     * Parameter $task otomatis diambil dari URL (misal: /tasks/5/edit) karena kita pakai ->shallow()
     */
    public function edit(Task $task)
    {
        // Ambil data project terkait untuk tombol Batal dan info
        $project = $task->project;
        // Ambil team members untuk dropdown
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

        // Redirect kembali ke halaman detail proyek tempat task ini berada
        return redirect()->route('projects.show', $task->project_id)->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Menghapus task dari database.
     */
    public function destroy(Task $task)
    {
        // Simpan dulu ID proyeknya sebelum task dihapus
        $projectId = $task->project_id;

        // Hapus task
        $task->delete();

        // Redirect kembali ke halaman detail proyek
        return redirect()->route('projects.show', $projectId)->with('success', 'Tugas berhasil dihapus.');
    }

    // --- Fungsi index dan show biasanya tidak diperlukan untuk task dalam konteks ini ---
    public function index() { abort(404); }
    public function show(Task $task) { abort(404); }
}
