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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:8',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('photo_profile')) {
            // Simpan gambar ke storage/app/public/profile_pictures
            $imagePath = $request->file('photo_profile')->store('photo_profile', 'public');
        }

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'photo_profile' => $imagePath,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    // Menampilkan form untuk mengedit klien
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Mengupdate data klien di database
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->clients_id . ',clients_id',
            'password' => 'nullable|string|min:8',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('password', 'photo_profile');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Hash password baru jika diisi
        }

        if ($request->hasFile('photo_profile')) {
            // Hapus gambar lama jika ada
            if ($client->photo_profile) {
                Storage::disk('public')->delete($client->photo_profile);
            }
            // Simpan gambar baru
            $data['photo_profile'] = $request->file('photo_profile')->store('photo_profile', 'public');
        }

        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    // Menghapus klien dari database
    public function destroy(Client $client)
    {
         // Hapus gambar dari storage
        if ($client->photo_profile) {
            Storage::disk('public')->delete($client->photo_profile);
        }

        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
