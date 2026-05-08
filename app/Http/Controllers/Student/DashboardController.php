<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $registration = $user->registration;
        $aspirations = $user->aspirations()->latest()->get();

        return view('student.dashboard', compact('user', 'registration', 'aspirations'));
    }

    /**
     * Halaman selamat datang setelah login mahasiswa.
     */
    public function welcome()
    {
        return view('student.welcome');
    }
}
