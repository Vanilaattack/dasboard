<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAspirationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isStudent();
    }

    public function rules(): array
    {
        return [
            'display_name' => ['required', 'string', 'max:100'],
            'judul'        => ['required', 'string', 'max:200'],
            'isi_aspirasi' => ['required', 'string', 'min:20', 'max:3000'],
        ];
    }

    public function messages(): array
    {
        return [
            'display_name.required' => 'Nama/inisial wajib diisi.',
            'judul.required'        => 'Judul aspirasi wajib diisi.',
            'isi_aspirasi.required' => 'Isi aspirasi wajib diisi.',
            'isi_aspirasi.min'      => 'Isi aspirasi minimal 20 karakter.',
        ];
    }
}
