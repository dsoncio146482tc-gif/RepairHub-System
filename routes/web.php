<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Landing Page
Route::get('/', function () {
    return view('auth.register');
});

// --- REGISTER ROUTES ---
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register/continue', [AuthController::class, 'register'])->name('register.post');

// --- LOGIN ROUTES (Kani ang kulang nimo!) ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login/submit', [AuthController::class, 'login'])->name('login.post');

// --- DASHBOARDS ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/admin-dashboard', function () {
    return view('admin_dashboard');
})->name('admin.dashboard');

Route::get('/my-report', function () {
    return view('my_report');
})->name('my_report');

// --- OTHER PAGES ---
Route::get('/report-issue', function () {
    return view('report_issue');
})->name('report_issue');