<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //tampilan form login
    public function showLogin() {
        return view('Auth.login');
    }

    //proses pengecekan email dan loginya
    public function login(Request $request) {
        // 1. Verifikasi Google reCAPTCHA v3
        $recaptchaToken = $request->input('g-recaptcha-response');

        if ($recaptchaToken) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => env('RECAPTCHA_SECRET_KEY'),
                'response' => $recaptchaToken,
                'remoteip' => $request->ip(),
            ]);

            // Jika validasi Google gagal atau skor di bawah 0.5 (terindikasi bot)
            if (!$response->json('success') || $response->json('score') < 0.5) {
                return back()->with('error', 'Verifikasi reCAPTCHA gagal, terdeteksi aktivitas mencurigakan!')->withInput();
            }
        }

        // 2. Validasi input form
        $kredensial = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 3. Cek kredensial di database
        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->with('error', 'Email atau Password salah!')->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
