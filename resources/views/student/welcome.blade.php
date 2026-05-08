<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang — Himpunan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background-color: #e8f7fd;
            background-image:
                radial-gradient(at 15% 20%, rgba(37,177,224,0.30) 0px, transparent 55%),
                radial-gradient(at 85% 80%, rgba(14,140,180,0.20) 0px, transparent 50%);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card {
            background: rgba(255,255,255,0.65);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.80);
            box-shadow: 0 12px 40px rgba(37,177,224,0.15);
            animation: fadeUp 0.5s ease both;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        <div class="card rounded-3xl p-10 text-center">

            {{-- Ikon --}}
            <div class="w-20 h-20 rounded-2xl mx-auto mb-6 flex items-center justify-center shadow-lg"
                 style="background: linear-gradient(135deg, #25B1E0, #1a9bc5)">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804
                             M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            {{-- Pesan --}}
            <h1 class="text-2xl font-extrabold text-gray-900 leading-snug">
                Selamat Datang,<br>
                Anda Berhasil Login!
            </h1>

            <p class="text-gray-500 text-sm mt-3">
                Halo <span class="font-semibold" style="color:#25B1E0">{{ auth()->user()->name }}</span>,
                kamu masuk sebagai Mahasiswa.
            </p>

            {{-- Tombol Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white transition-all hover:opacity-90"
                    style="background: linear-gradient(135deg, #25B1E0, #1a9bc5)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>

        </div>

        <p class="text-center text-xs text-gray-400 mt-5">
            &copy; {{ date('Y') }} Himpunan Mahasiswa
        </p>
    </div>

</body>
</html>