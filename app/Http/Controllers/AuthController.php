<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:15|unique:users,mobile',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Jika validasi gagal, kembalikan ke form dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data pengguna baru
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial dan login
        if (Auth::attempt([
            'mobile' => $request->input('mobile'),
            'password' => $request->input('password'),
        ])) {
            // Hapus dd() untuk production, gunakan hanya untuk debugging
            // dd(Auth::check(), Auth::user());
            return redirect()->route('dashboard');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'message' => 'Login gagal. Pastikan kredensial Anda benar.',
        ]);
    }

    // Metode untuk logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}