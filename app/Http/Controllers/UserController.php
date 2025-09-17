<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['Admin', 'Internal Team'])->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            // 'role_id' => 'required|exists:roles,id',
            'password'      => 'required|min:6|confirmed',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // --- simpan file jika ada
        $imagePath = null;
        if ($request->hasFile('photo_profile')) {
            $path = $request->file('photo_profile')->store('users', 'public');
            $data['photo_profile'] = $path;
        }


        // --- create user + path foto
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            // 'role_id' => $request->role_id,
            'password'      => Hash::make($request->password),
            'photo_profile' => $imagePath,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['Admin', 'Internal Team'])->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            //'role_id' => 'required|exists:roles,id',
            'password'      => 'nullable|min:6|confirmed',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // --- data dasar
        $data = $request->only('name', 'email'); // tambahkan role_id jika dipakai

        // --- password (opsional)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // --- foto profil (opsional)
        if ($request->hasFile('photo_profile')) {
            $data['photo_profile'] = $request->file('photo_profile')->store('photo_profile', 'public');
        }

        // --- update langsung
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted');
    }
}
