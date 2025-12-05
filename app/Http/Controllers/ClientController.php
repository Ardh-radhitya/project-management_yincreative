<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProjectCategory;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ClientController extends Controller
{
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

    // --- Admin Functions ---

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
        // Idealnya ini juga dipisah ke StoreClientRequest nanti
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
