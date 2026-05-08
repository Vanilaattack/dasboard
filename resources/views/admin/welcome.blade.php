<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang Admin — Himpunan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background-color: #0f1e35;
            background-image:
                radial-gradient(at 20% 20%, rgba(37,177,224,0.18) 0px, transparent 55%),
                radial-gradient(at 80% 80%, rgba(14,140,180,0.15) 0px, transparent 50%);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card {
            background: rgba(15,30,55,0.70);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(37,177,224,0.20);
            box-shadow: 0 12px 48px rgba(0,0,0,0.40);
            animation: fadeUp 0.5s ease both;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        <div class="card rounded-3xl p-10 text-center">

            {{-- Ikon --}}
            <div class="w-20 h-20 rounded-2xl mx-auto mb-6 flex items-center justify-center shadow-lg"
                 style="background: linear-gradient(135deg, #1e3a5f, #0f2540);
                        border: 1px solid rgba(37,177,224,0.30)">
                <svg class="w-10 h-10" style="color:#25B1E0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944
                             a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9
                             c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622
                             0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>

            {{-- Pesan --}}
            <h1 class="text-2xl font-extrabold leading-snug" style="color:#f0f9ff">
                Selamat Datang,<br>
                Admin!
            </h1>

            <p class="text-sm mt-3" style="color:rgba(255,255,255,0.50)">
                Halo <span class="font-semibold" style="color:#25B1E0">{{ auth()->user()->name }}</span>,
                kamu masuk sebagai Administrator.
            </p>

            {{-- Tombol Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold transition-all hover:opacity-90"
                    style="background: linear-gradient(135deg, #1e3a5f, #0f2540);
                           border: 1px solid rgba(37,177,224,0.30); color:#fff">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>

        </div>

        <p class="text-center text-xs mt-5" style="color:rgba(255,255,255,0.25)">
            &copy; {{ date('Y') }} Himpunan Mahasiswa &mdash; Admin Panel
        </p>
    </div>

</body>
</html>