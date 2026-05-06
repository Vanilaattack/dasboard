@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

{{-- Header --}}
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Halo, <span class="font-medium text-gray-700">{{ $user->name }}</span>! NIM: {{ $user->nim }}</p>
</div>

{{-- Status Cards --}}
<div class="grid sm:grid-cols-2 gap-4 mb-8">
    {{-- Status Pendaftaran --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Status Pendaftaran</span>
            @if($registration)
                <span class="text-xs px-2.5 py-1 rounded-full font-medium bg-green-100 text-green-700">Sudah Daftar</span>
            @else
                <span class="text-xs px-2.5 py-1 rounded-full font-medium bg-yellow-100 text-yellow-700">Belum Daftar</span>
            @endif
        </div>
        @if($registration)
            <p class="text-sm text-gray-600">Pilihan: <span class="font-semibold text-gray-800">{{ $registration->pilihan_1 }}</span></p>
            <p class="text-xs text-gray-400 mt-1">Dikirim {{ $registration->created_at->diffForHumans() }}</p>
        @else
            <p class="text-sm text-gray-500">Kamu belum mengisi form pendaftaran.</p>
        @endif
    </div>

    {{-- Aspirasi --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-500">Aspirasi Terkirim</span>
            <span class="text-2xl font-bold" style="color:#25B1E0">{{ $aspirations->count() }}</span>
        </div>
        <p class="text-sm text-gray-500">Total aspirasi yang sudah kamu kirimkan.</p>
    </div>
</div>

{{-- Tab Navigation --}}
<div x-data="{ tab: '{{ $registration ? 'aspiration' : 'registration' }}' }">

    <div class="flex gap-1 bg-gray-100 p-1 rounded-xl mb-6 w-fit">
        <button @click="tab = 'registration'"
            :class="tab === 'registration' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'"
            class="px-5 py-2.5 rounded-lg text-sm transition-all">
            📋 Form Pendaftaran
        </button>
        <button @click="tab = 'aspiration'"
            :class="tab === 'aspiration' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'"
            class="px-5 py-2.5 rounded-lg text-sm transition-all">
            💬 Kirim Aspirasi
        </button>
    </div>

    {{-- Tab: Pendaftaran --}}
    <div x-show="tab === 'registration'" x-transition>
        @if($registration)
            {{-- Sudah Daftar --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color:#25B1E0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Data Pendaftaranmu</h2>
                </div>
                <div class="p-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Angkatan</p>
                                <p class="text-gray-800 font-medium mt-0.5">{{ $registration->angkatan }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Pilihan Divisi 1</p>
                                <p class="text-gray-800 font-medium mt-0.5">{{ $registration->pilihan_1 }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Alasan Pilihan 1</p>
                                <p class="text-gray-600 text-sm mt-0.5 leading-relaxed">{{ $registration->alasan_1 }}</p>
                            </div>
                            @if($registration->pilihan_2)
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Pilihan Divisi 2</p>
                                <p class="text-gray-800 font-medium mt-0.5">{{ $registration->pilihan_2 }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-3 self-start">Foto</p>
                            <img src="{{ Storage::url($registration->foto_path) }}"
                                alt="Foto Pendaftaran"
                                class="w-40 h-40 object-cover rounded-2xl border-4 border-gray-100 shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Belum Daftar --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background-color:#EBF8FD">
                    <svg class="w-8 h-8" style="color:#25B1E0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Belum Mendaftar</h3>
                <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">Kamu belum mengisi form pendaftaran anggota. Yuk daftar sekarang dan bergabung bersama kami!</p>
                <a href="{{ route('student.registration.create') }}"
                    class="inline-flex items-center gap-2 text-white font-semibold px-6 py-3 rounded-xl transition-all hover:opacity-90 shadow-sm text-sm"
                    style="background-color:#25B1E0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Isi Form Pendaftaran
                </a>
            </div>
        @endif
    </div>

    {{-- Tab: Aspirasi --}}
    <div x-show="tab === 'aspiration'" x-transition>
        <div class="grid lg:grid-cols-5 gap-6">
            {{-- Form Aspirasi --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color:#25B1E0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-gray-800">Kirim Aspirasi Baru</h2>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('student.aspiration.store') }}" class="space-y-5">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nama / Inisial
                                    <span class="text-xs text-gray-400 font-normal ml-1">(boleh anonim)</span>
                                </label>
                                <input type="text" name="display_name" value="{{ old('display_name', $user->name) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('display_name') border-red-300 bg-red-50 @enderror"
                                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                                    onblur="this.style.borderColor=''; this.style.boxShadow=''"
                                    placeholder="Nama lengkap atau inisial (mis: A.B.)">
                                @error('display_name')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Aspirasi</label>
                                <input type="text" name="judul" value="{{ old('judul') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('judul') border-red-300 bg-red-50 @enderror"
                                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                                    onblur="this.style.borderColor=''; this.style.boxShadow=''"
                                    placeholder="Judul singkat aspirasi kamu">
                                @error('judul')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Isi Aspirasi</label>
                                <textarea name="isi_aspirasi" rows="5"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all resize-none @error('isi_aspirasi') border-red-300 bg-red-50 @enderror"
                                    onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                                    onblur="this.style.borderColor=''; this.style.boxShadow=''"
                                    placeholder="Tulis aspirasi, saran, atau kritik kamu di sini...">{{ old('isi_aspirasi') }}</textarea>
                                @error('isi_aspirasi')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full text-white font-semibold py-3 px-4 rounded-xl transition-all hover:opacity-90 shadow-sm text-sm"
                                style="background-color:#25B1E0">
                                Kirim Aspirasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Riwayat Aspirasi --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50">
                        <h2 class="font-semibold text-gray-800">Riwayat Aspirasi</h2>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($aspirations as $asp)
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-2 mb-1">
                                    <p class="text-sm font-semibold text-gray-800">{{ $asp->judul }}</p>
                                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $asp->created_at->format('d M') }}</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">oleh {{ $asp->display_name }}</p>
                                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $asp->isi_aspirasi }}</p>
                            </div>
                        @empty
                            <div class="p-8 text-center">
                                <p class="text-sm text-gray-400">Belum ada aspirasi yang dikirim.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
@endpush

@endsection
