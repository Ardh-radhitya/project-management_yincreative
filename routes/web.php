<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

// Kita beri nama 'dashboard.admin' untuk route ini
Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
})->name('dashboard.admin');

// Kita beri nama 'dashboard.team' untuk route ini
Route::get('/dashboard-team', function () {
    return view('dashboard.team');
})->name('dashboard.team');

// Kita beri nama 'dashboard.client' untuk route ini
Route::get('/dashboard-client', function () {
    return view('dashboard.client');
})->name('dashboard.client');

// Route untuk Projects
Route::get('/project', function () {
    return view('project.admin');
})->name('project.admin');


// Route untuk resource Clients (CRUD)
Route::resource('clients', ClientController::class);

// Route untuk Categories
Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

// Route untuk Users
Route::get('/users', function () {
    return view('users.index');
})->name('users.index');




// Route default kita arahkan ke dashboard admin
Route::get('/', function() {
    return redirect()->route('dashboard.admin');
});
