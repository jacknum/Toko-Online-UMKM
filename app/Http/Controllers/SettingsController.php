<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
            'timezone' => 'required|string',
            'locale' => 'required|string|in:id,en',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Simpan pengaturan ke database atau config file
            // Contoh: update setting di database
            // Setting::updateOrCreate(['key' => 'app_name'], ['value' => $request->app_name]);

            // Clear cache settings
            Cache::forget('app_settings');

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateAll(Request $request)
    {
        try {
            // Process all settings from different forms
            $settings = $request->except(['_token']);

            foreach ($settings as $key => $value) {
                // Save each setting to database or config
                // Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            // Clear cache
            Cache::forget('app_settings');

            return response()->json([
                'success' => true,
                'message' => 'Semua pengaturan berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
