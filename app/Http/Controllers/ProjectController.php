<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client; // <-- Tambahkan ini
use App\Models\ProjectCategory; // <-- Tambahkan ini
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'category'])->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        // Ambil data untuk dropdown di form
        $clients = Client::all();
        $categories = ProjectCategory::all();
        return view('projects.create', compact('clients', 'categories'));
    }

    public function store(Request $request)
    {
        // --- VALIDASI DITAMBAHKAN DI SINI ---
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string', // Bisa divalidasi lebih spesifik jika perlu
        ]);

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        // Ambil data untuk dropdown di form edit
        $clients = Client::all();
        $categories = ProjectCategory::all();
        return view('projects.edit', compact('project', 'clients', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        // --- VALIDASI UNTUK UPDATE ---
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
