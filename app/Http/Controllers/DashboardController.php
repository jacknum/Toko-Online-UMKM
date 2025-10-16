<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika user adalah pembeli, redirect ke store
        if ($user->role === 'pembeli') {
            return redirect()->route('store.home');
        }

        // Jika penjual, tampilkan dashboard penjual
        return view('dashboard', [
            'user' => $user
        ]);
    }
}
