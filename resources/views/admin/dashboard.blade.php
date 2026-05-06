@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola pendaftaran dan aspirasi mahasiswa</p>
    </div>
    <div class="flex items-center gap-2 text-sm text-gray-500">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        {{ now()->isoFormat('D MMMM Y') }}
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Total Mahasiswa</span>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color:#EBF8FD">
                <svg class="w-4 h-4" style="color:#25B1E0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalStudents }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Pendaftar</span>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-green-50">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $registrations->count() }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Aspirasi</span>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-purple-50">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $aspirations->count() }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Belum Daftar</span>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-yellow-50">
                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalStudents - $registrations->count() }}</p>
    </div>
</div>

{{-- Tabs --}}
<div x-data="{ tab: 'registrations' }">

    <div class="flex gap-1 bg-gray-100 p-1 rounded-xl mb-6 w-fit">
        <button @click="tab = 'registrations'"
            :class="tab === 'registrations' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'"
            class="px-5 py-2.5 rounded-lg text-sm transition-all">
            📋 Daftar Pendaftar
            <span class="ml-1.5 text-xs px-1.5 py-0.5 rounded-full bg-gray-200 text-gray-600">{{ $registrations->count() }}</span>
        </button>
        <button @click="tab = 'aspirations'"
            :class="tab === 'aspirations' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'"
            class="px-5 py-2.5 rounded-lg text-sm transition-all">
            💬 Daftar Aspirasi
            <span class="ml-1.5 text-xs px-1.5 py-0.5 rounded-full bg-gray-200 text-gray-600">{{ $aspirations->count() }}</span>
        </button>
    </div>

    {{-- Tab: Pendaftar --}}
    <div x-show="tab === 'registrations'" x-transition>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50">
                <h2 class="font-semibold text-gray-800">Daftar Pendaftar Anggota</h2>
            </div>

            @if($registrations->isEmpty())
                <div class="p-12 text-center">
                    <p class="text-gray-400 text-sm">Belum ada pendaftar.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left">
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Mahasiswa</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Angkatan</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Pilihan 1</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Pilihan 2</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Foto</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Tanggal</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($registrations as $reg)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $reg->user->name }}</p>
                                            <p class="text-xs text-gray-400">NIM: {{ $reg->user->nim }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $reg->angkatan }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700">
                                            {{ $reg->pilihan_1 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($reg->pilihan_2)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
                                                {{ $reg->pilihan_2 }}
                                            </span>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <img src="{{ Storage::url($reg->foto_path) }}"
                                            alt="Foto {{ $reg->user->name }}"
                                            class="w-10 h-10 rounded-lg object-cover border border-gray-100 cursor-pointer hover:scale-110 transition-transform"
                                            onclick="document.getElementById('modal-{{ $reg->id }}').classList.remove('hidden')">
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 text-xs">{{ $reg->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.registration.show', $reg) }}"
                                                class="text-xs font-medium px-3 py-1.5 rounded-lg transition-colors hover:opacity-80 text-white"
                                                style="background-color:#25B1E0">
                                                Detail
                                            </a>
                                            <a href="{{ route('admin.registration.download', $reg) }}"
                                                class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                                                ↓ Foto
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Foto --}}
                                <div id="modal-{{ $reg->id }}" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4"
                                    onclick="this.classList.add('hidden')">
                                    <div class="bg-white rounded-2xl p-4 max-w-sm w-full" onclick="event.stopPropagation()">
                                        <div class="flex justify-between items-center mb-3">
                                            <p class="font-semibold text-gray-800">{{ $reg->user->name }}</p>
                                            <button onclick="document.getElementById('modal-{{ $reg->id }}').classList.add('hidden')"
                                                class="text-gray-400 hover:text-gray-600">✕</button>
                                        </div>
                                        <img src="{{ Storage::url($reg->foto_path) }}"
                                            alt="Foto {{ $reg->user->name }}"
                                            class="w-full rounded-xl object-cover max-h-80">
                                        <a href="{{ route('admin.registration.download', $reg) }}"
                                            class="mt-3 w-full flex items-center justify-center gap-2 text-sm font-medium text-white py-2.5 rounded-xl transition-all hover:opacity-90"
                                            style="background-color:#25B1E0">
                                            Download Foto
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Tab: Aspirasi --}}
    <div x-show="tab === 'aspirations'" x-transition>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50">
                <h2 class="font-semibold text-gray-800">Daftar Aspirasi Mahasiswa</h2>
            </div>

            @if($aspirations->isEmpty())
                <div class="p-12 text-center">
                    <p class="text-gray-400 text-sm">Belum ada aspirasi yang masuk.</p>
                </div>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($aspirations as $asp)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                            style="background-color:#25B1E0">
                                            {{ strtoupper(substr($asp->display_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm">{{ $asp->judul }}</p>
                                            <p class="text-xs text-gray-400">oleh <span class="font-medium text-gray-600">{{ $asp->display_name }}</span></p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 leading-relaxed ml-11">{{ $asp->isi_aspirasi }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-xs text-gray-400">{{ $asp->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-300 mt-0.5">{{ $asp->created_at->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>

@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
@endpush

@endsection
