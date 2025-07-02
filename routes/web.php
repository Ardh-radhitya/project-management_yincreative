<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.admin');
});

Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
});

Route::get('/dashboard-team', function () {
    return view('dashboard.team');
});

Route::get('/dashboard-client', function () {
    return view('dashboard.client');
});

Route::get('/projects', function () {
    return view('projects.index');
});

Route::get('/clients', function () {
    return view('clients.index');
});

Route::get('/categories', function () {
    return view('categories.index');
});

Route::get('/users', function () {
    return view('users.index');
});
