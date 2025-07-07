<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    // Menampilkan daftar semua klien
    public function index()
    {
        $clients = Client::latest()->paginate(10); // Ambil semua klien, urutkan dari terbaru
        return view('clients.index', compact('clients'));
    }

    // Menampilkan form untuk membuat klien baru
    public function create()
    {
        return view('clients.create');
    }

    // Menyimpan klien baru ke database
    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:clients',
        'password' => 'required|string|min:8',
        'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('photo_profile')) {
        $imagePath = $request->file('photo_profile')->store('photo_profile', 'public');
    }

    Client::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'photo_profile' => $imagePath,
    ]);

    return redirect()->route('clients')->with('success', 'Client created successfully.');
}


    // Menampilkan form untuk mengedit klien
    public function edit($id)
    {
        $client = Client::findOrFail($id); // Ambil klien berdasarkan ID
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    // Mengupdate data klien di database
    public function update(Request $request, $id)
{
    $client = Client::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id,
        'password' => 'nullable|string|min:8',
        'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('photo_profile')) {
        $imagePath = $request->file('photo_profile')->store('photo_profile', 'public');
        $client->photo_profile = $imagePath;
    }

    $client->name = $validated['name'];
    $client->email = $validated['email'];

    if (!empty($validated['password'])) {
        $client->password = Hash::make($validated['password']);
    }

    $client->save();

    return redirect()->route('clients')->with('success', 'Client updated successfully.');
}


    // Menghapus klien dari database
    public function destroy($id)
{
    $client = Client::findOrFail($id);

    if ($client->photo_profile) {
        Storage::disk('public')->delete($client->photo_profile);
    }

    $client->delete();

    return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
}

}
