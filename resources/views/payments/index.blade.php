@extends('layouts.app')

@section('title', 'Pembayaran & Komisi - Toko Online UMKM')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">Pembayaran & Komisi</h1>
                <p class="mb-0 text-muted">Kelola pembayaran dan analisis komisi penjualan</p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <button class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Export Laporan
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Penjualan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</div>
                            <div class="mt-2 text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                <span>{{ $stats['growth_percentage'] }}%</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Komisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($stats['total_commission'], 0, ',', '.') }}</div>
                            <div class="mt-2 text-success">
                                <i class="fas fa-percentage me-1"></i>
                                <span>10% dari penjualan</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pembayaran Tertunda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($stats['pending_payments'], 0, ',', '.') }}</div>
                            <div class="mt-2 text-warning">
                                <i class="fas fa-clock me-1"></i>
                                <span>{{ $stats['total_transactions'] }} transaksi</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Profit Bersih</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($stats['net_profit'], 0, ',', '.') }}</div>
                            <div class="mt-2 text-info">
                                <i class="fas fa-chart-line me-1"></i>
                                <span>Setelah komisi & biaya</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <!-- Sales Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Trend Penjualan 2024</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                            <div class="dropdown-header">Opsi Chart:</div>
                            <a class="dropdown-item" href="#">Tampilkan Semua</a>
                            <a class="dropdown-item" href="#">6 Bulan Terakhir</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Export Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="salesChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit Distribution -->
        <div class="col-xl-4 col-lg-5">
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Profit per Produk</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="profitPieChart" height="250"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @foreach($productProfits as $product)
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: {{ $loop->index == 0 ? '#4e73df' : ($loop->index == 1 ? '#1cc88a' : ($loop->index == 2 ? '#36b9cc' : '#f6c23e')) }}"></i>
                            {{ substr($product->product_name, 0, 15) }}...
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembayaran</h6>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-2"></i>Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-export me-2"></i>Export Data</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Customer</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Komisi</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Metode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>
                                        <strong>{{ $payment->order_id }}</strong>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user me-2 text-muted"></i>
                                            <span>{{ $payment->customer_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $payment->product_name }}</div>
                                    </td>
                                    <td>
                                        <strong class="text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="text-success">Rp {{ number_format($payment->commission, 0, ',', '.') }}</span>
                                    </td>
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
                                    <td>
                                        {{ date('d M Y', strtotime($payment->payment_date)) }}
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $payment->payment_method }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary view-payment-detail" 
                                                    data-payment-id="{{ $payment->id }}"
                                                    title="Detail Pembayaran">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info" title="Download Invoice">
                                                <i class="fas fa-download"></i>
                                            </button>
                                            @if($payment->status == 'pending')
                                            <button class="btn btn-sm btn-outline-success confirm-payment" 
                                                    data-payment-id="{{ $payment->id }}"
                                                    title="Konfirmasi Pembayaran">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Profit Analysis Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-custom shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Analisis Profit per Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Total Penjualan</th>
                                    <th>Biaya Produksi</th>
                                    <th>Profit</th>
                                    <th>Margin</th>
                                    <th>Status Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productProfits as $product)
                                <tr>
                                    <td>
                                        <strong>{{ $product->product_name }}</strong>
                                    </td>
                                    <td>Rp {{ number_format($product->sales, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($product->cost, 0, ',', '.') }}</td>
                                    <td>
                                        <strong class="{{ $product->profit > 0 ? 'text-success' : 'text-danger' }}">
                                            Rp {{ number_format($product->profit, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        <span class="badge {{ $product->margin >= 30 ? 'bg-success' : ($product->margin >= 20 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $product->margin }}%
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->profit > 0)
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up me-1"></i>Untung
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                <i class="fas fa-arrow-down me-1"></i>Rugi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong>Rp {{ number_format(array_sum(array_column($productProfits, 'sales')), 0, ',', '.') }}</strong></td>
                                    <td><strong>Rp {{ number_format(array_sum(array_column($productProfits, 'cost')), 0, ',', '.') }}</strong></td>
                                    <td><strong class="text-success">Rp {{ number_format(array_sum(array_column($productProfits, 'profit')), 0, ',', '.') }}</strong></td>
                                    <td><strong>{{ number_format((array_sum(array_column($productProfits, 'profit')) / array_sum(array_column($productProfits, 'sales')) * 100), 1) }}%</strong></td>
                                    <td><strong class="text-success">UNTUNG</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Detail Modal -->
<div class="modal fade" id="paymentDetailModal" tabindex="-1" aria-labelledby="paymentDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentDetailModalLabel">Detail Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="paymentDetailContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-print me-2"></i>Cetak Invoice
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Payment Modal -->
<div class="modal fade" id="confirmPaymentModal" tabindex="-1" aria-labelledby="confirmPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="modal-title" id="confirmPaymentModalLabel">Konfirmasi Pembayaran</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?</p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>ID Pesanan:</strong> <span id="confirmOrderId"></span><br>
                    <strong>Jumlah:</strong> <span id="confirmAmount"></span>
                </div>
                <p class="small text-muted mb-0">
                    Pembayaran akan ditandai sebagai "Lunas" dan komisi akan diperhitungkan.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-success" id="confirmPaymentBtn">
                    <i class="fas fa-check me-2"></i>Ya, Konfirmasi
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .chart-area {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    .chart-pie {
        position: relative;
        height: 250px;
        width: 100%;
    }
    
    .profit-analysis tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($salesChart['labels']),
                datasets: [{
                    label: 'Penjualan',
                    data: @json($salesChart['data']),
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
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
                                return 'Penjualan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Profit Pie Chart
        const pieCtx = document.getElementById('profitPieChart').getContext('2d');
        const profitPieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: @json(array_column($productProfits, 'product_name')),
                datasets: [{
                    data: @json(array_column($productProfits, 'profit')),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': Rp ' + context.parsed.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            },
        });

        // Payment Detail Modal
        const viewPaymentButtons = document.querySelectorAll('.view-payment-detail');
        const paymentDetailModal = new bootstrap.Modal(document.getElementById('paymentDetailModal'));
        
        viewPaymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                const paymentId = this.getAttribute('data-payment-id');
                showPaymentDetail(paymentId);
            });
        });

        function showPaymentDetail(paymentId) {
            // Redirect to detail page instead of modal for full features
            window.location.href = `/payments/${paymentId}`;
        }

        // Confirm Payment Modal
        const confirmPaymentButtons = document.querySelectorAll('.confirm-payment');
        const confirmPaymentModal = new bootstrap.Modal(document.getElementById('confirmPaymentModal'));
        
        confirmPaymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                const paymentId = this.getAttribute('data-payment-id');
                const row = this.closest('tr');
                const orderId = row.querySelector('td:first-child strong').textContent;
                const amount = row.querySelector('td:nth-child(4) strong').textContent;
                
                showConfirmPaymentModal(paymentId, orderId, amount);
            });
        });

        function showConfirmPaymentModal(paymentId, orderId, amount) {
            document.getElementById('confirmOrderId').textContent = orderId;
            document.getElementById('confirmAmount').textContent = amount;
            
            document.getElementById('confirmPaymentBtn').onclick = function() {
                confirmPayment(paymentId);
            };
            
            confirmPaymentModal.show();
        }

        function confirmPayment(paymentId) {
            // Simulate API call
            fetch(`/payments/${paymentId}/confirm`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    confirmPaymentModal.hide();
                    showAlert('success', 'Pembayaran berhasil dikonfirmasi!');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(error => {
                showAlert('error', 'Terjadi kesalahan saat mengkonfirmasi pembayaran');
            });
        }

        function showAlert(type, message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.parentNode.removeChild(alertDiv);
                }
            }, 3000);
        }
    });
</script>
@endsection