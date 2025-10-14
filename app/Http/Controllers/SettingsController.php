<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            // Tambahkan validasi sesuai kebutuhan
        ]);

        // Update settings logic here

        return redirect()->route('settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function updateAll(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'app_name' => 'sometimes|required|string|max:255',
                'admin_email' => 'sometimes|required|email',
                'timezone' => 'sometimes|required|string',
                'locale' => 'sometimes|required|string',
                // Tambahkan validasi untuk field lainnya
            ]);

            // Simulasi penyimpanan settings
            // Dalam aplikasi nyata, Anda akan menyimpan ini ke database atau file config
            foreach ($validatedData as $key => $value) {
                // Simpan setiap setting
                // Contoh: Settings::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Semua pengaturan berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
