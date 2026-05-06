<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAspirationRequest;
use App\Models\Aspiration;

class AspirationController extends Controller
{
    public function create()
    {
        return view('student.aspiration.create');
    }

    public function store(StoreAspirationRequest $request)
    {
        Aspiration::create([
            'user_id'      => auth()->id(),
            'display_name' => $request->display_name,
            'judul'        => $request->judul,
            'isi_aspirasi' => $request->isi_aspirasi,
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Aspirasi berhasil dikirim! Terima kasih atas masukanmu.');
    }
}
