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

// --- OTHER PAGES ---
Route::get('/report-issue', function () {
    return view('report_issue');
})->name('report_issue');

// -- para ni sa submit gois --
Route::post('/submit-issue', [App\Http\Controllers\IssueController::class, 'store']);

Route::get('/dashboard', function () {
    $issues = \App\Models\Issue::latest()->get();
    return view('dashboard', compact('issues'));
})->name('dashboard');

Route::get('/admin-dashboard', function () {
    $issues = \App\Models\Issue::latest()->get();
    return view('admin_dashboard', compact('issues'));
})->name('admin.dashboard');