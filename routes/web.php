<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController; // Pastikan controller ini ada, kalau error hapus baris ini
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

// --- Rute Publik (Guest) ---
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Register (Sign Up)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Logout (Wajib POST demi keamanan)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));


// ====================================================
// "ZONA AMAN": Semua rute di bawah ini WAJIB LOGIN
// ====================================================
Route::middleware(['auth'])->group(function () {

    // --- Rute Dasbor ---
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin')->middleware('role:admin');
    Route::get('/dashboard-team', [TeamController::class, 'index'])->name('dashboard.team')->middleware('role:team,admin');
    Route::get('/dashboard-client', [ClientController::class, 'dashboard'])->name('dashboard.client')->middleware('role:client');

    // --- RUTE UNTUK KLIEN MENGELOLA PROYEK ---
    Route::get('/client/projects/create', [ClientController::class, 'createProjectForm'])->name('client.projects.create')->middleware('role:client');
    Route::post('/client/projects', [ClientController::class, 'storeProject'])->name('client.projects.store')->middleware('role:client');
    Route::get('/client/projects/{project}/edit', [ClientController::class, 'editProjectForm'])->name('client.projects.edit')->middleware('role:client');
    Route::put('/client/projects/{project}', [ClientController::class, 'updateProject'])->name('client.projects.update')->middleware('role:client');
    Route::get('/client/projects/{project}/detail', [ClientController::class, 'showProject'])->name('client.projects.show')->middleware('role:client');


    // --- MANAJEMEN USER & PROFIL (UMUM) ---
    // Dipisah dari grup settings agar nama rutenya simpel: 'profile.edit'
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


    // --- GRUP RUTE KHUSUS ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        // User Management (Custom AdminController)
        Route::get('/users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Client Management (Resource)
        Route::resource('clients', ClientController::class);
    });
    // lihat history proyek
    Route::get('/projects/history', [App\Http\Controllers\ProjectController::class, 'history'])->name('projects.history');
    // --- GRUP RUTE ADMIN & TIM (MANAJEMEN PROYEK) ---
    Route::middleware(['role:admin,team'])->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('categories', ProjectCategoryController::class);
        Route::resource('projects.tasks', TaskController::class)->shallow();

        // Task Progress
        Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::post('/tasks/{task}/progress', [TaskController::class, 'storeProgress'])->name('tasks.progress.store');
    });


    // --- RUTE PENGATURAN LAINNYA ---
    // Sisa rute settings (selain profile)
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index'); // settings.index
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
    });
});
