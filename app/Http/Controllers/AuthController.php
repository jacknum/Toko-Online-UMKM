<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) { // Ganti auth()->check() dengan Auth::check()
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // Show Register Form
    public function showRegister()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) { // Ganti auth()->check() dengan Auth::check()
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    // Di method login AuthController
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Login hanya dengan username (tidak pakai email)
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Handle Register - Pastikan login setelah registrasi
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,penjual,pembeli',
            'agree_terms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
            ]);

            // Login user setelah registrasi
            Auth::login($user);

            // Redirect ke dashboard setelah registrasi berhasil
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage());
        }
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
