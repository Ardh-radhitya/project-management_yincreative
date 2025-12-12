<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProjectCategory;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
// Import Request untuk Admin (CRUD Client)
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    // ==========================================
    // --- AREA KLIEN (DASHBOARD & PROYEK) ---
    // ==========================================

    private function authorizeClientAccess(Project $project)
    {
        $client = Client::where('email', Auth::user()->email)->first();
        abort_if(!$client || $project->client_id !== $client->id, 403, 'ANDA TIDAK BERHAK MENGAKSES PROYEK INI.');
        return $client;
    }

    public function dashboard()
    {
        $client = Client::where('email', Auth::user()->email)->first();
        $projects = $client ? $client->projects()->orderBy('created_at', 'desc')->get() : [];
        return view('dashboard.client', compact('projects'));
    }

    public function createProjectForm()
    {
        $categories = ProjectCategory::all();
        return view('clients.create_project', compact('categories'));
    }

    public function storeProject(StoreProjectRequest $request)
    {
        $client = Client::where('email', Auth::user()->email)->first();
        if (!$client) {
            return back()->with('error', 'Gagal menemukan profil klien Anda.');
        }

        $validatedData = $request->validated();
        $validatedData['client_id'] = $client->id;
        $validatedData['status'] = Project::STATUS_PENDING;

        Project::create($validatedData);

        return redirect()->route('dashboard.client')->with('success', 'Proyek berhasil diajukan.');
    }

    public function editProjectForm(Project $project)
    {
        $this->authorizeClientAccess($project);
        $categories = ProjectCategory::all();
        return view('clients.edit_project', compact('project', 'categories'));
    }

    public function updateProject(UpdateProjectRequest $request, Project $project)
    {
        $this->authorizeClientAccess($project);

        if ($project->status !== Project::STATUS_PENDING) {
            return back()->with('error', 'Proyek yang sudah diproses tidak dapat diubah lagi.');
        }

        $project->update($request->validated());
        return redirect()->route('dashboard.client')->with('success', 'Proyek berhasil diperbarui.');
    }

    // [FITUR BARU] Detail Proyek View-Only untuk Klien
    public function showProject(Project $project)
    {
        $this->authorizeClientAccess($project);

        $tasks = $project->tasks()
                        ->with(['user', 'progress.user'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('clients.show_project', compact('project', 'tasks'));
    }


    // ==========================================
    // --- AREA ADMIN (MANAJEMEN DATA KLIEN) ---
    // ==========================================

    // List semua klien
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    // Form tambah klien
    public function create()
    {
        return view('clients.create');
    }

    // Simpan klien baru (Pakai Request Validasi)
    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('clients.index')->with('success', 'Klien berhasil ditambahkan.');
    }

    // Form edit klien
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Update klien (Pakai Request Validasi)
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('success', 'Klien berhasil diperbarui.');
    }

    // Hapus klien
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Klien berhasil dihapus.');
    }
}
