<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProjectCategory;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.client');
    }

    public function createProjectForm()
    {
        $categories = ProjectCategory::all(); // Ambil kategori untuk dropdown
        return view('clients.create_project', compact('categories'));
    }

    /**
     *  Menyimpan proyek yang diajukan oleh Klien.
     */
    public function storeProject(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Dapatkan ID klien yang sedang login
        $client = Client::where('email', Auth::user()->email)->first();
        $clientId = $client ? $client->id : null;

        // Periksa apakah user adalah klien
        if (!$clientId) {
            return back()->with('error', 'Hanya klien yang bisa mengajukan proyek.');
        }

        // Tambahkan client_id dan status default
        $validatedData['client_id'] = $clientId;
        $validatedData['status'] = 'Pending'; // Status awal proyek dari klien

        Project::create($validatedData);

        // Redirect kembali ke dasbor klien dengan pesan sukses
        return redirect()->route('dashboard.client')->with('success', 'Proyek berhasil diajukan.');
    }
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
        // --- VALIDASI DITAMBAHKAN DI SINI ---
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
        // --- VALIDASI UNTUK UPDATE ---
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
