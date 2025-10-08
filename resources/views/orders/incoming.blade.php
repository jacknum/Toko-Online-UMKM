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
                                    <button class="btn btn-sm btn-outline-success" onclick="showAcceptModal({{ $order->id }}, '{{ $order->product_name }}')" title="Terima">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="showRejectModal({{ $order->id }}, '{{ $order->product_name }}')" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @elseif($order->status == 'confirmed')
                                    <button class="btn btn-sm btn-outline-info" onclick="showProcessModal({{ $order->id }}, '{{ $order->product_name }}')" title="Proses">
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

<!-- Modal Konfirmasi Terima Pesanan -->
<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="modal-title" id="acceptModalLabel">Konfirmasi Terima Pesanan</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menerima pesanan ini?</p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Produk:</strong> <span id="acceptProductName"></span>
                </div>
                <p class="small text-muted mb-0">
                    Pesanan akan dipindahkan ke status "Dikonfirmasi" dan siap untuk diproses.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-success" id="confirmAcceptBtn">
                    <i class="fas fa-check me-2"></i>Ya, Terima Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Tolak Pesanan -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-times"></i>
                    </div>
                    <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Tolak Pesanan</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak pesanan ini?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Produk:</strong> <span id="rejectProductName"></span>
                </div>
                <div class="mb-3">
                    <label for="rejectReason" class="form-label">Alasan Penolakan (Opsional)</label>
                    <textarea class="form-control" id="rejectReason" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <p class="small text-danger mb-0">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmRejectBtn">
                    <i class="fas fa-times me-2"></i>Ya, Tolak Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Proses Pesanan -->
<div class="modal fade" id="processModal" tabindex="-1" aria-labelledby="processModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h5 class="modal-title" id="processModalLabel">Proses Pengiriman</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda ingin memproses pesanan ini untuk pengiriman?</p>
                <div class="alert alert-info">
                    <i class="fas fa-box me-2"></i>
                    <strong>Produk:</strong> <span id="processProductName"></span>
                </div>
                <div class="mb-3">
                    <label for="trackingNumber" class="form-label">Nomor Resi</label>
                    <input type="text" class="form-control" id="trackingNumber" placeholder="Masukkan nomor resi...">
                </div>
                <div class="mb-3">
                    <label for="shippingService" class="form-label">Layanan Pengiriman</label>
                    <select class="form-select" id="shippingService">
                        <option value="">Pilih layanan...</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS Indonesia</option>
                        <option value="jnt">J&T Express</option>
                        <option value="sicepat">SiCepat</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-info" id="confirmProcessBtn">
                    <i class="fas fa-shipping-fast me-2"></i>Proses Pengiriman
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body text-center py-5">
                <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="mb-2">Memproses...</h5>
                <p class="text-muted mb-0">Sedang memproses permintaan Anda</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: none;
    }
    
    .modal-header {
        padding: 1.5rem 1.5rem 0.5rem;
    }
    
    .modal-body {
        padding: 0 1.5rem 1rem;
    }
    
    .modal-footer {
        padding: 1rem 1.5rem 1.5rem;
    }
    
    .modal-title {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .alert {
        border: none;
        border-radius: 10px;
        padding: 12px 15px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endsection

@section('scripts')
<script>
    let currentOrderId = null;
    let currentOrderName = null;
    
    // Fungsi untuk mengelola filter pesanan
    document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('[data-filter]').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            });
            
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
    
    // Modal Functions
    function showAcceptModal(orderId, productName) {
        currentOrderId = orderId;
        currentOrderName = productName;
        
        document.getElementById('acceptProductName').textContent = productName;
        
        const modal = new bootstrap.Modal(document.getElementById('acceptModal'));
        modal.show();
    }
    
    function showRejectModal(orderId, productName) {
        currentOrderId = orderId;
        currentOrderName = productName;
        
        document.getElementById('rejectProductName').textContent = productName;
        document.getElementById('rejectReason').value = '';
        
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        modal.show();
    }
    
    function showProcessModal(orderId, productName) {
        currentOrderId = orderId;
        currentOrderName = productName;
        
        document.getElementById('processProductName').textContent = productName;
        document.getElementById('trackingNumber').value = '';
        document.getElementById('shippingService').value = '';
        
        const modal = new bootstrap.Modal(document.getElementById('processModal'));
        modal.show();
    }
    
    function showLoadingModal() {
        const modal = new bootstrap.Modal(document.getElementById('loadingModal'));
        modal.show();
        return modal;
    }
    
    // Event Listeners untuk Modal Buttons
    document.getElementById('confirmAcceptBtn').addEventListener('click', function() {
        const loadingModal = showLoadingModal();
        bootstrap.Modal.getInstance(document.getElementById('acceptModal')).hide();
        
        acceptOrder(currentOrderId, loadingModal);
    });
    
    document.getElementById('confirmRejectBtn').addEventListener('click', function() {
        const rejectReason = document.getElementById('rejectReason').value;
        const loadingModal = showLoadingModal();
        bootstrap.Modal.getInstance(document.getElementById('rejectModal')).hide();
        
        rejectOrder(currentOrderId, rejectReason, loadingModal);
    });
    
    document.getElementById('confirmProcessBtn').addEventListener('click', function() {
        const trackingNumber = document.getElementById('trackingNumber').value;
        const shippingService = document.getElementById('shippingService').value;
        const loadingModal = showLoadingModal();
        bootstrap.Modal.getInstance(document.getElementById('processModal')).hide();
        
        processOrder(currentOrderId, trackingNumber, shippingService, loadingModal);
    });
    
    // AJAX Functions
    function acceptOrder(orderId, loadingModal) {
        fetch(`/orders/${orderId}/accept`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            loadingModal.hide();
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            loadingModal.hide();
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }
    
    function rejectOrder(orderId, reason, loadingModal) {
        fetch(`/orders/${orderId}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ reason: reason })
        })
        .then(response => response.json())
        .then(data => {
            loadingModal.hide();
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            loadingModal.hide();
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }
    
    function processOrder(orderId, trackingNumber, shippingService, loadingModal) {
        if (!trackingNumber.trim()) {
            loadingModal.hide();
            showAlert('warning', 'Harap masukkan nomor resi');
            return;
        }
        
        if (!shippingService.trim()) {
            loadingModal.hide();
            showAlert('warning', 'Harap pilih layanan pengiriman');
            return;
        }
        
        fetch(`/orders/${orderId}/process`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                tracking_number: trackingNumber,
                shipping_service: shippingService
            })
        })
        .then(response => response.json())
        .then(data => {
            loadingModal.hide();
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            loadingModal.hide();
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }
    
    function showOrderDetail(orderId) {
        window.location.href = `/orders/${orderId}`;
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