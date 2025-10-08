<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function incoming()
    {
        // Data statistik
        $stats = [
            'new_orders' => 10,
            'pending_confirmation' => 5,
            'today_orders' => 3,
            'total_value' => 1250000
        ];

        // Data pesanan (contoh)
        $orders = [
            (object)[
                'id' => 1,
                'product_name' => 'SLINGBAO',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 150000,
                'status' => 'pending',
                'created_at' => '2024-01-15 10:30:00'
            ],
            (object)[
                'id' => 2,
                'product_name' => 'SHAMPOO KERATIN',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 45000,
                'status' => 'confirmed',
                'created_at' => '2024-01-15 09:15:00'
            ],
            (object)[
                'id' => 3,
                'product_name' => 'SNEAKERS',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 130000,
                'status' => 'shipped',
                'created_at' => '2024-01-14 14:20:00'
            ],
            (object)[
                'id' => 4,
                'product_name' => 'SERMU',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 150000,
                'status' => 'pending',
                'created_at' => '2024-01-15 08:45:00'
            ]
        ];

        return view('orders.incoming', compact('stats', 'orders'));
    }

    public function show($id)
    {
        // Data pesanan dummy berdasarkan ID
        $orders = [
            1 => (object)[
                'id' => 1,
                'product_name' => 'SLINGBAO',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 150000,
                'status' => 'pending',
                'created_at' => '2024-01-15 10:30:00',
                'tracking_number' => null
            ],
            2 => (object)[
                'id' => 2,
                'product_name' => 'SHAMPOO KERATIN',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 45000,
                'status' => 'confirmed',
                'created_at' => '2024-01-15 09:15:00',
                'tracking_number' => null
            ],
            3 => (object)[
                'id' => 3,
                'product_name' => 'SNEAKERS',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 130000,
                'status' => 'shipped',
                'created_at' => '2024-01-14 14:20:00',
                'tracking_number' => 'RESI123456789'
            ],
            4 => (object)[
                'id' => 4,
                'product_name' => 'SERMU',
                'customer_name' => 'Anima',
                'quantity' => 1,
                'price' => 150000,
                'status' => 'pending',
                'created_at' => '2024-01-15 08:45:00',
                'tracking_number' => null
            ]
        ];

        // Cek apakah order ID ada
        if (!isset($orders[$id])) {
            abort(404, 'Pesanan tidak ditemukan');
        }

        $order = $orders[$id];

        return view('orders.detail', compact('order'));
    }

    public function accept($id)
    {
        // Logika untuk menerima pesanan
        // Di sini biasanya Anda akan update status di database

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diterima dan akan diproses'
        ]);
    }

    public function reject($id)
    {
        // Logika untuk menolak pesanan
        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil ditolak'
        ]);
    }

    public function process($id)
    {
        // Logika untuk memproses pesanan
        return response()->json([
            'success' => true,
            'message' => 'Pesanan sedang diproses untuk pengiriman'
        ]);
    }

    public function track($id)
    {
        // Logika untuk melacak pesanan
        return response()->json([
            'success' => true,
            'message' => 'Melacak pengiriman pesanan...'
        ]);
    }
}
