@extends('layouts.app')

@section('title', 'Pesanan Keluar')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Pesanan Keluar</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Keluar</li>
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
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-number text-primary">{{ $stats['total_outgoing'] }}</div>
                <div class="stat-title">Total Pesanan Keluar</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-warning">
            <div class="card-body stat-card">
                <div class="stat-icon bg-warning-light rounded-circle p-3 mb-3">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-number text-warning">{{ $stats['processing'] }}</div>
                <div class="stat-title">Sedang Diproses</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-info">
            <div class="card-body stat-card">
                <div class="stat-icon bg-info-light rounded-circle p-3 mb-3">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="stat-number text-info">{{ $stats['shipped'] }}</div>
                <div class="stat-title">Dalam Pengiriman</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom border-left-success">
            <div class="card-body stat-card">
                <div class="stat-icon bg-success-light rounded-circle p-3 mb-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number text-success">{{ $stats['delivered'] }}</div>
                <div class="stat-title">Berhasil Dikirim</div>
            </div>
        </div>
    </div>
</div>

<!-- Orders Section -->
<div class="card card-custom">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="card-title mb-0">Daftar Pesanan Keluar</h5>
            </div>
            <div class="col-auto">
                <div class="filter-options btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" data-filter="all">Semua</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="processing">Diproses</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="shipped">Dikirim</button>
                    <button type="button" class="btn btn-outline-primary" data-filter="delivered">Terkirim</button>
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
                            @if($order->status == 'processing')
                                <span class="badge badge-custom bg-warning text-dark">
                                    <i class="fas fa-clock me-1"></i>Sedang Diproses
                                </span>
                            @elseif($order->status == 'shipped')
                                <span class="badge badge-custom bg-info text-white">
                                    <i class="fas fa-shipping-fast me-1"></i>Dalam Pengiriman
                                </span>
                            @elseif($order->status == 'delivered')
                                <span class="badge badge-custom bg-success text-white">
                                    <i class="fas fa-check-circle me-1"></i>Terkirim
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>

                                @if($order->status == 'processing')
                                    <button class="btn btn-sm btn-outline-info" onclick="showShipModal({{ $order->id }}, '{{ $order->product_name }}')" title="Kirim">
                                        <i class="fas fa-shipping-fast"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" onclick="showUpdateModal({{ $order->id }}, '{{ $order->product_name }}')" title="Update">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @elseif($order->status == 'shipped')
                                    <button class="btn btn-sm btn-outline-success" onclick="showMarkDeliveredModal({{ $order->id }}, '{{ $order->product_name }}')" title="Tandai Terkirim">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" onclick="showTrackModal({{ $order->id }}, '{{ $order->product_name }}')" title="Lacak">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </button>
                                @elseif($order->status == 'delivered')
                                    <button class="btn btn-sm btn-outline-secondary" onclick="showCompleteModal({{ $order->id }}, '{{ $order->product_name }}')" title="Selesai">
                                        <i class="fas fa-flag-checkered"></i>
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
        @if($orders->hasPages())
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>
                @foreach(range(1, $orders->lastPage()) as $i)
                    <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $orders->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
        @endif
    </div>
</div>

<!-- Modal untuk Kirim Pesanan -->
<div class="modal fade" id="shipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kirim Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda akan mengirim pesanan untuk produk <strong id="shipProductName"></strong>.</p>
                <div class="mb-3">
                    <label for="shipCourier" class="form-label">Kurir Pengiriman:</label>
                    <select class="form-select" id="shipCourier">
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
                    <label for="shipTrackingNumber" class="form-label">Nomor Resi:</label>
                    <input type="text" class="form-control" id="shipTrackingNumber" placeholder="Masukkan nomor resi">
                </div>
                <div class="mb-3">
                    <label for="shipNotes" class="form-label">Catatan Pengiriman (Opsional):</label>
                    <textarea class="form-control" id="shipNotes" rows="3" placeholder="Masukkan catatan pengiriman..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" id="confirmShip">Kirim Pesanan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Update Pesanan -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Update informasi untuk pesanan <strong id="updateProductName"></strong>.</p>
                <div class="mb-3">
                    <label for="updateStatus" class="form-label">Status Pesanan:</label>
                    <select class="form-select" id="updateStatus">
                        <option value="processing">Sedang Diproses</option>
                        <option value="shipped">Dalam Pengiriman</option>
                        <option value="delivered">Terkirim</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="updateNotes" class="form-label">Catatan Update:</label>
                    <textarea class="form-control" id="updateNotes" rows="3" placeholder="Masukkan catatan update..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning" id="confirmUpdate">Update Pesanan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tandai Terkirim -->
