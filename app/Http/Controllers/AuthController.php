<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        // Jika user sudah login, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect('/dashboard'); 
        }
        return view('auth.login'); // Sesuaikan dengan nama file blade halaman login kamu (misal: welcome.blade.php atau login.blade.php)
    }

    // Memproses data login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Tambahkan syarat: Hanya user dengan status 'Aktif' yang bisa login
        $credentials['status'] = 'Aktif';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek Role untuk diarahkan ke dashboard yang sesuai
            if (Auth::user()->role === 'Admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/user/dashboard'); // Pastikan route ini ada untuk user biasa
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'loginError' => 'Username atau Password salah, atau akun Anda sedang Non-Aktif.',
        ])->onlyInput('username');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Kembali ke halaman login
    }
}