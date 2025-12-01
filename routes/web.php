<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

// Rute Publik (hanya untuk login & logout)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', fn() => redirect()->route('login'));


// "Zona Aman": Semua rute di bawah ini WAJIB LOGIN
Route::middleware(['auth'])->group(function () {

    // --- Rute Dasbor ---
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin')->middleware('role:admin');
    Route::get('/dashboard-team', [TeamController::class, 'index'])->name('dashboard.team')->middleware('role:team,admin');
    Route::get('/dashboard-client', [ClientController::class, 'dashboard'])->name('dashboard.client')->middleware('role:client');
    // --- RUTE UNTUK KLIEN MENGELOLA PROYEK ---
    Route::get('/client/projects/create', [ClientController::class, 'createProjectForm'])->name('client.projects.create')->middleware('role:client');
    Route::post('/client/projects', [ClientController::class, 'storeProject'])->name('client.projects.store')->middleware('role:client');
    // Rute baru untuk menampilkan form edit
    Route::get('/client/projects/{project}/edit', [ClientController::class, 'editProjectForm'])->name('client.projects.edit')->middleware('role:client');
    // Rute baru untuk menyimpan perubahan (update)
    Route::put('/client/projects/{project}', [ClientController::class, 'updateProject'])->name('client.projects.update')->middleware('role:client');
    // ----------------------------------------

    // --- Grup Rute Khusus Admin ---
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('clients', ClientController::class);
    });

    // --- Grup Rute untuk Admin dan Tim ---
    Route::middleware(['role:admin,team'])->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('categories', ProjectCategoryController::class);
        Route::resource('projects.tasks', TaskController::class)->shallow();
        Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::post('/tasks/{task}/progress', [TaskController::class, 'storeProgress'])->name('tasks.progress.store');
    });

    // --- Rute Pengaturan (untuk semua yang sudah login) ---
    // PERBAIKAN DI SINI: Grup Settings ditambahkan kembali secara lengkap
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index'); // Rute yang hilang
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
    });
});
