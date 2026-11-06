<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun kamu sedang dinonaktifkan.',
                ])->onlyInput('email');
            }

            return match ($user->role) {
                'admin' => redirect()->intended(
                    route('admin.dashboard')
                ),
                'umkm' => redirect()->intended(
                    route('umkm.dashboard')
                ),
                'pembeli' => redirect()->intended(
                    route('pembeli.dashboard')
                ),
                default => redirect()->route('home')
                    ->with('error', 'Role akun tidak valid.'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Kamu berhasil logout.');
    }
}