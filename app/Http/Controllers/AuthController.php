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
            return redirect()->route('store.home')->with('success', 'Login berhasil! Selamat datang.');
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
