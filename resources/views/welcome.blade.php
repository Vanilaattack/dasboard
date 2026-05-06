<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himpunan Mahasiswa - Selamat Datang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    {{-- Hero Section --}}
    <div class="min-h-screen flex flex-col">

        {{-- Navbar --}}
        <nav class="bg-white/80 backdrop-blur-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background-color:#25B1E0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <span class="font-bold text-gray-800 text-lg">Himpunan</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors px-4 py-2 rounded-lg hover:bg-gray-100">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-sm font-medium text-white px-4 py-2 rounded-lg transition-all hover:opacity-90 shadow-sm"
                            style="background-color:#25B1E0">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Hero --}}
        <div class="flex-1 flex items-center justify-center px-4 py-20">
            <div class="max-w-4xl mx-auto text-center">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-4 py-2 rounded-full mb-8 border border-blue-100">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Pendaftaran Anggota Baru Dibuka!
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Bergabung dengan
                    <span style="color:#25B1E0">Himpunan</span>
                    <br>Mahasiswa Kami
                </h1>

                <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Jadilah bagian dari komunitas mahasiswa yang aktif, kreatif, dan berdampak.
                    Daftarkan dirimu sekarang dan mulai perjalananmu bersama kami.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 text-white font-semibold px-8 py-4 rounded-xl transition-all hover:opacity-90 shadow-lg hover:shadow-xl text-base"
                        style="background-color:#25B1E0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar Sebagai Anggota
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-gray-700 font-semibold px-8 py-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 transition-all bg-white text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Sudah Punya Akun
                    </a>
                </div>

                {{-- Stats --}}
                <div class="mt-16 grid grid-cols-3 gap-8 max-w-lg mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900">500+</div>
                        <div class="text-sm text-gray-500 mt-1">Anggota Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900">12</div>
                        <div class="text-sm text-gray-500 mt-1">Divisi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900">50+</div>
                        <div class="text-sm text-gray-500 mt-1">Program Kerja</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Features --}}
        <div class="bg-white border-t border-gray-100 py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-10">Apa yang bisa kamu lakukan?</h2>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="flex gap-4 p-6 rounded-2xl bg-gray-50 hover:bg-blue-50 transition-colors group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform" style="background-color:#25B1E0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Form Pendaftaran</h3>
                            <p class="text-sm text-gray-500">Daftarkan dirimu sebagai anggota himpunan dengan mengisi form pendaftaran lengkap.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-6 rounded-2xl bg-gray-50 hover:bg-blue-50 transition-colors group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform" style="background-color:#25B1E0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Kirim Aspirasi</h3>
                            <p class="text-sm text-gray-500">Sampaikan ide, saran, atau kritikmu secara anonim atau dengan nama terang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="border-t border-gray-100 py-6 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Himpunan Mahasiswa &mdash; Dibuat dengan ❤️
        </footer>
    </div>

</body>
</html>
