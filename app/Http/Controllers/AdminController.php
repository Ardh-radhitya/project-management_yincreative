<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProjects = \App\Models\Project::count();
        $totalClients = \App\Models\Client::count();
        $totalUsers = \App\Models\User::count();
        $totalAdmins = \App\Models\Admin::count();

        // Ambil 5 proyek terbaru
        $recentProjects = \App\Models\Project::latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalProjects',
            'totalClients',
            'totalUsers',
            'totalAdmins',
            'recentProjects'
        ));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('photo_profile')) {
            $imagePath = $request->file('photo_profile')->store('photo_profile', 'public');
        }

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_profile' => $imagePath,
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Admin created successfully.');
    }

    public function edit(Admin $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo_profile')) {
            if ($admin->photo_profile) {
                Storage::disk('public')->delete($admin->photo_profile);
            }
            $admin->photo_profile = $request->file('photo_profile')->store('photo_profile', 'public');
        }

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('dashboard.admin')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->photo_profile) {
            Storage::disk('public')->delete($admin->photo_profile);
        }

        $admin->delete();
        return redirect()->route('dashboard.admin')->with('success', 'Admin deleted successfully.');
    }
}



