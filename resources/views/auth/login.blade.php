<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Himpunan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ── Animated mesh background ── */
        body {
            background-color: #e8f7fd;
            background-image:
                radial-gradient(at 20% 20%, rgba(37,177,224,0.25) 0px, transparent 55%),
                radial-gradient(at 80% 10%, rgba(37,177,224,0.15) 0px, transparent 50%),
                radial-gradient(at 60% 80%, rgba(14,140,180,0.20) 0px, transparent 50%),
                radial-gradient(at 10% 80%, rgba(255,255,255,0.80) 0px, transparent 50%);
            min-height: 100vh;
        }

        /* ── Glassmorphism card ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.75);
            box-shadow:
                0 8px 32px rgba(37, 177, 224, 0.12),
                0 2px 8px rgba(0,0,0,0.06),
                inset 0 1px 0 rgba(255,255,255,0.9);
        }

        /* ── Sliding tab indicator ── */
        .tab-slider {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        background-color 0.35s ease;
        }

        /* ── Input focus ring ── */
        .input-field {
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        }
        .input-field:focus {
            outline: none;
            border-color: #25B1E0;
            box-shadow: 0 0 0 3px rgba(37, 177, 224, 0.18);
            background-color: #fff;
        }
        .input-field.error {
            border-color: #f87171;
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.15);
        }

        /* ── Button hover ── */
        .btn-primary {
            background: linear-gradient(135deg, #25B1E0 0%, #1a9bc5 100%);
            transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.15s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 177, 224, 0.40);
            opacity: 0.95;
        }
        .btn-primary:active { transform: translateY(0); }

        .btn-admin {
            background: linear-gradient(135deg, #1e3a5f 0%, #0f2540 100%);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .btn-admin:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(15, 37, 64, 0.35);
        }
        .btn-admin:active { transform: translateY(0); }

        /* ── Fade-in-up animation ── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) both;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }

        /* ── Form transition ── */
        .form-panel {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .form-panel.hidden-panel {
            opacity: 0;
            transform: translateX(12px);
            pointer-events: none;
            position: absolute;
            width: 100%;
        }
        .form-panel.active-panel {
            opacity: 1;
            transform: translateX(0);
        }

        /* ── Password toggle ── */
        .pw-toggle { cursor: pointer; color: #9ca3af; transition: color 0.2s; }
        .pw-toggle:hover { color: #25B1E0; }

        /* ── Floating label dots ── */
        .role-dot {
            width: 8px; height: 8px; border-radius: 50%;
            display: inline-block; margin-right: 6px;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    {{-- ── Decorative blobs ── --}}
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full opacity-20"
             style="background: radial-gradient(circle, #25B1E0, transparent 70%);"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full opacity-15"
             style="background: radial-gradient(circle, #1a9bc5, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-10"
             style="background: radial-gradient(circle, #25B1E0, transparent 60%);"></div>
    </div>

    <div class="w-full max-w-md animate-fade-in-up">

        {{-- ── Logo ── --}}
        <div class="text-center mb-8 animate-fade-in-up delay-100">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg"
                     style="background: linear-gradient(135deg, #25B1E0, #1a9bc5)">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-800 text-xl tracking-tight">Himpunan</span>
            </a>
            <p class="text-gray-500 text-sm mt-2">Masuk ke akun kamu</p>
        </div>

        {{-- ── Glass Card ── --}}
        <div class="glass-card rounded-3xl p-8 animate-fade-in-up delay-200">

            {{-- ── Status / Logout message ── --}}
            @if(session('status'))
                <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl text-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            {{-- ── Sliding Tab: Mahasiswa / Admin ── --}}
            <div id="tabContainer" class="relative flex bg-gray-100/80 rounded-2xl p-1 mb-7">
                {{-- Sliding indicator --}}
                <div id="tabSlider"
                     class="tab-slider absolute top-1 bottom-1 w-[calc(50%-4px)] rounded-xl shadow-sm"
                     style="background: linear-gradient(135deg, #25B1E0, #1a9bc5); left: 4px;">
                </div>

                <button id="tabStudent" onclick="switchTab('student')"
                    class="relative z-10 flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition-colors duration-300"
                    style="color: white;">
                    <span class="role-dot" id="dotStudent" style="background:#fff"></span>
                    Mahasiswa
                </button>

                <button id="tabAdmin" onclick="switchTab('admin')"
                    class="relative z-10 flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition-colors duration-300"
                    style="color: #6b7280;">
                    <span class="role-dot" id="dotAdmin" style="background:#9ca3af"></span>
                    Admin
                </button>
            </div>

            {{-- ── FORM MAHASISWA ── --}}
            <div id="formStudent" class="form-panel active-panel">

                {{-- Error mahasiswa --}}
                @if($errors->has('student_email') || $errors->has('student_password'))
                    <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            @foreach($errors->get('student_email') as $err)
                                <p>{{ $err }}</p>
                            @endforeach
                            @foreach($errors->get('student_password') as $err)
                                <p>{{ $err }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.student') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-gray-400" style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input type="email" name="student_email"
                                value="{{ old('student_email') }}"
                                placeholder="email@mahasiswa.ac.id"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('student_email') ? 'error border-red-300' : 'border-gray-200' }}"
                                autocomplete="email">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" name="student_password" id="studentPw"
                                placeholder="••••••••"
                                class="input-field w-full pl-10 pr-11 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('student_password') ? 'error border-red-300' : 'border-gray-200' }}"
                                autocomplete="current-password">
                            <button type="button" onclick="togglePw('studentPw', 'eyeStudent')"
                                class="pw-toggle absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                <svg id="eyeStudent" style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="remember" id="rememberStudent" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-[#25B1E0] transition-colors duration-200"></div>
                                <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5"></div>
                            </div>
                            <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors">Ingat Saya</span>
                        </label>
                        <span class="text-xs text-gray-400 italic">Cookie 30 hari</span>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-primary w-full text-white font-semibold py-3.5 rounded-xl text-sm shadow-md">
                        Masuk sebagai Mahasiswa
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-5">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold hover:underline" style="color:#25B1E0">
                        Daftar sekarang
                    </a>
                </p>
            </div>

            {{-- ── FORM ADMIN ── --}}
            <div id="formAdmin" class="form-panel hidden-panel">

                {{-- Badge Admin --}}
                <div class="flex items-center justify-center gap-2 mb-5">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-white"
                         style="background: linear-gradient(135deg, #1e3a5f, #0f2540)">
                        <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Akses Terbatas — Admin Only
                    </div>
                </div>

                {{-- Error admin --}}
                @if($errors->has('admin_email') || $errors->has('admin_password'))
                    <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            @foreach($errors->get('admin_email') as $err)
                                <p>{{ $err }}</p>
                            @endforeach
                            @foreach($errors->get('admin_password') as $err)
                                <p>{{ $err }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.admin') }}" class="space-y-5">
                    @csrf

                    {{-- Email Admin --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Admin</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input type="email" name="admin_email"
                                value="{{ old('admin_email') }}"
                                placeholder="admin@himpunan.ac.id"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('admin_email') ? 'error border-red-300' : 'border-gray-200' }}"
                                autocomplete="email">
                        </div>
                    </div>

                    {{-- Password Admin --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" name="admin_password" id="adminPw"
                                placeholder="••••••••"
                                class="input-field w-full pl-10 pr-11 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('admin_password') ? 'error border-red-300' : 'border-gray-200' }}"
                                autocomplete="current-password">
                            <button type="button" onclick="togglePw('adminPw', 'eyeAdmin')"
                                class="pw-toggle absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                <svg id="eyeAdmin" style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Session info --}}
                    <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs text-gray-500"
                         style="background: rgba(30,58,95,0.06); border: 1px solid rgba(30,58,95,0.1)">
                        <svg style="width:14px;height:14px;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Session admin akan berakhir saat browser ditutup (tanpa remember me).
                    </div>

                    {{-- Submit Admin --}}
                    <button type="submit" class="btn-admin w-full text-white font-semibold py-3.5 rounded-xl text-sm shadow-md">
                        Masuk sebagai Admin
                    </button>
                </form>

                {{-- Link Lupa Sandi --}}
                <div class="mt-4 text-center">
                    <button onclick="switchPanel('reset')"
                        class="text-xs font-medium hover:underline transition-colors"
                        style="color:#1e3a5f; opacity:0.7">
                        🔑 Lupa sandi admin?
                    </button>
                </div>
            </div>

            {{-- ── PANEL RESET PASSWORD ADMIN ── --}}
            <div id="formReset" class="form-panel hidden-panel">

                {{-- Header --}}
                <div class="flex items-center gap-3 mb-5">
                    <button onclick="switchPanel('login')"
                        class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-gray-100 transition-colors text-gray-500">
                        <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Reset Password Admin</p>
                        <p class="text-xs text-gray-400">Verifikasi identitas lalu ganti password</p>
                    </div>
                </div>

                {{-- Error reset --}}
                @if($errors->has('reset_email') || $errors->has('reset_name') || $errors->has('new_password'))
                    <div class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            @foreach($errors->get('reset_email') as $err)<p>{{ $err }}</p>@endforeach
                            @foreach($errors->get('reset_name') as $err)<p>{{ $err }}</p>@endforeach
                            @foreach($errors->get('new_password') as $err)<p>{{ $err }}</p>@endforeach
                        </div>
                    </div>
                @endif

                {{-- Success reset --}}
                @if(session('reset_success'))
                    <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('reset_success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.reset-password') }}" class="space-y-4">
                    @csrf

                    {{-- Nama Admin (verifikasi) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Admin</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="reset_name"
                                value="{{ old('reset_name') }}"
                                placeholder="Nama lengkap admin"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('reset_name') ? 'error border-red-300' : 'border-gray-200' }}">
                        </div>
                    </div>

                    {{-- Email Admin (verifikasi) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Admin</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input type="email" name="reset_email"
                                value="{{ old('reset_email') }}"
                                placeholder="admin@himpunan.ac.id"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('reset_email') ? 'error border-red-300' : 'border-gray-200' }}">
                        </div>
                    </div>

                    {{-- Password Baru --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" name="new_password" id="newPw"
                                placeholder="Min. 8 karakter"
                                class="input-field w-full pl-10 pr-11 py-3 rounded-xl border bg-white/70 text-sm {{ $errors->has('new_password') ? 'error border-red-300' : 'border-gray-200' }}">
                            <button type="button" onclick="togglePw('newPw', 'eyeNew')"
                                class="pw-toggle absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                <svg id="eyeNew" style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg style="width:18px;height:18px" class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <input type="password" name="new_password_confirmation"
                                placeholder="Ulangi password baru"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl border bg-white/70 text-sm border-gray-200">
                        </div>
                    </div>

                    {{-- Submit Reset --}}
                    <button type="submit"
                        class="w-full text-white font-semibold py-3.5 rounded-xl text-sm shadow-md transition-all hover:opacity-90"
                        style="background: linear-gradient(135deg, #1e3a5f, #0f2540)">
                        Ganti Password Sekarang
                    </button>
                </form>
            </div>

        </div>

        {{-- ── Footer ── --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Himpunan Mahasiswa &mdash; Dilindungi CSRF & Rate Limiting
        </p>

    </div>

    <script>
        // ── Tab state ──────────────────────────────────────────────────────────
        let currentTab = 'student';

        // Auto-switch ke tab admin jika ada error admin
        @if($errors->has('admin_email') || $errors->has('admin_password'))
            currentTab = 'admin';
        @endif

        // Auto-switch ke panel reset jika ada error/success reset
        @if($errors->has('reset_email') || $errors->has('reset_name') || $errors->has('new_password') || session('reset_success'))
            currentTab = 'admin';
        @endif

        function switchTab(tab) {
            currentTab = tab;
            const slider   = document.getElementById('tabSlider');
            const tabStu   = document.getElementById('tabStudent');
            const tabAdm   = document.getElementById('tabAdmin');
            const dotStu   = document.getElementById('dotStudent');
            const dotAdm   = document.getElementById('dotAdmin');
            const formStu  = document.getElementById('formStudent');
            const formAdm  = document.getElementById('formAdmin');

            if (tab === 'student') {
                // Slider ke kiri, warna biru muda
                slider.style.transform = 'translateX(0)';
                slider.style.background = 'linear-gradient(135deg, #25B1E0, #1a9bc5)';

                tabStu.style.color = 'white';
                tabAdm.style.color = '#6b7280';
                dotStu.style.background = '#fff';
                dotAdm.style.background = '#9ca3af';

                formStu.classList.remove('hidden-panel');
                formStu.classList.add('active-panel');
                formAdm.classList.remove('active-panel');
                formAdm.classList.add('hidden-panel');

            } else {
                // Slider ke kanan, warna navy gelap
                slider.style.transform = 'translateX(calc(100% + 0px))';
                slider.style.background = 'linear-gradient(135deg, #1e3a5f, #0f2540)';

                tabAdm.style.color = 'white';
                tabStu.style.color = '#6b7280';
                dotAdm.style.background = '#fff';
                dotStu.style.background = '#9ca3af';

                formAdm.classList.remove('hidden-panel');
                formAdm.classList.add('active-panel');
                formStu.classList.remove('active-panel');
                formStu.classList.add('hidden-panel');
            }
        }

        // ── Toggle password visibility ─────────────────────────────────────────
        function togglePw(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye   = document.getElementById(eyeId);
            if (input.type === 'password') {
                input.type = 'text';
                eye.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7
                             a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878
                             9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3
                             3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543
                             7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                input.type = 'password';
                eye.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542
                             7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }

        // ── Init: jalankan tab yang sesuai ─────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            switchTab(currentTab);

            // Auto-buka panel reset jika ada error/success reset
            @if($errors->has('reset_email') || $errors->has('reset_name') || $errors->has('new_password') || session('reset_success'))
                switchPanel('reset');
            @endif
        });

        // ── Switch antara panel login admin dan panel reset ────────────────────
        function switchPanel(panel) {
            const formAdm   = document.getElementById('formAdmin');
            const formReset = document.getElementById('formReset');

            if (panel === 'reset') {
                formAdm.classList.remove('active-panel');
                formAdm.classList.add('hidden-panel');
                formReset.classList.remove('hidden-panel');
                formReset.classList.add('active-panel');
            } else {
                formReset.classList.remove('active-panel');
                formReset.classList.add('hidden-panel');
                formAdm.classList.remove('hidden-panel');
                formAdm.classList.add('active-panel');
            }
        }
    </script>

</body>
</html>