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
                'product_name' => 'SLINGBAG',
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

    public function outgoing(Request $request)
    {
        // Data statistik untuk pesanan keluar
        $stats = [
            'total_outgoing' => 42,
            'processing' => 15,
            'shipped' => 27,
            'delivered' => 35,
            'unpaid' => 8,
            'completed' => 12,
            'cancelled' => 5
        ];

        // Data pesanan keluar (contoh)
        $allOrders = [
            // Status: unpaid (belum bayar) - 3 data
            (object)[
                'id' => 1,
                'order_number' => 'ACG2344',
                'product_name' => 'SLINGBAG',
                'customer_name' => 'Budi Santoso',
                'quantity' => 1,
                'price' => 150000,
                'total_price' => 160000,
                'status' => 'unpaid',
                'created_at' => '2024-01-15 10:30:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null
            ],
            (object)[
                'id' => 2,
                'order_number' => 'ACG2345',
                'product_name' => 'Tas Ransel Premium',
                'customer_name' => 'Sari Indah',
                'quantity' => 1,
                'price' => 250000,
                'total_price' => 265000,
                'status' => 'unpaid',
                'created_at' => '2024-01-15 09:15:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null
            ],
            (object)[
                'id' => 3,
                'order_number' => 'ACG2346',
                'product_name' => 'Sepatu Sport',
                'customer_name' => 'Rina Wijaya',
                'quantity' => 2,
                'price' => 480000,
                'total_price' => 500000,
                'status' => 'unpaid',
                'created_at' => '2024-01-14 14:20:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null
            ],

            // Status: processing (sedang diproses/dikemas) - 2 data
            (object)[
                'id' => 4,
                'order_number' => 'ACG2347',
                'product_name' => 'Kaos Polos',
                'customer_name' => 'Andi Pratama',
                'quantity' => 3,
                'price' => 210000,
                'total_price' => 225000,
                'status' => 'processing',
                'created_at' => '2024-01-13 14:20:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => '2024-01-28'
            ],
            (object)[
                'id' => 5,
                'order_number' => 'ACG2348',
                'product_name' => 'Jaket Hoodie',
                'customer_name' => 'Dewi Lestari',
                'quantity' => 1,
                'price' => 320000,
                'total_price' => 335000,
                'status' => 'processing',
                'created_at' => '2024-01-12 08:45:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => '2024-01-29'
            ],

            // Status: shipped (dikirim) - 2 data
            (object)[
                'id' => 6,
                'order_number' => 'ACG2349',
                'product_name' => 'Celana Jeans',
                'customer_name' => 'Fajar Nugroho',
                'quantity' => 2,
                'price' => 380000,
                'total_price' => 395000,
                'status' => 'shipped',
                'created_at' => '2024-01-11 16:30:00',
                'tracking_number' => 'RESI001234570',
                'courier' => 'JNE',
                'estimated_delivery' => '2024-01-28'
            ],
            (object)[
                'id' => 7,
                'order_number' => 'ACG2350',
                'product_name' => 'Kemeja Flanel',
                'customer_name' => 'Gita Permata',
                'quantity' => 1,
                'price' => 180000,
                'total_price' => 195000,
                'status' => 'shipped',
                'created_at' => '2024-01-10 11:20:00',
                'tracking_number' => 'RESI001234571',
                'courier' => 'J&T',
                'estimated_delivery' => '2024-01-30'
            ],

            // Status: delivered (terkirim) - 2 data
            (object)[
                'id' => 8,
                'order_number' => 'ACG2351',
                'product_name' => 'Dompet Kulit',
                'customer_name' => 'Hendra Setiawan',
                'quantity' => 1,
                'price' => 120000,
                'total_price' => 135000,
                'status' => 'delivered',
                'created_at' => '2024-01-09 14:15:00',
                'tracking_number' => 'RESI001234572',
                'courier' => 'SiCepat',
                'estimated_delivery' => '2024-01-25'
            ],
            (object)[
                'id' => 9,
                'order_number' => 'ACG2352',
                'product_name' => 'Topi Baseball',
                'customer_name' => 'Indah Purnama',
                'quantity' => 2,
                'price' => 90000,
                'total_price' => 105000,
                'status' => 'delivered',
                'created_at' => '2024-01-08 09:30:00',
                'tracking_number' => 'RESI001234573',
                'courier' => 'JNE',
                'estimated_delivery' => '2024-01-24'
            ],

            // Status: completed (selesai) - 3 data
            (object)[
                'id' => 10,
                'order_number' => 'ACG2353',
                'product_name' => 'Tas Laptop',
                'customer_name' => 'Joko Widodo',
                'quantity' => 1,
                'price' => 350000,
                'total_price' => 365000,
                'status' => 'completed',
                'created_at' => '2024-01-05 13:45:00',
                'tracking_number' => 'RESI001234574',
                'courier' => 'J&T',
                'estimated_delivery' => '2024-01-20',
                'rating' => 4.5,
                'review' => 'Produknya bagus sekali, kualitasnya sesuai dengan harga. Pengirimannya juga cepat. Terima kasih!'
            ],
            (object)[
                'id' => 11,
                'order_number' => 'ACG2354',
                'product_name' => 'Sepatu Formal',
                'customer_name' => 'Kartika Sari',
                'quantity' => 1,
                'price' => 280000,
                'total_price' => 295000,
                'status' => 'completed',
                'created_at' => '2024-01-04 10:20:00',
                'tracking_number' => 'RESI001234575',
                'courier' => 'JNE',
                'estimated_delivery' => '2024-01-19',
                'rating' => 5.0,
                'review' => 'Sangat puas dengan produknya, bahan berkualitas dan nyaman dipakai.'
            ],
            (object)[
                'id' => 12,
                'order_number' => 'ACG2355',
                'product_name' => 'Jam Tangan',
                'customer_name' => 'Lukman Hakim',
                'quantity' => 1,
                'price' => 450000,
                'total_price' => 465000,
                'status' => 'completed',
                'created_at' => '2024-01-03 16:10:00',
                'tracking_number' => 'RESI001234576',
                'courier' => 'SiCepat',
                'estimated_delivery' => '2024-01-18',
                'rating' => 4.0,
                'review' => 'Desainnya elegan, cocok untuk acara formal. Pengiriman tepat waktu.'
            ],

            // Status: cancelled (dibatalkan) - 3 data
            (object)[
                'id' => 13,
                'order_number' => 'ACG2356',
                'product_name' => 'Kacamata Hitam',
                'customer_name' => 'Maya Sari',
                'quantity' => 1,
                'price' => 150000,
                'total_price' => 165000,
                'status' => 'cancelled',
                'created_at' => '2024-01-15 08:30:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null,
                'cancel_reason' => 'Pembayaran Gagal',
                'cancel_notes' => 'Pembayaran tidak dilakukan dalam waktu 24 jam'
            ],
            (object)[
                'id' => 14,
                'order_number' => 'ACG2357',
                'product_name' => 'Baju Renang',
                'customer_name' => 'Nando Pratama',
                'quantity' => 2,
                'price' => 120000,
                'total_price' => 135000,
                'status' => 'cancelled',
                'created_at' => '2024-01-14 11:45:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null,
                'cancel_reason' => 'Permintaan Pelanggan',
                'cancel_notes' => 'Pelanggan meminta pembatalan karena perubahan rencana'
            ],
            (object)[
                'id' => 15,
                'order_number' => 'ACG2358',
                'product_name' => 'Tas Selempang',
                'customer_name' => 'Oki Setiawan',
                'quantity' => 1,
                'price' => 95000,
                'total_price' => 110000,
                'status' => 'cancelled',
                'created_at' => '2024-01-13 14:20:00',
                'tracking_number' => null,
                'courier' => null,
                'estimated_delivery' => null,
                'cancel_reason' => 'Stok Habis',
                'cancel_notes' => 'Stok produk habis dan tidak dapat dipenuhi'
            ]
        ];

        // Filter data berdasarkan status jika ada parameter filter
        $filter = $request->get('filter', 'all');
        $filteredOrders = $allOrders;

        if ($filter !== 'all') {
            $filteredOrders = array_filter($allOrders, function ($order) use ($filter) {
                return $order->status === $filter;
            });
            // Reset array keys
            $filteredOrders = array_values($filteredOrders);
        }

        // Convert array to paginator
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 12; // Increased per page to show more orders
        $currentItems = array_slice($filteredOrders, ($currentPage - 1) * $perPage, $perPage);
        $orders = new LengthAwarePaginator($currentItems, count($filteredOrders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => ['filter' => $filter] // Maintain filter in pagination links
        ]);

        return view('orders.outgoing', compact('stats', 'orders', 'filter'));
    }
    
    public function show($id)
    {
        // Data pesanan dummy berdasarkan ID
        $orders = [
            1 => (object)[
                'id' => 1,
                'product_name' => 'SLINGBAG',
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

    // Method baru untuk konfirmasi pembayaran
    public function confirmPayment($id)
    {
        // Logika untuk mengkonfirmasi pembayaran
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi'
        ]);
    }

    // Method baru untuk membatalkan pesanan
    public function cancel($id)
    {
        // Logika untuk membatalkan pesanan
        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibatalkan'
        ]);
    }
}
