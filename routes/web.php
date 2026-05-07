<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| This file is where you register all the routes for your application.
| These routes are loaded by the RouteServiceProvider.
|
*/

// --- LANDING PAGE ---
// Redirects the base URL to the login page
Route::get('/', function () {
    return view('auth.login');
});

// --- AUTHENTICATION ROUTES ---
// Routes for user registration
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Processes the registration form submission
Route::post('/register/continue', [AuthController::class, 'register'])->name('register.post');

// Routes for user login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Processes the login credentials
Route::post('/login/submit', [AuthController::class, 'login'])->name('login.post');

// Google sign-in mock flow
Route::get('/login/google', [AuthController::class, 'googleLogin'])->name('login.google');
Route::post('/login/google', [AuthController::class, 'googleAuthenticate'])->name('login.google.submit');

// --- USER DASHBOARD ROUTES ---
// Displays the main dashboard with all reported issues except dpt 213 and room 302
Route::get('/dashboard', function () {
    $issues = \App\Models\Issue::whereNotIn('location', ['dpt 213', 'room 302'])->latest()->get();
    return view('dashboard', compact('issues'));
})->name('dashboard');

// Displays reports specifically submitted by the logged-in user
Route::get('/my-report', function () {
    // Display all issues except dpt 213 and room 302, with ability to filter by student ID on the frontend
    $issues = \App\Models\Issue::whereNotIn('location', ['dpt 213', 'room 302'])->latest()->get();
    return view('my_report', compact('issues'));
})->name('my_report');

// --- ISSUE REPORTING ---
// Displays the form to report a new facility issue
Route::get('/report-issue', function () {
    return view('report_issue');
})->name('report_issue');

// Processes the new issue submission to the database
Route::post('/submit-issue', [IssueController::class, 'store'])->name('issue.store');

// --- ADMIN ROUTES ---
// Displays the admin dashboard with management controls
Route::get('/admin-dashboard', function () {
    $issues = \App\Models\Issue::whereNotIn('location', ['dpt 213', 'room 302'])->latest()->get(); // Fetches issues for administrative review excluding dpt 213 and room 302
    return view('admin_dashboard', compact('issues'));
})->name('admin.dashboard');

// Updates the status of an issue (e.g., Pending to Ongoing)
Route::patch('/admin/issues/{id}/status', [IssueController::class, 'updateStatus'])->name('admin.updateStatus');

// Updates the priority of a specific image attached to an issue
Route::patch('/admin/images/{id}/priority', [IssueController::class, 'updateImagePriority'])->name('admin.updateImagePriority');

// API endpoint to fetch images for a specific issue
Route::get('/api/issues/{id}/images', [IssueController::class, 'getIssueImages']);

// Permanently deletes an issue report from the database
Route::delete('/admin/issues/{id}', [IssueController::class, 'destroy'])->name('admin.deleteIssue');

// --- LOGOUT ---
// Clears the user session and redirects to the login page
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');