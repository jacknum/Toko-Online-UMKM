@extends('layouts.app')

@section('title', 'Detail Pembayaran - Toko Online UMKM')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">Detail Pembayaran</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Pembayaran & Komisi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pembayaran</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Payment Information -->
        <div class="col-lg-8">
            <!-- Revenue Trend Chart -->
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trend Pendapatan 6 Bulan Terakhir</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueTrendChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>ID Pesanan</strong></td>
                                    <td>: {{ $payment->order_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Pembayaran</strong></td>
                                    <td>: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        @if($payment->status == 'completed')
                                            <span class="badge bg-success badge-custom">
                                                <i class="fas fa-check me-1"></i>Lunas
                                            </span>
                                        @else
                                            <span class="badge bg-warning badge-custom">
                                                <i class="fas fa-clock me-1"></i>Tertunda
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Metode Pembayaran</strong></td>
                                    <td>: {{ $payment->payment_method }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Referensi</strong></td>
                                    <td>: {{ $payment->payment_reference }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Komisi</strong></td>
                                    <td>: {{ $payment->commission_rate }}%</td>
                                </tr>
                                <tr>
                                    <td><strong>Biaya Pengiriman</strong></td>
                                    <td>: Rp {{ number_format($payment->shipping_cost, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pajak</strong></td>
                                    <td>: Rp {{ number_format($payment->tax, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary & Actions -->
        <div class="col-lg-4">
            <!-- Payment Summary -->
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Total Pembayaran:</strong>
                        <div class="h4 text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                    </div>
                    
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Harga Produk:</td>
                            <td class="text-end">Rp {{ number_format($payment->unit_price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Pengiriman:</td>
                            <td class="text-end">Rp {{ number_format($payment->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Pajak:</td>
                            <td class="text-end">Rp {{ number_format($payment->tax, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-top">
                            <td><strong>Komisi ({{ $payment->commission_rate }}%):</strong></td>
                            <td class="text-end text-success">
                                <strong>Rp {{ number_format($payment->commission, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                        <tr class="border-top">
                            <td><strong>Pendapatan Bersih:</strong></td>
                            <td class="text-end text-info">
                                <strong>Rp {{ number_format($payment->net_amount, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Customer</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $payment->customer_name }}</h6>
                            <small class="text-muted">Customer</small>
                        </div>
                    </div>
                    
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><i class="fas fa-envelope text-muted me-2"></i></td>
                            <td>{{ $payment->customer_email }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-phone text-muted me-2"></i></td>
                            <td>{{ $payment->customer_phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Product Information -->
            <div class="card card-custom shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Produk</h6>
                </div>
                <div class="card-body">
                    <h6 class="mb-2">{{ $payment->product_name }}</h6>
                    <p class="text-muted mb-3">Quantity: {{ $payment->quantity }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Harga Satuan:</span>
                        <strong>Rp {{ number_format($payment->unit_price, 0, ',', '.') }}</strong>
                    </div>
                    
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Profit margin: {{ number_format(($payment->net_amount / $payment->amount * 100), 1) }}%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profit Analysis -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-custom shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Analisis Profit</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Total Penjualan</h5>
                                    <h3>Rp {{ number_format($payment->amount, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Pendapatan Bersih</h5>
                                    <h3>Rp {{ number_format($payment->net_amount, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5>Komisi</h5>
                                    <h3>Rp {{ number_format($payment->commission, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card {{ ($payment->net_amount / $payment->amount * 100) >= 30 ? 'bg-success' : (($payment->net_amount / $payment->amount * 100) >= 20 ? 'bg-warning' : 'bg-danger') }} text-white">
                                <div class="card-body">
                                    <h5>Profit Margin</h5>
                                    <h3>{{ number_format(($payment->net_amount / $payment->amount * 100), 1) }}%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" 
                                 style="width: {{ ($payment->net_amount / $payment->amount * 100) }}%"
                                 role="progressbar">
                                Profit: {{ number_format(($payment->net_amount / $payment->amount * 100), 1) }}%
                            </div>
                            <div class="progress-bar bg-warning" 
                                 style="width: {{ ($payment->commission / $payment->amount * 100) }}%"
                                 role="progressbar">
                                Komisi: {{ number_format(($payment->commission / $payment->amount * 100), 1) }}%
                            </div>
                            <div class="progress-bar bg-secondary" 
                                 style="width: {{ (($payment->shipping_cost + $payment->tax) / $payment->amount * 100) }}%"
                                 role="progressbar">
                                Biaya: {{ number_format((($payment->shipping_cost + $payment->tax) / $payment->amount * 100), 1) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueTrendChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: @json($detailChart['months']),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($detailChart['revenue_trend']),
                    backgroundColor: 'rgba(78, 115, 223, 0.8)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection