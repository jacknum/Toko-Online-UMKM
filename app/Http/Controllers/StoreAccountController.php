<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreAccountController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna
     */
    public function profile()
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '081234567890',
            'avatar' => 'https://via.placeholder.com/150x150',
            'join_date' => '2024-01-15'
        ];

        return view('store.account.profile', compact('user'));
    }

    /**
     * Menampilkan halaman alamat pengguna
     */
    public function addresses()
    {
        $addresses = [
            [
                'id' => 1,
                'name' => 'Rumah',
                'recipient' => 'John Doe',
                'phone' => '081234567890',
                'address' => 'Jl. Contoh Alamat No. 123, RT 001/RW 002',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12345',
                'is_primary' => true
            ],
            [
                'id' => 2,
                'name' => 'Kantor',
                'recipient' => 'John Doe',
                'phone' => '081234567891',
                'address' => 'Jl. Kantor No. 456, Gedung ABC Lantai 5',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'postal_code' => '12346',
                'is_primary' => false
            ]
        ];

        return view('store.account.addresses', compact('addresses'));
    }

    /**
     * Menampilkan halaman keamanan akun
     */
    public function security()
    {
        return view('store.account.security');
    }

    /**
     * Update profil pengguna
     */
    public function updateProfile(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15'
        ]);

        // Logic untuk update profil
        // ...

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password pengguna
     */
    public function updatePassword(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ]);

        // Logic untuk update password
        // ...

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
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
