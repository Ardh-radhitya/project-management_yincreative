<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use App\Events\ProjectStatusUpdated; // <-- TAMBAHKAN Impor Event
use Illuminate\Support\Facades\Log;   // <-- TAMBAHKAN Impor Log (untuk debug jika perlu)

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'category'])->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::all();
        $categories = ProjectCategory::all();
        return view('projects.create', compact('clients', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:Pending,In Progress,Completed', // Dibuat lebih spesifik
        ]);

        $project = Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        return redirect()->route('projects.tasks.index', $project->id);
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        // --- TES DULU DI SINI ---
        dd($clients);
        // Kalau browser jadi layar hitam isi data Client, berarti Controller AMAN.
        // Kalau errornya tetep "Undefined variable", berarti Controller ini GAK DIPANGGIL.
        $categories = ProjectCategory::all();
        return view('projects.edit', compact('project', 'clients', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:Pending,In Progress,Completed', // Dibuat lebih spesifik
        ]);

        // Simpan status lama sebelum update
        $oldStatus = $project->status;

        // Update data proyek
        $project->update($validatedData);

        // Umumkan event HANYA jika status berubah
        if ($oldStatus !== $validatedData['status']) { // Bandingkan dengan data tervalidasi
            Log::info("Status berubah dari {$oldStatus} ke {$validatedData['status']}. Mencoba dispatch event untuk Project ID: {$project->id}"); // Log Debug 1
            ProjectStatusUpdated::dispatch($project->fresh()); // Kirim data $project yang sudah terupdate
        } else {
             Log::info("Status tidak berubah untuk Project ID: {$project->id}. Event tidak di-dispatch."); // Log Debug Tambahan
        }

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
