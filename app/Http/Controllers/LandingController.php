<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('landing.index');
    }

    public function features()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('landing.features');
    }

    public function pricing()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('landing.pricing');
    }
}
