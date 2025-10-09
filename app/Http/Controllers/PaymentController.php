<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Data statistik keuangan
        $stats = [
            'total_sales' => 12500000,
            'total_commission' => 1250000,
            'pending_payments' => 3500000,
            'net_profit' => 9250000,
            'growth_percentage' => 15.5,
            'total_transactions' => 45
        ];

        // Data pembayaran
        $payments = [
            (object)[
                'id' => 1,
                'order_id' => 'ORD001',
                'customer_name' => 'Budi Santoso',
                'product_name' => 'Sepatu Running Premium',
                'amount' => 450000,
                'commission' => 45000,
                'status' => 'completed',
                'payment_date' => '2024-01-15',
                'payment_method' => 'Transfer Bank'
            ],
            (object)[
                'id' => 2,
                'order_id' => 'ORD002',
                'customer_name' => 'Sari Dewi',
                'product_name' => 'Tas Laptop Minimalis',
                'amount' => 320000,
                'commission' => 32000,
                'status' => 'completed',
                'payment_date' => '2024-01-14',
                'payment_method' => 'E-Wallet'
            ],
            (object)[
                'id' => 3,
                'order_id' => 'ORD003',
                'customer_name' => 'Ahmad Rizki',
                'product_name' => 'Smartwatch Series 5',
                'amount' => 1200000,
                'commission' => 120000,
                'status' => 'pending',
                'payment_date' => '2024-01-15',
                'payment_method' => 'Transfer Bank'
            ],
            (object)[
                'id' => 4,
                'order_id' => 'ORD004',
                'customer_name' => 'Maya Sari',
                'product_name' => 'Kaos Polo Cotton',
                'amount' => 125000,
                'commission' => 12500,
                'status' => 'completed',
                'payment_date' => '2024-01-13',
                'payment_method' => 'Credit Card'
            ]
        ];

        // Data chart penjualan
        $salesChart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => [8500000, 9200000, 7800000, 9500000, 11000000, 12500000, 9800000, 10500000, 11500000, 13200000, 12800000, 14500000]
        ];

        // Data profit per produk
        $productProfits = [
            (object)[
                'product_name' => 'Sepatu Running Premium',
                'sales' => 4500000,
                'cost' => 2700000,
                'profit' => 1800000,
                'margin' => 40.0
            ],
            (object)[
                'product_name' => 'Smartwatch Series 5',
                'sales' => 3600000,
                'cost' => 2520000,
                'profit' => 1080000,
                'margin' => 30.0
            ],
            (object)[
                'product_name' => 'Tas Laptop Minimalis',
                'sales' => 2240000,
                'cost' => 1568000,
                'profit' => 672000,
                'margin' => 30.0
            ],
            (object)[
                'product_name' => 'Kaos Polo Cotton',
                'sales' => 875000,
                'cost' => 525000,
                'profit' => 350000,
                'margin' => 40.0
            ]
        ];

        return view('payments.index', compact('stats', 'payments', 'salesChart', 'productProfits'));
    }

    public function detail($id)
    {
        // Data detail pembayaran
        $payment = (object)[
            'id' => $id,
            'order_id' => 'ORD00' . $id,
            'customer_name' => 'Budi Santoso',
            'customer_email' => 'budi.santoso@email.com',
            'customer_phone' => '+6281234567890',
            'product_name' => 'Sepatu Running Premium',
            'quantity' => 1,
            'unit_price' => 450000,
            'amount' => 450000,
            'commission' => 45000,
            'commission_rate' => 10,
            'status' => 'completed',
            'payment_date' => '2024-01-15 14:30:00',
            'payment_method' => 'Transfer Bank',
            'payment_reference' => 'TRX20240115001',
            'shipping_cost' => 25000,
            'tax' => 0,
            'net_amount' => 425000
        ];

        // Data chart untuk detail
        $detailChart = [
            'revenue_trend' => [400000, 420000, 380000, 450000, 480000, 520000],
            'months' => ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        ];

        return view('payments.detail', compact('payment', 'detailChart'));
    }
}
