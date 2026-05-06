<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isStudent();
    }

    public function rules(): array
    {
        return [
            'angkatan'  => ['required', 'string', 'max:10'],
            'pilihan_1' => ['required', 'string', 'max:100'],
            'alasan_1'  => ['required', 'string', 'min:20', 'max:1000'],
            'pilihan_2' => ['nullable', 'string', 'max:100'],
            'alasan_2'  => ['nullable', 'string', 'max:1000'],
            'foto'      => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'angkatan.required'  => 'Angkatan wajib diisi.',
            'pilihan_1.required' => 'Pilihan divisi pertama wajib diisi.',
            'alasan_1.required'  => 'Alasan pilihan pertama wajib diisi.',
            'alasan_1.min'       => 'Alasan minimal 20 karakter.',
            'foto.required'      => 'Foto wajib diunggah.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.mimes'         => 'Format foto harus jpg, jpeg, png, atau webp.',
            'foto.max'           => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
