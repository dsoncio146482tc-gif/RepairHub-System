<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

// Add a route for the registration page
Route::get('/register', function () {
    return view('auth.register');
});

// Continue registration then go to homepage
Route::post('/register/continue', function () {
    return redirect('/dashboard');
});

// Dashboard route after sign in
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Report Issue page
Route::get('/report-issue', function () {
    return view('report_issue');
});

// Admin dashboard page
Route::get('/admin-dashboard', function () {
    return view('admin_dashboard');
});
