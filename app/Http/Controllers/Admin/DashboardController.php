<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Registration;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $registrations = Registration::with('user')->latest()->get();
        $aspirations   = Aspiration::with('user')->latest()->get();
        $totalStudents = User::where('role', 'student')->count();

        return view('admin.dashboard', compact('registrations', 'aspirations', 'totalStudents'));
    }

    /**
     * Halaman selamat datang setelah login admin.
     */
    public function welcome()
    {
        return view('admin.welcome');
    }

    public function showRegistration(Registration $registration)
    {
        $registration->load('user');
        return view('admin.registration.show', compact('registration'));
    }

    public function downloadFoto(Registration $registration)
    {
        $path = storage_path('app/public/' . $registration->foto_path);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($path);
    }
}
