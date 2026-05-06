<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Himpunan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg" style="background-color:#25B1E0">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-800 text-xl">Himpunan</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 mt-4">Buat akun baru</h1>
            <p class="text-gray-500 text-sm mt-1">Bergabung dengan himpunan mahasiswa kami</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('name') border-red-300 bg-red-50 @enderror"
                        onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                        onblur="this.style.borderColor=''; this.style.boxShadow=''"
                        placeholder="Nama lengkap kamu">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NIM --}}
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700 mb-1.5">NIM</label>
                    <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('nim') border-red-300 bg-red-50 @enderror"
                        onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                        onblur="this.style.borderColor=''; this.style.boxShadow=''"
                        placeholder="Nomor Induk Mahasiswa">
                    @error('nim')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('email') border-red-300 bg-red-50 @enderror"
                        onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                        onblur="this.style.borderColor=''; this.style.boxShadow=''"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all @error('password') border-red-300 bg-red-50 @enderror"
                        onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                        onblur="this.style.borderColor=''; this.style.boxShadow=''"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none transition-all"
                        onfocus="this.style.borderColor='#25B1E0'; this.style.boxShadow='0 0 0 3px rgba(37,177,224,0.15)'"
                        onblur="this.style.borderColor=''; this.style.boxShadow=''"
                        placeholder="Ulangi password">
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full text-white font-semibold py-3 px-4 rounded-xl transition-all hover:opacity-90 shadow-sm text-sm"
                    style="background-color:#25B1E0">
                    Buat Akun
                </button>
            </form>
        </div>

        {{-- Login Link --}}
        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color:#25B1E0">
                Masuk di sini
            </a>
        </p>

    </div>

</body>
</html>
