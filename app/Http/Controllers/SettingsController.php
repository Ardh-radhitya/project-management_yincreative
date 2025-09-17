<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
    {
        public function index() {
            return view('settings.index');
        }

        public function profile() {
            return view('settings.profile');
        }

        public function preferences() {
            return view('settings.preferences');
        }

        public function system() {
            return view('settings.system');
        }

// app/Http/Controllers/SettingsController.php
        public function notifications()
        {
            // sementara tanpa login
            $user = \App\Models\User::first(); // dummy data
            return view('settings.notifications', compact('user'));
        }

        public function updateNotifications(Request $request)
        {
            $data = $request->validate([
                'email_notif'  => 'boolean',
                'system_notif' => 'boolean',
            ]);

            $user = \App\Models\User::first(); // dummy
            $user->update($data);

            return back()->with('success', 'Notification settings updated!');
        }


        public function updateProfile(Request $request) {
            $user = auth()->user();
            $validated = $request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|email|max:255|unique:users,email,'.$user->id,
                'password'=>'nullable|string|min:8|confirmed',
            ]);
            if ($request->filled('password')) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }
            $user->update($validated);
            return back()->with('success','Profile updated.');
        }


        // updatePreferences & updateNotifications bisa nyimpen ke tabel user_settings atau json column
    }

