<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\ProjectStatusUpdated;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'category', 'user'])->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('projects.create', compact('clients', 'categories', 'teams'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        return redirect()->route('projects.tasks.index', $project->id);
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();
        $teams = User::whereHas('role', function($q) {
            $q->where('name', 'Team');
        })->get();

        return view('projects.edit', compact('project', 'clients', 'categories', 'teams'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'nullable|exists:users,id', // ID Team
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        // LOGIC KUNCI: Cek apakah user_id (Team) mau diganti
        if ($project->user_id != $request->user_id) {
            // Cek apakah ada task di proyek ini yang sudah "Done"
            $hasDoneTask = $project->tasks()->where('status', 'Done')->exists();

            if ($hasDoneTask) {
                return back()->with('error', 'Gagal! Anggota tim proyek tidak bisa diganti karena sudah ada tugas yang selesai (Done).');
            }
        }

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    public function history()
    {
        $user = auth()->user();

        // Eager load biar gak berat
        $query = Project::with(['client', 'category', 'user'])->where('status', 'Completed');

        // Logic: Kalau bukan Admin (berarti Team), filter berdasarkan user_id dia
        if (strtolower($user->role->name) !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $projects = $query->orderBy('updated_at', 'desc')->get();

        return view('projects.history', compact('projects'));
    }
}
