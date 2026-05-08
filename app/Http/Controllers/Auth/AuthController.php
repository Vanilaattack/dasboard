<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    // ─── Tampilkan Halaman Login ──────────────────────────────────────────────

    public function showLogin(): View|RedirectResponse
    {
        if (auth()->check()) {
            return $this->redirectByRole(auth()->user());
        }

        return view('auth.login');
    }

    // ─── Proses Login Admin (Session Only) ───────────────────────────────────
    //
    //  • Tidak ada remember me → session hangus saat browser ditutup
    //  • Brute-force: max 5 percobaan per email+IP per menit
    //  • Session regenerate → cegah session fixation

    public function loginAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'admin_email'    => ['required', 'email'],
            'admin_password' => ['required', 'string'],
        ], [
            'admin_email.required'    => 'Email admin wajib diisi.',
            'admin_email.email'       => 'Format email tidak valid.',
            'admin_password.required' => 'Password wajib diisi.',
        ]);

        // ── Brute-force throttle ──────────────────────────────────────────────
        $throttleKey = 'admin-login:' . Str::lower($request->admin_email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, maxAttempts: 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'admin_email' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        // ── Cari user dengan role admin ───────────────────────────────────────
        $user = User::where('email', $request->admin_email)
                    ->where('role', 'admin')
                    ->first();

        if (! $user || ! Hash::check($request->admin_password, $user->password)) {
            RateLimiter::hit($throttleKey, decay: 60);

            throw ValidationException::withMessages([
                'admin_email' => 'Email atau password admin tidak cocok.',
            ]);
        }

        RateLimiter::clear($throttleKey);

        // ── Login via Session (tanpa remember cookie) ─────────────────────────
        Auth::login($user, remember: false);
        $request->session()->regenerate();

        // Hapus remember_token agar tidak ada cookie persisten
        $user->forceFill(['remember_token' => null])->save();

        return redirect()->route('admin.welcome')
            ->with('login_success', 'Selamat datang, ' . $user->name . '!');
    }

    // ─── Proses Login Mahasiswa (Cookie Remember Me) ──────────────────────────
    //
    //  • Jika "Ingat Saya" dicentang → Auth::login($user, remember: true)
    //    Laravel menyimpan remember_token ke cookie (default 5 tahun,
    //    kita batasi via session lifetime di config)
    //  • Brute-force: max 5 percobaan per email+IP per menit

    public function loginStudent(Request $request): RedirectResponse
    {
        $request->validate([
            'student_email'    => ['required', 'email'],
            'student_password' => ['required', 'string'],
        ], [
            'student_email.required'    => 'Email wajib diisi.',
            'student_email.email'       => 'Format email tidak valid.',
            'student_password.required' => 'Password wajib diisi.',
        ]);

        // ── Brute-force throttle ──────────────────────────────────────────────
        $throttleKey = 'student-login:' . Str::lower($request->student_email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, maxAttempts: 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'student_email' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        // ── Cari user dengan role student ─────────────────────────────────────
        $user = User::where('email', $request->student_email)
                    ->where('role', 'student')
                    ->first();

        if (! $user || ! Hash::check($request->student_password, $user->password)) {
            RateLimiter::hit($throttleKey, decay: 60);

            throw ValidationException::withMessages([
                'student_email' => 'Email atau password tidak cocok.',
            ]);
        }

        RateLimiter::clear($throttleKey);

        // ── Login dengan atau tanpa Remember Me Cookie ────────────────────────
        $remember = $request->boolean('remember');
        Auth::login($user, remember: $remember);
        $request->session()->regenerate();

        return redirect()->route('student.welcome')
            ->with('login_success', 'Selamat datang, ' . $user->name . '! 👋');
    }

    // ─── Reset Password Admin ─────────────────────────────────────────────────
    //
    //  Verifikasi: nama + email harus cocok dengan akun admin yang ada.
    //  Jika cocok, langsung ganti password tanpa perlu email/token.

    public function resetAdminPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'reset_name'               => ['required', 'string'],
            'reset_email'              => ['required', 'email'],
            'new_password'             => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'reset_name.required'              => 'Nama admin wajib diisi.',
            'reset_email.required'             => 'Email admin wajib diisi.',
            'reset_email.email'                => 'Format email tidak valid.',
            'new_password.required'            => 'Password baru wajib diisi.',
            'new_password.min'                 => 'Password minimal 8 karakter.',
            'new_password.confirmed'           => 'Konfirmasi password tidak cocok.',
        ]);

        // Cari admin yang cocok nama DAN email-nya
        $admin = User::where('email', $request->reset_email)
                     ->where('role', 'admin')
                     ->first();

        if (! $admin || strtolower(trim($admin->name)) !== strtolower(trim($request->reset_name))) {
            throw ValidationException::withMessages([
                'reset_email' => 'Nama atau email admin tidak ditemukan. Periksa kembali.',
            ]);
        }

        // Ganti password
        $admin->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return redirect()->route('login')
            ->with('reset_success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }

    // ─── Logout ───────────────────────────────────────────────────────────────

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Kamu berhasil logout. Sampai jumpa! 👋');
    }

    // ─── Helper ───────────────────────────────────────────────────────────────

    private function redirectByRole(User $user): RedirectResponse
    {
        return $user->isAdmin()
            ? redirect()->route('admin.welcome')
            : redirect()->route('student.welcome');
    }
}
