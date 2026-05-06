<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->registration) {
            return redirect()->route('student.dashboard')
                ->with('info', 'Kamu sudah mendaftar sebelumnya.');
        }

        return view('student.registration.create');
    }

    public function store(StoreRegistrationRequest $request)
    {
        $user = auth()->user();

        if ($user->registration) {
            return redirect()->route('student.dashboard')
                ->with('info', 'Kamu sudah mendaftar sebelumnya.');
        }

        $fotoPath = $request->file('foto')->store('registrations', 'public');

        Registration::create([
            'user_id'   => $user->id,
            'angkatan'  => $request->angkatan,
            'pilihan_1' => $request->pilihan_1,
            'alasan_1'  => $request->alasan_1,
            'pilihan_2' => $request->pilihan_2,
            'alasan_2'  => $request->alasan_2,
            'foto_path' => $fotoPath,
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Pendaftaran berhasil dikirim! Kami akan menghubungi kamu segera.');
    }
}
