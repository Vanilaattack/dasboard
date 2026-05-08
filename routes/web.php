<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\AspirationController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\RegistrationController;
use Illuminate\Support\Facades\Route;

// ─── Root & Login: tampil langsung di / ──────────────────────────────────────
// GET / → tampilkan form login langsung (tidak ada landing page)
// Jika sudah login → redirect ke welcome sesuai role
Route::get('/', [AuthController::class, 'showLogin'])->name('home');

Route::middleware('guest')->group(function () {
    // /login alias ke / agar link lama tetap bekerja
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    // POST: Login Admin → Session Only
    Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

    // POST: Login Mahasiswa → Cookie Remember Me
    Route::post('/login/student', [AuthController::class, 'loginStudent'])->name('login.student');

    // POST: Reset password admin
    Route::post('/admin/reset-password', [AuthController::class, 'resetAdminPassword'])->name('admin.reset-password');

    // Register Mahasiswa
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Redirect /dashboard → role-based ────────────────────────────────────────
Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.welcome')
        : redirect()->route('student.welcome');
})->middleware('auth')->name('dashboard');

// ─── Student Routes ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'student'])->prefix('mahasiswa')->name('student.')->group(function () {
    Route::get('/welcome', [StudentDashboardController::class, 'welcome'])->name('welcome');
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('registration.create');
    Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('registration.store');
    Route::get('/aspirasi', [AspirationController::class, 'create'])->name('aspiration.create');
    Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspiration.store');
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/welcome', [AdminDashboardController::class, 'welcome'])->name('welcome');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftaran/{registration}', [AdminDashboardController::class, 'showRegistration'])->name('registration.show');
    Route::get('/pendaftaran/{registration}/download', [AdminDashboardController::class, 'downloadFoto'])->name('registration.download');
});

// ─── Profile ──────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
