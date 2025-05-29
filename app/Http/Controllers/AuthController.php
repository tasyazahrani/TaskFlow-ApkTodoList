<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;

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
        // Validasi form registrasi
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan data user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi login
        $request->validate([
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari user berdasarkan mobile dan password
        $user = User::where('mobile', $request->input('mobile'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Simpan sesi atau token untuk user yang login
            auth()->login($user);
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }
}
