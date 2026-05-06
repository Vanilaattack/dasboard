<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\AspirationController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\RegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Landing Page ────────────────────────────────────────────────────────────
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('student.dashboard');
    }
    return view('welcome');
})->name('home');

// ─── Auth Routes (Breeze) ─────────────────────────────────────────────────────
require __DIR__ . '/auth.php';

// ─── Redirect after login based on role ──────────────────────────────────────
Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── Student Routes ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'student'])->prefix('mahasiswa')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // Pendaftaran
    Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('registration.create');
    Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('registration.store');

    // Aspirasi
    Route::get('/aspirasi', [AspirationController::class, 'create'])->name('aspiration.create');
    Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspiration.store');
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftaran/{registration}', [AdminDashboardController::class, 'showRegistration'])->name('registration.show');
    Route::get('/pendaftaran/{registration}/download', [AdminDashboardController::class, 'downloadFoto'])->name('registration.download');
});

// ─── Profile (Breeze default) ─────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
