<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\UserController;
//dashboard admin route
Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
})->name('dashboard.admin');

//route untuk Admins
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/{admin}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
});


Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/{project}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

});


// Route untuk Categories
Route::prefix('categories')->group(function () {
    Route::get('/', [ProjectCategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [ProjectCategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [ProjectCategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [ProjectCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [ProjectCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [ProjectCategoryController::class, 'destroy'])->name('categories.destroy');
});




// Kita beri nama 'dashboard.team' untuk route ini
Route::get('/dashboard-team', function () {
    return view('dashboard.team');
})->name('dashboard.team');

// Kita beri nama 'dashboard.client' untuk route ini
Route::get('/dashboard-client', function () {
    return view('dashboard.client');
})->name('dashboard.client');



// Route untuk resource Clients (CRUD)
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/{id}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
});


// Route untuk resource Users (CRUD)
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});





// Route default kita arahkan ke dashboard admin
Route::get('/', function() {
    return redirect()->route('dashboard.admin');
});
