<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        // sementara pakai user contoh / record pertama
        $user = \App\Models\User::first(); // ambil user pertama di tabel users

        // kalau tabel users kosong, kasih default biar gak null
        if (!$user) {
            $user = new \App\Models\User([
                'name'  => 'Default User',
                'email' => 'default@example.com',
            ]);
        }

        return view('settings.profile', ['user' => $user]);
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
