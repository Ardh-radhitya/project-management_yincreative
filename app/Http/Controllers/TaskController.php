<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks()->with('user', 'progress')->get();
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        $teams = User::whereHas('role', function($query) {
            $query->where('name', 'Team');
        })->get();

        return view('tasks.create', compact('project', 'teams'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'assigned_to_user_id' => 'required|exists:users,id',
        ]);

        $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->assigned_to_user_id, // Masuk ke kolom user_id
            'status' => $request->status ?? 'To Do',
        ]);

        return redirect()->route('projects.show', $project->id)->with('success', 'Tugas berhasil dibuat!');
    }

    public function edit(Task $task)
    {
        $project = $task->project;
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('tasks.edit', compact('task', 'project', 'teams'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'assigned_to_user_id' => 'required|exists:users,id',
            'status'  => 'required|in:To Do,In Progress,Done',
        ]);

        $statusLama = strtolower(trim($task->getOriginal('status')));

        // Logic Kunci untuk status Done
        if ($statusLama === 'done') {
            if ($task->getOriginal('user_id') != $request->assigned_to_user_id || $task->getOriginal('title') != $request->title) {
                return back()->with('error', 'Gagal! Tugas yang sudah "Done" tidak boleh diubah datanya.');
            }

            if (strtolower($request->status) !== 'done') {
                return back()->with('error', 'Gagal! Status "Done" sudah final.');
            }
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $request->assigned_to_user_id, // Masuk ke kolom user_id
        ]);

        return redirect()->route('projects.show', $project->id)->with('success', 'Tugas berhasil diperbarui.');
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