<div class="modal fade" id="markDeliveredModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tandai Sebagai Terkirim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menandai pesanan untuk produk <strong id="markDeliveredProductName"></strong> sebagai terkirim?</p>
                <p>Status pesanan akan berubah menjadi "Terkirim" dan pelanggan akan mendapatkan notifikasi.</p>
                <div class="mb-3">
                    <label for="deliveryConfirmation" class="form-label">Konfirmasi Pengiriman:</label>
                    <textarea class="form-control" id="deliveryConfirmation" rows="2" placeholder="Masukkan konfirmasi pengiriman (opsional)..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="confirmMarkDelivered">Ya, Tandai Terkirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Lacak Pesanan -->
<div class="modal fade" id="trackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lacak Pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Informasi tracking untuk pesanan <strong id="trackProductName"></strong>:</p>
                <div class="tracking-info">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Kurir:</strong>
                            <p id="trackCourier" class="mb-0">-</p>
                        </div>
                        <div class="col-md-4">
                            <strong>No. Resi:</strong>
                            <p id="trackNumber" class="mb-0">-</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Estimasi:</strong>
                            <p id="trackEstimate" class="mb-0">-</p>
                        </div>
                    </div>
                    <div class="tracking-status">
                        <strong>Status:</strong>
                        <div class="alert alert-info mt-2" id="trackStatus">
                            Memuat informasi tracking...
                        </div>
                    </div>
                    <div class="tracking-timeline mt-4">
                        <strong>Riwayat Pengiriman:</strong>
                        <div class="timeline mt-3" id="trackTimeline">
                            <!-- Timeline akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning" onclick="refreshOutgoingTracking()">
                    <i class="fas fa-sync-alt me-1"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Selesaikan Pesanan -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selesaikan Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyelesaikan pesanan untuk produk <strong id="completeProductName"></strong>?</p>
                <p>Pesanan akan diarsipkan dan statusnya berubah menjadi "Selesai". Tindakan ini tidak dapat dibatalkan.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Pastikan pesanan sudah benar-benar selesai sebelum melanjutkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-secondary" id="confirmComplete">Ya, Selesaikan</button>
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

    // Fungsi untuk menangani aksi pada pesanan keluar
    function showOrderDetail(orderId) {
        window.location.href = `/orders/${orderId}`;
    }

    // Modal functions untuk pesanan keluar
    function showShipModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('shipProductName').textContent = productName;
        document.getElementById('shipCourier').value = '';
        document.getElementById('shipTrackingNumber').value = '';
        document.getElementById('shipNotes').value = '';
        const modal = new bootstrap.Modal(document.getElementById('shipModal'));
        modal.show();
    }

    function showUpdateModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('updateProductName').textContent = productName;
        document.getElementById('updateStatus').value = 'processing';
        document.getElementById('updateNotes').value = '';
        const modal = new bootstrap.Modal(document.getElementById('updateModal'));
        modal.show();
    }

    function showMarkDeliveredModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('markDeliveredProductName').textContent = productName;
        document.getElementById('deliveryConfirmation').value = '';
        const modal = new bootstrap.Modal(document.getElementById('markDeliveredModal'));
        modal.show();
    }

    function showTrackModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('trackProductName').textContent = productName;
        loadOutgoingTrackingInfo(orderId);
        const modal = new bootstrap.Modal(document.getElementById('trackModal'));
        modal.show();
    }

    function showCompleteModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('completeProductName').textContent = productName;
        const modal = new bootstrap.Modal(document.getElementById('completeModal'));
        modal.show();
    }

    // Confirm actions
    document.getElementById('confirmShip').addEventListener('click', function() {
        const courier = document.getElementById('shipCourier').value;
        const trackingNumber = document.getElementById('shipTrackingNumber').value;
        const notes = document.getElementById('shipNotes').value;

        if (!courier) {
            showAlert('error', 'Pilih kurir pengiriman terlebih dahulu');
            return;
        }

        if (!trackingNumber) {
            showAlert('error', 'Masukkan nomor resi terlebih dahulu');
            return;
        }

        shipOrder(currentOrderId, courier, trackingNumber, notes);
        bootstrap.Modal.getInstance(document.getElementById('shipModal')).hide();
    });

    document.getElementById('confirmUpdate').addEventListener('click', function() {
        const status = document.getElementById('updateStatus').value;
        const notes = document.getElementById('updateNotes').value;

        updateOrder(currentOrderId, status, notes);
        bootstrap.Modal.getInstance(document.getElementById('updateModal')).hide();
    });

    document.getElementById('confirmMarkDelivered').addEventListener('click', function() {
        const confirmation = document.getElementById('deliveryConfirmation').value;
        markDelivered(currentOrderId, confirmation);
        bootstrap.Modal.getInstance(document.getElementById('markDeliveredModal')).hide();
    });

    document.getElementById('confirmComplete').addEventListener('click', function() {
        completeOrder(currentOrderId);
        bootstrap.Modal.getInstance(document.getElementById('completeModal')).hide();
    });

    // AJAX functions untuk pesanan keluar
    function shipOrder(orderId, courier, trackingNumber, notes) {
        fetch(`/orders/${orderId}/ship`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                courier: courier,
                tracking_number: trackingNumber,
                notes: notes
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
            showAlert('error', 'Terjadi kesalahan saat mengirim pesanan');
        });
    }

    function updateOrder(orderId, status, notes) {
        fetch(`/orders/${orderId}/update`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: status,
                notes: notes
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
            showAlert('error', 'Terjadi kesalahan saat mengupdate pesanan');
        });
    }

    function markDelivered(orderId, confirmation) {
        fetch(`/orders/${orderId}/mark-delivered`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                confirmation: confirmation
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

    function completeOrder(orderId) {
        fetch(`/orders/${orderId}/complete`, {
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
            showAlert('error', 'Terjadi kesalahan saat menyelesaikan pesanan');
        });
    }

    function loadOutgoingTrackingInfo(orderId) {
        // Simulasi data tracking untuk pesanan keluar
        const trackingData = {
            courier: 'JNE',
            tracking_number: 'RESI123456789',
            estimate: '18 Jan 2024',
            status: 'Paket dalam perjalanan ke alamat penerima',
            timeline: [
                { time: '2024-01-15 14:30', description: 'Paket dalam perjalanan ke kota tujuan', status: 'in_transit' },
                { time: '2024-01-15 12:15', description: 'Paket tiba di hub pengiriman', status: 'arrived' },
                { time: '2024-01-15 10:00', description: 'Paket dipickup oleh kurir', status: 'picked_up' },
                { time: '2024-01-15 08:30', description: 'Paket dikemas dan siap dikirim', status: 'processed' }
            ]
        };

        document.getElementById('trackCourier').textContent = trackingData.courier;
        document.getElementById('trackNumber').textContent = trackingData.tracking_number;
        document.getElementById('trackEstimate').textContent = trackingData.estimate;
        document.getElementById('trackStatus').textContent = trackingData.status;

        const timelineElement = document.getElementById('trackTimeline');
        timelineElement.innerHTML = '';

        trackingData.timeline.forEach((item, index) => {
            const timelineItem = document.createElement('div');
            timelineItem.className = `timeline-item ${index === 0 ? 'active' : ''}`;
            timelineItem.innerHTML = `
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="timeline-time">${item.time}</div>
                    <div class="timeline-description">${item.description}</div>
                </div>
            `;
            timelineElement.appendChild(timelineItem);
        });
    }

    function refreshOutgoingTracking() {
        if (currentOrderId) {
            loadOutgoingTrackingInfo(currentOrderId);
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

<style>
    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }

    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #dee2e6;
        border: 2px solid #fff;
    }

    .timeline-item.active .timeline-marker {
        background-color: #0d6efd;
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 5px;
        border-left: 3px solid #dee2e6;
    }

    .timeline-item.active .timeline-content {
        border-left-color: #0d6efd;
    }

    .timeline-time {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }

    .timeline-description {
        font-size: 0.9rem;
        color: #495057;
        margin-top: 5px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: -24px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #dee2e6;
    }
</style>
@endsection
