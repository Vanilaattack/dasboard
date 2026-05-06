@extends('layouts.app')

@section('title', 'Form Pendaftaran')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- Back --}}
    <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Form Pendaftaran Anggota</h1>
        <p class="text-gray-500 text-sm mt-1">Isi data dengan lengkap dan benar. Pastikan foto yang diunggah jelas.</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50" style="background: linear-gradient(135deg, #25B1E0 0%, #1a9bc5 100%)">
            <h2 class="font-semibold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Data Pendaftaran
            </h2>
        </div>

        <form method="POST" action="{{ route('student.registration.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            {{-- Angkatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Angkatan <span class="text-red-400">*</span>
                </label>
                <input type="text" name="angkatan" value="{{ old('angkatan') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('angkatan') border-red-300 bg-red-50 @enderror"
                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                    onblur="this.style.borderColor=''; this.style.boxShadow=''"
                    placeholder="Contoh: 2024">
                @error('angkatan')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 pt-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Pilihan Divisi</p>
            </div>

            {{-- Pilihan 1 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Pilihan Divisi Pertama <span class="text-red-400">*</span>
                </label>
                <select name="pilihan_1"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all bg-white @error('pilihan_1') border-red-300 bg-red-50 @enderror"
                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                    onblur="this.style.borderColor=''; this.style.boxShadow=''">
                    <option value="">-- Pilih Divisi --</option>
                    @foreach(['Akademik', 'Kewirausahaan', 'Sosial & Masyarakat', 'Seni & Budaya', 'Olahraga', 'Teknologi & Informasi', 'Humas & Komunikasi', 'Penelitian & Pengembangan'] as $divisi)
                        <option value="{{ $divisi }}" {{ old('pilihan_1') == $divisi ? 'selected' : '' }}>{{ $divisi }}</option>
                    @endforeach
                </select>
                @error('pilihan_1')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alasan 1 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Alasan Memilih Divisi Pertama <span class="text-red-400">*</span>
                </label>
                <textarea name="alasan_1" rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all resize-none @error('alasan_1') border-red-300 bg-red-50 @enderror"
                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                    onblur="this.style.borderColor=''; this.style.boxShadow=''"
                    placeholder="Ceritakan alasan dan motivasimu memilih divisi ini...">{{ old('alasan_1') }}</textarea>
                @error('alasan_1')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilihan 2 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Pilihan Divisi Kedua
                    <span class="text-xs text-gray-400 font-normal ml-1">(opsional)</span>
                </label>
                <select name="pilihan_2"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all bg-white"
                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                    onblur="this.style.borderColor=''; this.style.boxShadow=''">
                    <option value="">-- Tidak Ada --</option>
                    @foreach(['Akademik', 'Kewirausahaan', 'Sosial & Masyarakat', 'Seni & Budaya', 'Olahraga', 'Teknologi & Informasi', 'Humas & Komunikasi', 'Penelitian & Pengembangan'] as $divisi)
                        <option value="{{ $divisi }}" {{ old('pilihan_2') == $divisi ? 'selected' : '' }}>{{ $divisi }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Alasan 2 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Alasan Memilih Divisi Kedua
                    <span class="text-xs text-gray-400 font-normal ml-1">(opsional)</span>
                </label>
                <textarea name="alasan_2" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all resize-none"
                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                    onblur="this.style.borderColor=''; this.style.boxShadow=''"
                    placeholder="Alasan memilih divisi kedua...">{{ old('alasan_2') }}</textarea>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 pt-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Upload Foto</p>
            </div>

            {{-- Foto --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Foto Diri <span class="text-red-400">*</span>
                </label>
                <div x-data="{ preview: null }"
                    class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-300 transition-colors"
                    :class="preview ? 'border-solid border-blue-200 bg-blue-50' : ''">

                    <input type="file" name="foto" id="foto" accept="image/*"
                        class="hidden"
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = e => preview = e.target.result;
                                reader.readAsDataURL(file);
                            }
                        ">

                    <template x-if="!preview">
                        <label for="foto" class="cursor-pointer block">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3 bg-gray-100">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-600">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, JPEG, PNG, WEBP — Maks. 2MB</p>
                        </label>
                    </template>

                    <template x-if="preview">
                        <div>
                            <img :src="preview" class="w-32 h-32 object-cover rounded-xl mx-auto mb-3 shadow-sm">
                            <label for="foto" class="cursor-pointer text-xs font-medium hover:underline" style="color:#25B1E0">
                                Ganti foto
                            </label>
                        </div>
                    </template>
                </div>
                @error('foto')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full text-white font-semibold py-3.5 px-4 rounded-xl transition-all hover:opacity-90 shadow-sm"
                    style="background-color:#25B1E0">
                    Kirim Pendaftaran
                </button>
                <p class="text-xs text-gray-400 text-center mt-3">
                    Pastikan semua data sudah benar sebelum mengirim. Pendaftaran hanya bisa dilakukan sekali.
                </p>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
@endpush

@endsection
