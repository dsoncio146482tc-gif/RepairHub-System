<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Add a route for the registration page
Route::get('/register', function () {
    return view('auth.register');
});

// Dashboard route after sign in
Route::get('/dashboard', function () {
    return view('dashboard');
});
