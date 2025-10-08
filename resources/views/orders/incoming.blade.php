@extends('layouts.app')

@section('title', 'Pesanan Masuk')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Pesanan Masuk</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Masuk</li>
                </ol>
            </nav>
        </div>
        <div class="col-auto">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Export Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-primary">
            <div class="card-body stat-card">
                <div class="stat-icon bg-primary-light rounded-circle p-3 mb-3">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-number text-primary">{{ $stats['new_orders'] }}</div>
                <div class="stat-title">Pesanan Baru</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-warning">
            <div class="card-body stat-card">
                <div class="stat-icon bg-warning-light rounded-circle p-3 mb-3">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number text-warning">{{ $stats['pending_confirmation'] }}</div>
                <div class="stat-title">Menunggu Konfirmasi</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-success">
            <div class="card-body stat-card">
                <div class="stat-icon bg-success-light rounded-circle p-3 mb-3">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-number text-success">{{ $stats['today_orders'] }}</div>
                <div class="stat-title">Pesanan Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-info">
            <div class="card-body stat-card">
                <div class="stat-icon bg-danger-light rounded-circle p-3 mb-3">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-info">Rp {{ number_format($stats['total_value'], 0, ',', '.') }}</div>
                <div class="stat-title">Total Nilai Pesanan</div>
            </div>
        </div>
    </div>
</div>

<!-- Orders Section -->
<div class="card card-custom">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="card-title mb-0">Daftar Pesanan</h5>
            </div>
            <div class="col-auto">
                <div class="filter-options btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" data-filter="all">Semua</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="pending">Baru</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="confirmed">Diproses</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="shipped">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-custom">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Customer</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="order-row" data-status="{{ $order->status }}">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-size: 0.8rem; font-weight: bold;">
                                    {{ substr($order->product_name, 0, 2) }}
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $order->product_name }}</h6>
                                    <small class="text-muted">{{ date('d M Y', strtotime($order->created_at)) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user me-2 text-muted"></i>
                                <span>{{ $order->customer_name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $order->quantity }}</span>
                        </td>
                        <td>
                            <strong>Rp {{ number_format($order->price, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge badge-custom bg-warning text-dark">
                                    <i class="fas fa-clock me-1"></i>Menunggu Konfirmasi
                                </span>
                            @elseif($order->status == 'confirmed')
                                <span class="badge badge-custom bg-info text-white">
                                    <i class="fas fa-check me-1"></i>Dikonfirmasi
                                </span>
                            @elseif($order->status == 'shipped')
                                <span class="badge badge-custom bg-success text-white">
                                    <i class="fas fa-shipping-fast me-1"></i>Dikirim
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                @if($order->status == 'pending')
                                    <button class="btn btn-sm btn-outline-success" onclick="acceptOrder({{ $order->id }})" title="Terima">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="rejectOrder({{ $order->id }})" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @elseif($order->status == 'confirmed')
                                    <button class="btn btn-sm btn-outline-info" onclick="processOrder({{ $order->id }})" title="Proses">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                @elseif($order->status == 'shipped')
                                    <button class="btn btn-sm btn-outline-warning" onclick="trackOrder({{ $order->id }})" title="Lacak">
                                        <i class="fas fa-map-marker-alt"></i>
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
@endsection

@section('scripts')
<script>
    // Fungsi untuk mengelola filter pesanan
    document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', function() {
            // Hapus kelas active dari semua tombol filter
            document.querySelectorAll('[data-filter]').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            });
            
            // Tambahkan kelas active ke tombol yang diklik
            this.classList.add('active');
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
            
            const filter = this.dataset.filter;
            filterOrders(filter);
        });
    });
    
    function filterOrders(status) {
        const orders = document.querySelectorAll('.order-row');
        orders.forEach(order => {
            if (status === 'all' || order.dataset.status === status) {
                order.style.display = 'table-row';
            } else {
                order.style.display = 'none';
            }
        });
    }
    
    // Fungsi untuk menangani aksi pada pesanan
    function showOrderDetail(orderId) {
        // Redirect ke halaman detail pesanan
        window.location.href = `/orders/${orderId}`;
    }
    
    function acceptOrder(orderId) {
        if (confirm('Apakah Anda yakin ingin menerima pesanan ini?')) {
            // AJAX request untuk menerima pesanan
            fetch(`/orders/${orderId}/accept`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(error => {
                showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
            });
        }
    }
    
    function rejectOrder(orderId) {
        if (confirm('Apakah Anda yakin ingin menolak pesanan ini?')) {
            // AJAX request untuk menolak pesanan
            fetch(`/orders/${orderId}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(error => {
                showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
            });
        }
    }
    
    function processOrder(orderId) {
        // AJAX request untuk memproses pesanan
        fetch(`/orders/${orderId}/process`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        })
        .catch(error => {
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }
    
    function trackOrder(orderId) {
        // AJAX request untuk melacak pesanan
        fetch(`/orders/${orderId}/track`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('info', data.message);
            }
        })
        .catch(error => {
            showAlert('error', 'Terjadi kesalahan saat melacak pesanan');
        });
    }
    
    function showAlert(type, message) {
        // Create alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 3000);
    }
</script>
@endsection