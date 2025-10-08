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
                                    <button class="btn btn-sm btn-outline-warning" onclick="showTrackModal({{ $order->id }}, '{{ $order->product_name }}')" title="Lacak">
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

<!-- Modal untuk Terima Pesanan -->
<div class="modal fade" id="acceptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terima Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menerima pesanan untuk produk <strong id="acceptProductName"></strong>?</p>
                <p>Pesanan akan dipindahkan ke status "Dikonfirmasi" dan siap untuk diproses.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="confirmAccept">Ya, Terima Pesanan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tolak Pesanan -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak pesanan untuk produk <strong id="rejectProductName"></strong>?</p>
                <div class="mb-3">
                    <label for="rejectReason" class="form-label">Alasan Penolakan (Opsional):</label>
                    <textarea class="form-control" id="rejectReason" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmReject">Ya, Tolak Pesanan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Proses Pesanan -->
<div class="modal fade" id="processModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proses Pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda akan memproses pengiriman untuk pesanan <strong id="processProductName"></strong>.</p>
                <div class="mb-3">
                    <label for="courier" class="form-label">Kurir Pengiriman:</label>
                    <select class="form-select" id="courier">
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS Indonesia</option>
                        <option value="jnt">J&T Express</option>
                        <option value="sicepat">SiCepat</option>
                        <option value="anteraja">Anteraja</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="trackingNumber" class="form-label">Nomor Resi:</label>
                    <input type="text" class="form-control" id="trackingNumber" placeholder="Masukkan nomor resi">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" id="confirmProcess">Proses Pengiriman</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Lacak Pesanan -->
<div class="modal fade" id="trackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lacak Pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Informasi tracking untuk pesanan <strong id="trackProductName"></strong>:</p>
                <div class="tracking-info">
                    <div class="row">
                        <div class="col-6">
                            <strong>Kurir:</strong>
                            <p id="trackCourier">-</p>
                        </div>
                        <div class="col-6">
                            <strong>No. Resi:</strong>
                            <p id="trackNumber">-</p>
                        </div>
                    </div>
                    <div class="tracking-status">
                        <strong>Status:</strong>
                        <div class="alert alert-info mt-2" id="trackStatus">
                            Sedang dalam proses pengiriman
                        </div>
                    </div>
                    <div class="tracking-timeline mt-3">
                        <strong>Riwayat Pengiriman:</strong>
                        <ul class="list-group mt-2" id="trackTimeline">
                            <li class="list-group-item">
                                <small>15 Jan 2024 10:30</small><br>
                                Pesanan dipickup oleh kurir
                            </li>
                            <li class="list-group-item">
                                <small>15 Jan 2024 08:15</small><br>
                                Pesanan dikemas dan siap dikirim
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning" onclick="refreshTracking()">
                    <i class="fas fa-sync-alt me-1"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentOrderId = null;

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

    // Fungsi untuk menangani aksi pada pesanan
    function showOrderDetail(orderId) {
        window.location.href = `/orders/${orderId}`;
    }

    // Modal functions
    function showAcceptModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('acceptProductName').textContent = productName;
        const modal = new bootstrap.Modal(document.getElementById('acceptModal'));
        modal.show();
    }

    function showRejectModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('rejectProductName').textContent = productName;
        document.getElementById('rejectReason').value = '';
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        modal.show();
    }

    function showProcessModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('processProductName').textContent = productName;
        document.getElementById('courier').value = '';
        document.getElementById('trackingNumber').value = '';
        const modal = new bootstrap.Modal(document.getElementById('processModal'));
        modal.show();
    }

    function showTrackModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('trackProductName').textContent = productName;
        loadTrackingInfo(orderId);
        const modal = new bootstrap.Modal(document.getElementById('trackModal'));
        modal.show();
    }

    // Confirm actions
    document.getElementById('confirmAccept').addEventListener('click', function() {
        acceptOrder(currentOrderId);
        bootstrap.Modal.getInstance(document.getElementById('acceptModal')).hide();
    });

    document.getElementById('confirmReject').addEventListener('click', function() {
        const reason = document.getElementById('rejectReason').value;
        rejectOrder(currentOrderId, reason);
        bootstrap.Modal.getInstance(document.getElementById('rejectModal')).hide();
    });

    document.getElementById('confirmProcess').addEventListener('click', function() {
        const courier = document.getElementById('courier').value;
        const trackingNumber = document.getElementById('trackingNumber').value;

        if (!courier) {
            showAlert('error', 'Pilih kurir pengiriman terlebih dahulu');
            return;
        }

        if (!trackingNumber) {
            showAlert('error', 'Masukkan nomor resi terlebih dahulu');
            return;
        }

        processOrder(currentOrderId, courier, trackingNumber);
        bootstrap.Modal.getInstance(document.getElementById('processModal')).hide();
    });

    // AJAX functions
    function acceptOrder(orderId) {
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
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }

    function rejectOrder(orderId, reason) {
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
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }

    function processOrder(orderId, courier, trackingNumber) {
        fetch(`/orders/${orderId}/process`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                courier: courier,
                tracking_number: trackingNumber
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(error => {
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }

    function loadTrackingInfo(orderId) {
        // Simulasi data tracking
        const trackingData = {
            courier: 'JNE',
            tracking_number: 'RESI123456789',
            status: 'Dalam Perjalanan ke Kota Tujuan',
            timeline: [
                { time: '2024-01-15 14:30', description: 'Pesanan dalam perjalanan ke hub pengiriman' },
                { time: '2024-01-15 10:15', description: 'Pesanan dipickup oleh kurir' },
                { time: '2024-01-15 08:00', description: 'Pesanan dikemas dan siap dikirim' }
            ]
        };

        document.getElementById('trackCourier').textContent = trackingData.courier;
        document.getElementById('trackNumber').textContent = trackingData.tracking_number;
        document.getElementById('trackStatus').textContent = trackingData.status;

        const timelineElement = document.getElementById('trackTimeline');
        timelineElement.innerHTML = '';

        trackingData.timeline.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = `<small>${item.time}</small><br>${item.description}`;
            timelineElement.appendChild(li);
        });
    }

    function refreshTracking() {
        if (currentOrderId) {
            loadTrackingInfo(currentOrderId);
            showAlert('info', 'Informasi tracking diperbarui');
        }
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
