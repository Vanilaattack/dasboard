<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     * Jika sudah login, redirect langsung ke dashboard sesuai role.
     */
    public function create(): View|RedirectResponse
    {
        if (auth()->check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    /**
     * Proses login dengan dua strategi berbeda:
     *
     * ┌─────────────────────────────────────────────────────────────────┐
     * │  ADMIN     → Session Only (server-side, hangus saat browser     │
     * │              ditutup, tidak ada persistent cookie)              │
     * │                                                                 │
     * │  MAHASISWA → Cookie Remember Me (persistent 30 hari jika       │
     * │              "Ingat Saya" dicentang, tetap login walau browser  │
     * │              ditutup)                                           │
     * └─────────────────────────────────────────────────────────────────┘
     *
     * Brute-force protection: max 5 attempts / email+IP (via LoginRequest)
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi + throttle brute-force (ada di LoginRequest)
        $request->authenticate();

        // Regenerate session ID → cegah session fixation attack
        $request->session()->regenerate();

        $user = Auth::user();

        // ── ADMIN: Session Only ──────────────────────────────────────────────
        if ($user->isAdmin()) {
            // Pastikan tidak ada remember token tersimpan
            $user->forceFill(['remember_token' => null])->save();

            return redirect()->route('admin.dashboard')
                ->with('login_success', 'Selamat datang, ' . $user->name . '!');
        }

        // ── MAHASISWA: Cookie Remember Me ────────────────────────────────────
        // Jika "Ingat Saya" dicentang, re-auth dengan remember=true
        // Laravel akan menyimpan remember_token ke cookie (30 hari)
        if ($request->boolean('remember')) {
            Auth::logout();
            Auth::login($user, remember: true);
            $request->session()->regenerate();
        }

        return redirect()->route('student.dashboard')
            ->with('login_success', 'Selamat datang kembali, ' . $user->name . '!');
    }

    /**
     * Logout: hapus session, invalidate, regenerate CSRF token.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Kamu berhasil logout. Sampai jumpa! 👋');
    }

    // ── Private Helpers ──────────────────────────────────────────────────────

    private function redirectByRole(): RedirectResponse
    {
        return Auth::user()->isAdmin()
            ? redirect()->intended(route('admin.dashboard'))
            : redirect()->intended(route('student.dashboard'));
    }
}
