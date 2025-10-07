@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <p class="mb-0 text-muted">Ringkasan performa toko online Anda</p>
                </div>
                <div class="col-auto">
                    <div class="card report-card" onclick="generateReport()">
                        <div class="card-body text-center">
                            <i class="fas fa-download fa-2x mb-3"></i>
                            <h5>Generate Report</h5>
                            <p class="small mb-0">Download laporan lengkap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produk Saya</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">145</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
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
                                Pesanan Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">67</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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
                                Pesanan Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">42</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
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
                                Pembayaran & Fee</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 18.250.000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Chart Area -->
        <div class="col-xl-8 col-lg-7">
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Pendapatan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueChart" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-xl-4 col-lg-5">
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item d-flex mb-3">
                            <div class="activity-icon bg-primary-light rounded-circle p-2 me-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Pesanan baru #ORD-0012</p>
                                <small class="text-muted">2 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex mb-3">
                            <div class="activity-icon bg-success-light rounded-circle p-2 me-3">
                                <i class="fas fa-money-bill-wave text-success"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Pembayaran diterima dari #ORD-0008</p>
                                <small class="text-muted">1 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex mb-3">
                            <div class="activity-icon bg-warning-light rounded-circle p-2 me-3">
                                <i class="fas fa-box text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Stok produk "Sepatu Sport" hampir habis</p>
                                <small class="text-muted">3 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex">
                            <div class="activity-icon bg-danger-light rounded-circle p-2 me-3">
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Pesanan #ORD-0005 dibatalkan</p>
                                <small class="text-muted">5 jam yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sepatu Running Premium</td>
                                    <td>Olahraga</td>
                                    <td>Rp 450.000</td>
                                    <td>24</td>
                                    <td><span class="badge bg-success badge-custom">Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tas Laptop Minimalis</td>
                                    <td>Aksesoris</td>
                                    <td>Rp 320.000</td>
                                    <td>15</td>
                                    <td><span class="badge bg-success badge-custom">Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Smartwatch Series 5</td>
                                    <td>Elektronik</td>
                                    <td>Rp 1.200.000</td>
                                    <td>8</td>
                                    <td><span class="badge bg-warning badge-custom">Stok Sedikit</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kaos Polo Cotton</td>
                                    <td>Pakaian</td>
                                    <td>Rp 125.000</td>
                                    <td>0</td>
                                    <td><span class="badge bg-danger badge-custom">Habis</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple chart implementation
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Create gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(78, 115, 223, 0.5)');
        gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');
        
        // Chart data
        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendapatan (Juta Rupiah)',
                data: [5, 7, 8, 10, 12, 15, 18, 16, 14, 12, 10, 8],
                backgroundColor: gradient,
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                fill: true
            }]
        };
        
        // Chart options
        const options = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value + 'jt';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' + context.parsed.y + ' juta';
                        }
                    }
                }
            }
        };
        
        // Create chart
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    });
</script>
@endsection