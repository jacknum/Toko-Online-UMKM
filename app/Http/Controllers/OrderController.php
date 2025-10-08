<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
        $ordersData = [
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

        // Convert array to paginator
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = array_slice($ordersData, ($currentPage - 1) * $perPage, $perPage);
        $orders = new LengthAwarePaginator($currentItems, count($ordersData), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('orders.incoming', compact('stats', 'orders'));
    }

    public function outgoing()
    {
        // Data statistik untuk pesanan keluar
        $stats = [
            'total_outgoing' => 42,
            'processing' => 15,
            'shipped' => 27,
            'delivered' => 35
        ];

        // Data pesanan keluar (contoh)
        $ordersData = [
            (object)[
                'id' => 1,
                'product_name' => 'Tas Ransel',
                'customer_name' => 'Budi Santoso',
                'quantity' => 1,
                'price' => 250000,
                'status' => 'shipped',
                'created_at' => '2024-01-15 10:30:00',
                'tracking_number' => 'RESI001234567',
                'courier' => 'JNE',
                'estimated_delivery' => '2024-01-18'
            ],
            (object)[
                'id' => 2,
                'product_name' => 'Sepatu Sport',
                'customer_name' => 'Sari Indah',
                'quantity' => 2,
                'price' => 480000,
                'status' => 'delivered',
                'created_at' => '2024-01-14 09:15:00',
                'tracking_number' => 'RESI001234568',
                'courier' => 'J&T',
                'estimated_delivery' => '2024-01-17'
            ],
            (object)[
                'id' => 3,
                'product_name' => 'Kaos Polos',
                'customer_name' => 'Rina Wijaya',
                'quantity' => 3,
                'price' => 210000,
                'status' => 'processing',
                'created_at' => '2024-01-13 14:20:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null
            ],
            (object)[
                'id' => 4,
                'product_name' => 'Jaket Hoodie',
                'customer_name' => 'Andi Pratama',
                'quantity' => 1,
                'price' => 320000,
                'status' => 'shipped',
                'created_at' => '2024-01-12 08:45:00',
                'tracking_number' => 'RESI001234569',
                'courier' => 'SiCepat',
                'estimated_delivery' => '2024-01-16'
            ],
            (object)[
                'id' => 5,
                'product_name' => 'Celana Jeans',
                'customer_name' => 'Dewi Lestari',
                'quantity' => 2,
                'price' => 380000,
                'status' => 'delivered',
                'created_at' => '2024-01-11 16:30:00',
                'tracking_number' => 'RESI001234570',
                'courier' => 'JNE',
                'estimated_delivery' => '2024-01-15'
            ]
        ];

        // Convert array to paginator
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = array_slice($ordersData, ($currentPage - 1) * $perPage, $perPage);
        $orders = new LengthAwarePaginator($currentItems, count($ordersData), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('orders.outgoing', compact('stats', 'orders'));
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

    // Method untuk pesanan keluar
    public function ship($id)
    {
        // Logika untuk mengirim pesanan
        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dikirim'
        ]);
    }

    public function markDelivered($id)
    {
        // Logika untuk menandai pesanan terkirim
        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil ditandai sebagai terkirim'
        ]);
    }

    public function complete($id)
    {
        // Logika untuk menyelesaikan pesanan
        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diselesaikan'
        ]);
    }
}
