<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('dashboard.admin'));
Route::get('/dashboard-admin', fn() => view('dashboard.admin'))->name('dashboard.admin');
Route::get('/dashboard-team', fn() => view('dashboard.team'))->name('dashboard.team');
Route::get('/dashboard-client', fn() => view('dashboard.client'))->name('dashboard.client');

/*
|--------------------------------------------------------------------------
| Admin CRUD+index
|--------------------------------------------------------------------------
*/
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/{admin}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
});

/*
|--------------------------------------------------------------------------
| Projects CRUD
|--------------------------------------------------------------------------
*/

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

/*
|--------------------------------------------------------------------------
| Categories CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('categories')->group(function () {
    Route::get('/', [ProjectCategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [ProjectCategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [ProjectCategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [ProjectCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [ProjectCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [ProjectCategoryController::class, 'destroy'])->name('categories.destroy');
});

/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
*/

Route::prefix('settings')->name('settings.')->group(function () {
    // Static views
    Route::get('/', fn() => view('settings.index'))->name('index');
    Route::get('/preferences', fn() => view('settings.preferences'))->name('preferences');
    Route::get('/system', fn() => view('settings.system'))->name('system');
    Route::get('/notifications', fn() => view('settings.notifications'))->name('notifications');

    // Profile CRUD
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/settings-admin', fn() => view('settings.admin'))->name('settings.admin');


//* Notifications
Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
    Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
});

/*
|--------------------------------------------------------------------------
| Clients CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
});

/*
|--------------------------------------------------------------------------
| Users CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
