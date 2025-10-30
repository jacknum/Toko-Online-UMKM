<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreAccountController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna
     */
    public function profile()
    {
        $user = Auth::user();

        return view('stores.account.profile', compact('user'));
    }

    /**
     * Update profil pengguna
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => 'required|string|max:15'
        ]);

        try {
            // Update data user
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone']
            ]);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    }

    /**
     * Menampilkan halaman alamat pengguna
     */
    public function addresses()
    {
        // Untuk demo, kita tetap pakai data dummy
        // Tapi nanti bisa diubah untuk mengambil dari database
        $addresses = [
            [
                'id' => 1,
                'name' => 'Rumah',
                'recipient' => Auth::user()->name,
                'phone' => Auth::user()->phone,
                'address' => 'Jl. Sebuah Daerah No. 123, RT 001/RW 002',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12345',
                'is_primary' => true
            ],
            [
                'id' => 2,
                'name' => 'Kantor',
                'recipient' => Auth::user()->name,
                'phone' => Auth::user()->phone,
                'address' => 'Jl. Kantor No. 456, Gedung ABC Lantai 5',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'postal_code' => '12346',
                'is_primary' => false
            ]
        ];

        return view('stores.account.addresses', compact('addresses'));
    }

    /**
     * Menampilkan halaman keamanan akun
     */
    public function security()
    {
        return view('stores.account.security');
    }

    /**
     * Update password pengguna
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi data
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ]);

        // Cek password saat ini
        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini tidak sesuai.');
        }

        try {
            // Update password
            $user->update([
                'password' => Hash::make($validated['new_password'])
            ]);

            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui password.');
        }
    }

    /**
     * Tambah alamat baru
     */
    public function addAddress(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'recipient' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10'
        ]);

        // Logic untuk tambah alamat
        // ...

        return redirect()->back()->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Hapus alamat
     */
    public function deleteAddress($id)
    {
        // Logic untuk hapus alamat
        // ...

        return redirect()->back()->with('success', 'Alamat berhasil dihapus!');
    }
}
