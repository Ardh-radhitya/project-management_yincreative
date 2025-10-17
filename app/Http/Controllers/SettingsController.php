<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * FUNGSI BARU: Menampilkan halaman utama Settings.
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Menampilkan halaman pengaturan notifikasi.
     */
    public function notifications()
    {
        // Logika untuk mengambil data pengaturan notifikasi
        return view('settings.notifications');
    }

    /**
     * Memperbarui pengaturan notifikasi.
     */
    public function updateNotifications(Request $request)
    {
        // Logika untuk menyimpan perubahan
        return back()->with('success', 'Pengaturan notifikasi berhasil diperbarui.');
    }
}
