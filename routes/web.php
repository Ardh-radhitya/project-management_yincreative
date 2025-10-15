<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;


/*--------------------------------------------------------------------------
| Authentication Routes (Publik)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Grup Rute yang Dilindungi (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // --- Dashboard Routes ---
    Route::get('/', fn() => redirect()->route('login')); // Arahkan ke login jika hanya akses root
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin')->middleware('role:admin');
    Route::get('/dashboard-team', fn() => view('dashboard.team'))->name('dashboard.team')->middleware('role:team,admin'); // Admin bisa akses juga
    Route::get('/dashboard-client', fn() => view('dashboard.client'))->name('dashboard.client')->middleware('role:client');

    // --- Grup Rute Khusus Admin ---
    Route::middleware(['role:admin'])->group(function () {
        // Menggunakan Route::resource untuk meringkas 7 baris jadi 1
        Route::resource('admins', AdminController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('users', UserController::class);
    });

    // --- Grup Rute untuk Admin dan Tim ---
    Route::middleware(['role:admin,team'])->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('categories', ProjectCategoryController::class);
    });

    // --- Rute Pengaturan (Untuk semua yang sudah login) ---
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', fn() => view('settings.index'))->name('index');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
    });
});
