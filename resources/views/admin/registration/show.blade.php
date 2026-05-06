@extends('layouts.app')

@section('title', 'Detail Pendaftar')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Back --}}
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pendaftar</h1>
            <p class="text-gray-500 text-sm mt-1">Data lengkap pendaftaran anggota</p>
        </div>
        <a href="{{ route('admin.registration.download', $registration) }}"
            class="inline-flex items-center gap-2 text-white font-semibold px-5 py-2.5 rounded-xl transition-all hover:opacity-90 shadow-sm text-sm"
            style="background-color:#25B1E0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download Foto
        </a>
    </div>

    <div class="grid sm:grid-cols-3 gap-6">

        {{-- Foto --}}
        <div class="sm:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <img src="{{ Storage::url($registration->foto_path) }}"
                    alt="Foto {{ $registration->user->name }}"
                    class="w-full aspect-square object-cover rounded-xl mb-4 shadow-sm">
                <p class="font-semibold text-gray-800">{{ $registration->user->name }}</p>
                <p class="text-sm text-gray-400 mt-0.5">NIM: {{ $registration->user->nim }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $registration->user->email }}</p>
            </div>
        </div>

        {{-- Data --}}
        <div class="sm:col-span-2 space-y-4">

            {{-- Info Dasar --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 rounded-full inline-block" style="background-color:#25B1E0"></span>
                    Informasi Dasar
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Angkatan</p>
                        <p class="text-gray-800 font-semibold mt-0.5">{{ $registration->angkatan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Tanggal Daftar</p>
                        <p class="text-gray-800 font-semibold mt-0.5">{{ $registration->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Pilihan 1 --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <span class="w-1 h-5 rounded-full inline-block" style="background-color:#25B1E0"></span>
                    Pilihan Divisi Pertama
                </h3>
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-blue-50 text-blue-700 mb-3">
                    {{ $registration->pilihan_1 }}
                </span>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $registration->alasan_1 }}</p>
            </div>

            {{-- Pilihan 2 --}}
            @if($registration->pilihan_2)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                    <span class="w-1 h-5 rounded-full inline-block bg-gray-300"></span>
                    Pilihan Divisi Kedua
                </h3>
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-gray-100 text-gray-700 mb-3">
                    {{ $registration->pilihan_2 }}
                </span>
                @if($registration->alasan_2)
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $registration->alasan_2 }}</p>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
