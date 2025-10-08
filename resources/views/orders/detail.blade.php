@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Detail Pesanan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.incoming') }}">Pesanan Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                </ol>
            </nav>
        </div>
        <div class="col-auto">
            <div class="btn-group" role="group">
                <a href="{{ route('orders.incoming') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Order Info Card -->
        <div class="card card-custom mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Informasi Pesanan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>ID Pesanan</strong></td>
                                <td>: #ORD{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pesan</strong></td>
                                <td>: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
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
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Total Harga</strong></td>
                                <td>: <span class="text-primary fw-bold">Rp {{ number_format($order->price, 0, ',', '.') }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran</strong></td>
                                <td>: Transfer Bank</td>
                            </tr>
                            <tr>
                                <td><strong>No. Resi</strong></td>
                                <td>: {{ $order->tracking_number ?? 'Belum tersedia' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info Card -->
        <div class="card card-custom mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-box me-2"></i>Informasi Produk
                </h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1rem; font-weight: bold;">
                            {{ substr($order->product_name, 0, 2) }}
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="mb-1">{{ $order->product_name }}</h5>
                        <p class="text-muted mb-0">Kategori: Fashion</p>
                    </div>
                    <div class="col-auto text-end">
                        <div class="h5 text-primary mb-1">Rp {{ number_format($order->price, 0, ',', '.') }}</div>
                        <div class="text-muted">Qty: {{ $order->quantity }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Customer Info Card -->
        <div class="card card-custom mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>Informasi Customer
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $order->customer_name }}</h6>
                        <small class="text-muted">Customer</small>
                    </div>
                </div>
                
                <table class="table table-borderless">
                    <tr>
                        <td width="30%"><strong>Email</strong></td>
                        <td>: customer@example.com</td>
                    </tr>
                    <tr>
                        <td><strong>Telepon</strong></td>
                        <td>: 081234567890</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>: Jl. Contoh Alamat No. 123, Jakarta</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Action Card -->
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-cog me-2"></i>Aksi Pesanan
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($order->status == 'pending')
                        <button class="btn btn-success mb-2" onclick="acceptOrder({{ $order->id }})">
                            <i class="fas fa-check me-2"></i>Terima Pesanan
                        </button>
                        <button class="btn btn-danger mb-2" onclick="rejectOrder({{ $order->id }})">
                            <i class="fas fa-times me-2"></i>Tolak Pesanan
                        </button>
                    @elseif($order->status == 'confirmed')
                        <button class="btn btn-info mb-2" onclick="processOrder({{ $order->id }})">
                            <i class="fas fa-shipping-fast me-2"></i>Proses Pengiriman
                        </button>
                    @elseif($order->status == 'shipped')
                        <button class="btn btn-warning mb-2" onclick="trackOrder({{ $order->id }})">
                            <i class="fas fa-map-marker-alt me-2"></i>Lacak Pengiriman
                        </button>
                    @endif
                    
                    <button class="btn btn-outline-primary" onclick="contactCustomer()">
                        <i class="fas fa-phone me-2"></i>Hubungi Customer
                    </button>
                </div>
            </div>
        </div>

        <!-- Timeline Card -->
        <div class="card card-custom mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-history me-2"></i>Status Timeline
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item {{ $order->status == 'pending' ? 'active' : '' }}">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Pesanan Masuk</h6>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</small>
                        </div>
                    </div>
                    <div class="timeline-item {{ $order->status == 'confirmed' || $order->status == 'shipped' ? 'active' : '' }}">
                        <div class="timeline-marker {{ $order->status == 'confirmed' || $order->status == 'shipped' ? 'bg-info' : 'bg-light' }}"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Pesanan Dikonfirmasi</h6>
                            <small class="text-muted">
                                @if($order->status == 'confirmed' || $order->status == 'shipped')
                                    {{ \Carbon\Carbon::parse($order->created_at)->addHours(2)->format('d M Y H:i') }}
                                @else
                                    Menunggu konfirmasi
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="timeline-item {{ $order->status == 'shipped' ? 'active' : '' }}">
                        <div class="timeline-marker {{ $order->status == 'shipped' ? 'bg-success' : 'bg-light' }}"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Pesanan Dikirim</h6>
                            <small class="text-muted">
                                @if($order->status == 'shipped')
                                    {{ \Carbon\Carbon::parse($order->created_at)->addDays(1)->format('d M Y H:i') }}
                                @else
                                    Menunggu pengiriman
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px #e9ecef;
    }
    
    .timeline-item.active .timeline-marker {
        box-shadow: 0 0 0 3px var(--primary);
    }
    
    .timeline-content h6 {
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    
    .timeline-content small {
        font-size: 0.8rem;
    }
    
    .timeline-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: -25px;
        top: 12px;
        bottom: -20px;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item.active:not(:last-child)::after {
        background-color: var(--primary);
    }
</style>
@endsection

@section('scripts')
<script>
    function acceptOrder(orderId) {
        if (confirm('Apakah Anda yakin ingin menerima pesanan ini?')) {
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
                        location.href = '{{ route("orders.incoming") }}';
                    }, 1500);
                }
            })
            .catch(error => {
                showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
            });
        }
    }
    
    function processOrder(orderId) {
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
    
    function contactCustomer() {
        alert('Fitur hubungi customer akan segera tersedia');
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
</script>
@endsection