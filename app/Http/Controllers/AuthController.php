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
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    // Show Register Form
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.register');
    }

    // Show Forgot Password Form
    public function showForgotPassword()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.forget-password');
    }

    // Check Email and Redirect to Reset Password
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan dalam sistem.'
            ])->withInput();
        }

        // Simpan email di session untuk digunakan di halaman reset password
        $request->session()->put('reset_email', $request->email);

        // Redirect ke halaman reset password
        return redirect()->route('password.reset');
    }

    // Show Reset Password Form
    public function showResetPassword(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }

        // Cek apakah ada email di session
        if (!$request->session()->has('reset_email')) {
            return redirect()->route('password.request')->with('error', 'Silakan masukkan email terlebih dahulu.');
        }

        return view('auth.reset-password', [
            'email' => $request->session()->get('reset_email')
        ]);
    }

    // Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak valid.'
            ])->withInput();
        }

        try {
            // Update password user
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Hapus session reset_email
            $request->session()->forget('reset_email');

            return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mereset password: ' . $e->getMessage());
        }
    }

    // Method Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Login dengan username
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Method untuk redirect berdasarkan role
    private function redirectBasedOnRole()
    {
        $user = Auth::user();

        if ($user->role === 'penjual') {
            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang Penjual.');
        } else {
            // Default untuk pembeli dan role lainnya
            return redirect()->route('store.index')->with('success', 'Login berhasil! Selamat datang.');
        }
    }

    // Handle Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:penjual,pembeli', // Hanya 2 pilihan
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

            Auth::login($user);

            // Redirect berdasarkan role setelah registrasi
            return $this->redirectBasedOnRole();
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
