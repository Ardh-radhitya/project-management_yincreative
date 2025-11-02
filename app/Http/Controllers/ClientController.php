<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProjectCategory;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Fungsi untuk mengecek otorisasi klien
    private function authorizeClientAccess(Project $project)
    {
        $client = Client::where('email', Auth::user()->email)->first();
        if (!$client || $project->client_id !== $client->id) {
            abort(403, 'ANDA TIDAK BERHAK MENGAKSES PROYEK INI.');
        }
        return $client;
    }

    public function dashboard()
    {
        $client = Client::where('email', Auth::user()->email)->first();
        $projects = [];
        if ($client) {
            $projects = $client->projects()->orderBy('created_at', 'desc')->get();
        }
        return view('dashboard.client', compact('projects'));
    }

    public function createProjectForm()
    {
        $categories = ProjectCategory::all();
        return view('clients.create_project', compact('categories'));
    }

    public function storeProject(Request $request)
    {
        $validatedData = $request->validate([ /* ... validasi ... */ ]);
        $client = Client::where('email', Auth::user()->email)->first();
        if (!$client) { /* ... error handling ... */ }
        $validatedData['client_id'] = $client->id;
        $validatedData['status'] = 'Pending';
        Project::create($validatedData);
        return redirect()->route('dashboard.client')->with('success', 'Proyek berhasil diajukan.');
    }

    /**
     * FUNGSI BARU: Menampilkan form edit proyek untuk Klien.
     */
    public function editProjectForm(Project $project)
    {
        // Keamanan: Pastikan klien ini adalah pemilik proyek
        $this->authorizeClientAccess($project);

        $categories = ProjectCategory::all();
        return view('clients.edit_project', compact('project', 'categories'));
    }

    /**
     * FUNGSI BARU: Memperbarui proyek yang diajukan oleh Klien.
     */
    public function updateProject(Request $request, Project $project)
    {
        // Keamanan: Pastikan klien ini adalah pemilik proyek
        $this->authorizeClientAccess($project);

        // Hanya izinkan edit jika status masih 'Pending' (Opsional, tapi ide bagus)
        if ($project->status !== 'Pending') {
            return back()->with('error', 'Proyek yang sudah diproses tidak dapat diubah lagi.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $project->update($validatedData);

        return redirect()->route('dashboard.client')->with('success', 'Proyek berhasil diperbarui.');
    }


    // --- Fungsi CRUD Klien (untuk Admin) ---

    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        Client::create($validatedData);
        return redirect()->route('clients.index')->with('success', 'Klien berhasil ditambahkan.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        $client->update($validatedData);
        return redirect()->route('clients.index')->with('success', 'Klien berhasil diperbarui.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Klien berhasil dihapus.');
    }
}
