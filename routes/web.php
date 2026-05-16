<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;

// --- LANDING PAGE ---
Route::get('/', function () {
    return view('auth.login');
});

// --- AUTHENTICATION ROUTES ---
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register/continue', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login/submit', [AuthController::class, 'login'])->name('login.post');

Route::get('/login/google', [AuthController::class, 'googleLogin'])->name('login.google');
Route::post('/login/google', [AuthController::class, 'googleAuthenticate'])->name('login.google.submit');

// --- USER DASHBOARD ROUTES ---
Route::get('/dashboard', function () {
    $issues = \App\Models\Issue::where('user_id', auth()->id())->latest()->get();
    return view('dashboard', compact('issues'));
})->middleware('auth')->name('dashboard');

Route::get('/my-report', function () {
    $issues = \App\Models\Issue::where('user_id', auth()->id())->latest()->get();
    return view('my_report', compact('issues'));
})->middleware('auth')->name('my_report');

// --- ISSUE REPORTING ---
Route::get('/report-issue', function () {
    return view('report_issue');
})->middleware('auth')->name('report_issue');

Route::post('/submit-issue', [IssueController::class, 'store'])->middleware('auth')->name('issue.store');

// --- ADMIN ROUTES ---
Route::get('/admin-dashboard', function () {
    $issues = \App\Models\Issue::latest()->get();
    return view('admin_dashboard', compact('issues'));
})->middleware('auth')->name('admin.dashboard');

Route::patch('/admin/issues/{id}/status', [IssueController::class, 'updateStatus'])->middleware('auth')->name('admin.updateStatus');
Route::patch('/admin/images/{id}/priority', [IssueController::class, 'updateImagePriority'])->middleware('auth')->name('admin.updateImagePriority');
Route::get('/api/issues/{id}/images', [IssueController::class, 'getIssueImages'])->middleware('auth');
Route::delete('/admin/issues/{id}', [IssueController::class, 'destroy'])->middleware('auth')->name('admin.deleteIssue');

// --- LOGOUT ---
Route::post('/logout', function (Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');
=======

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> 2b5decb5631c906c7f5cc1f38fecf5e4bb72bd23
