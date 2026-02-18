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
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

// --- Rute Publik (Guest) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/', fn() => redirect()->route('login'));

// --- Rute Terproteksi (Auth) ---
Route::middleware(['auth'])->group(function () {

    // --- Rute Dasbor ---
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin')->middleware('role:Admin');
    Route::get('/dashboard-team', [TeamController::class, 'index'])->name('dashboard.team')->middleware('role:Team,Admin');
    Route::get('/dashboard-client', [ClientController::class, 'dashboard'])->name('dashboard.client')->middleware('role:Client');

    // --- RUTE HISTORY (WAJIB DI ATAS RESOURCE AGAR TIDAK BENTROK BIGINT) ---
    Route::get('/projects/history', [ProjectController::class, 'history'])->name('projects.history');

    // --- MANAJEMEN PROYEK ---
    Route::resource('projects', ProjectController::class);


    // --- RUTE UNTUK KLIEN ---
    Route::get('/client/projects/create', [ClientController::class, 'createProjectForm'])->name('client.projects.create')->middleware('role:Client');
    Route::post('/client/projects', [ClientController::class, 'storeProject'])->name('client.projects.store')->middleware('role:Client');
    Route::get('/client/projects/{project}/edit', [ClientController::class, 'editProjectForm'])->name('client.projects.edit')->middleware('role:Client');
    Route::put('/client/projects/{project}', [ClientController::class, 'updateProject'])->name('client.projects.update')->middleware('role:Client');
    Route::get('/client/projects/{project}/detail', [ClientController::class, 'showProject'])->name('client.projects.show')->middleware('role:Client');

    // --- PROFIL ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // --- KHUSUS ADMIN ---
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::resource('clients', ClientController::class);
        Route::get('/projects/{project}/report', [ProjectController::class, 'generateReport'])->name('projects.delivery.report')->middleware('role:Admin');
    });

    // --- ADMIN & TIM ---
    Route::middleware(['role:Admin,Team'])->group(function () {
        Route::resource('categories', ProjectCategoryController::class);
        Route::resource('projects.tasks', TaskController::class);
        Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::post('/tasks/{task}/progress', [TaskController::class, 'storeProgress'])->name('tasks.progress.store');
        Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });

    // --- FITUR DELIVERY (HASIL PENGERJAAN) ---
    Route::prefix('projects/{project}/delivery')->name('projects.delivery.')->group(function () {
        // Team & Admin bisa buka halaman & upload
        Route::middleware(['role:Admin,Team'])->group(function () {
            Route::get('/', [ProjectController::class, 'showDelivery'])->name('index');
            Route::post('/', [ProjectController::class, 'storeDelivery'])->name('store');
        });

        // Client cuma bisa lihat & download
        Route::get('/view', [ProjectController::class, 'showDelivery'])->name('view')->middleware('role:Client');

        // Admin bisa generate laporan otomatis dari sini
        Route::get('/report', [ProjectController::class, 'generateReport'])->name('report')->middleware('role:Admin');
    });

    // --- SETTINGS ---
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
    });
});
