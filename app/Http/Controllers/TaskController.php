<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Munculin Daftar Tugas (Fungsi yang tadi ilang)
    public function index(Project $project)
    {
        $tasks = $project->tasks()->with('user', 'progress')->get();
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('projects.tasks.create', compact('project', 'teams'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $project->tasks()->create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'status' => 'To Do',
        ]);

        return redirect()->route('projects.show', $project->id)->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task)
    {
        $project = $task->project;
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('tasks.edit', compact('task', 'project', 'teams'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'status'  => 'required|in:To Do,In Progress,Done',
        ]);

        // LOGIC KUNCI: Ambil data asli dari database sebelum di-update
        $statusLama = strtolower(trim($task->getOriginal('status')));
        $userLama   = $task->getOriginal('user_id');

        // Jika status di DB sudah 'Done', kunci perubahan Nama & Team
        if ($statusLama === 'done') {
            if ($userLama != $request->user_id || $task->getOriginal('title') != $request->title) {
                return back()->with('error', 'Gagal! Tugas yang sudah "Done" tidak boleh diubah datanya.');
            }

            // Opsional: Kunci agar status Done tidak bisa dibalikin ke To Do
            if (strtolower($request->status) !== 'done') {
                return back()->with('error', 'Gagal! Status "Done" sudah final.');
            }
        }

        // Simpan manual biar aman
        $task->title = $request->title;
        $task->user_id = $request->user_id;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->save();

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Tugas berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate(['status' => 'required|in:To Do,In Progress,Done']);

        $statusLama = strtolower(trim($task->getOriginal('status')));

        if ($statusLama === 'done' && strtolower($request->status) !== 'done') {
            return back()->with('error', 'Gagal! Status "Done" tidak bisa diubah kembali.');
        }

        $task->status = $request->status;
        $task->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $projectId = $task->project_id;
        $task->delete();
        return redirect()->route('projects.show', $projectId)->with('success', 'Tugas berhasil dihapus.');
    }
}
