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
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom" style="border-left: 4px solid #007bff;">
            <div class="card-body stat-card">
                <div class="stat-icon bg-primary-light rounded-circle p-3 mb-3">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number text-primary">{{ $stats['unpaid'] ?? 0 }}</div>
                <div class="stat-title">Belum Bayar</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom" style="border-left: 4px solid #ffc107;">
            <div class="card-body stat-card">
                <div class="stat-icon bg-warning-light rounded-circle p-3 mb-3">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-number text-warning">{{ $stats['processing'] }}</div>
                <div class="stat-title">Sedang Diproses</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom" style="border-left: 4px solid #17a2b8;">
            <div class="card-body stat-card">
                <div class="stat-icon bg-info-light rounded-circle p-3 mb-3">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="stat-number text-info">{{ $stats['shipped'] }}</div>
                <div class="stat-title">Dalam Pengiriman</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom" style="border-left: 4px solid #28a745;">
            <div class="card-body stat-card">
                <div class="stat-icon bg-success-light rounded-circle p-3 mb-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number text-success">{{ $stats['delivered'] }}</div>
                <div class="stat-title">Berhasil Dikirim</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom" style="border-left: 4px solid #6c757d;">
            <div class="card-body stat-card">
                <div class="stat-icon bg-secondary-light rounded-circle p-3 mb-3">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="stat-number text-secondary">{{ $stats['completed'] ?? 0 }}</div>
                <div class="stat-title">Selesai</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom" style="border-left: 4px solid #dc3545;">
            <div class="card-body stat-card">
                <div class="stat-icon bg-danger-light rounded-circle p-3 mb-3">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-number text-danger">{{ $stats['cancelled'] ?? 0 }}</div>
                <div class="stat-title">Dibatalkan</div>
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
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'all', 'page' => 1]) }}"
                       class="btn {{ request('filter', 'all') == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Semua
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'unpaid', 'page' => 1]) }}"
                       class="btn {{ request('filter') == 'unpaid' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Belum Bayar
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'processing', 'page' => 1]) }}"
                       class="btn {{ request('filter') == 'processing' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Diproses
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'shipped', 'page' => 1]) }}"
                       class="btn {{ request('filter') == 'shipped' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Dikirim
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'delivered', 'page' => 1]) }}"
                       class="btn {{ request('filter') == 'delivered' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Terkirim
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'completed', 'page' => 1]) }}"
                       class="btn {{ request('filter') == 'completed' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Selesai
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'cancelled', 'page' => 1]) }}"
                       class="btn {{ request('filter') == 'cancelled' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Dibatalkan
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Order Cards -->
        <div class="row" id="orders-container">
            @forelse($orders as $order)
            <div class="col-md-6 col-lg-4 mb-4 order-card">
                <div class="card h-100 order-item-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="order-id">#{{ $order->order_number ?? $order->id }}</span>
                        <span class="order-date">{{ date('d M Y', strtotime($order->created_at)) }}</span>
                    </div>
                    <div class="card-body">
                        <!-- Product Info -->
                        <div class="product-info mb-3">
                            <div class="d-flex align-items-center">
                                <div class="product-image bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 0.9rem; font-weight: bold;">
                                    {{ substr($order->product_name, 0, 2) }}
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $order->product_name }}</h6>
                                    <small class="text-muted">Qty: {{ $order->quantity }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="customer-info mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user me-2 text-muted"></i>
                                <span>{{ $order->customer_name }}</span>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="payment-info mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Harga Produk:</span>
                                <span>Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Total Pembayaran:</span>
                                <span class="fw-bold">Rp {{ number_format($order->total_price ?? $order->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Status Info -->
                        <div class="status-info mb-3">
                            @if($order->status == 'unpaid')
                                <div class="alert alert-warning py-2 mb-2">
                                    <small><i class="fas fa-clock me-1"></i>Menunggu Pembayaran</small>
                                </div>
                                <p class="small text-muted mb-0">Segera lakukan pembayaran dalam 1x24 jam, atau pesanan Anda akan otomatis dibatalkan.</p>
                            @elseif($order->status == 'processing')
                                <div class="alert alert-info py-2 mb-2">
                                    <small><i class="fas fa-box me-1"></i>Pesanan sedang dikemas</small>
                                </div>
                                <p class="small text-muted mb-0">Perkiraan tiba pada tanggal 28 - 30 September 2025.</p>
                            @elseif($order->status == 'shipped')
                                <div class="alert alert-primary py-2 mb-2">
                                    <small><i class="fas fa-shipping-fast me-1"></i>Pesanan sedang dikirim</small>
                                </div>
                                <p class="small text-muted mb-0">Perkiraan tiba pada tanggal 28 - 30 September 2025.</p>
                            @elseif($order->status == 'delivered')
                                <div class="alert alert-success py-2 mb-2">
                                    <small><i class="fas fa-check-circle me-1"></i>Pesanan telah diterima</small>
                                </div>
                            @elseif($order->status == 'completed')
                                <div class="alert alert-secondary py-2 mb-2">
                                    <small><i class="fas fa-flag-checkered me-1"></i>Pesanan selesai</small>
                                </div>
                            @elseif($order->status == 'cancelled')
                                <div class="alert alert-danger py-2 mb-2">
                                    <small><i class="fas fa-times-circle me-1"></i>Pesanan dibatalkan</small>
                                </div>
                                @if($order->cancel_reason)
                                <p class="small text-muted mb-0">Alasan: {{ $order->cancel_reason }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <!-- Actions based on status -->
                            @if($order->status == 'unpaid')
                                <button class="btn btn-sm btn-outline-primary" onclick="showPaymentDetail({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <div>
                                    <button class="btn btn-sm btn-success me-1" onclick="showPaymentModal({{ $order->id }}, '{{ $order->product_name }}')">
                                        <i class="fas fa-check me-1"></i>Konfirmasi
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="showCancelModal({{ $order->id }}, '{{ $order->product_name }}')">
                                        <i class="fas fa-times me-1"></i>Batalkan
                                    </button>
                                </div>
                            @elseif($order->status == 'processing')
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="contactBuyer({{ $order->id }}, '{{ $order->customer_name }}')">
                                    <i class="fas fa-comment me-1"></i>Hubungi
                                </button>
                            @elseif($order->status == 'shipped')
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <div>
                                    <button class="btn btn-sm btn-outline-warning me-1" onclick="showTrackModal({{ $order->id }}, '{{ $order->product_name }}')">
                                        <i class="fas fa-map-marker-alt me-1"></i>Lacak
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" onclick="contactBuyer({{ $order->id }}, '{{ $order->customer_name }}')">
                                        <i class="fas fa-comment me-1"></i>Hubungi
                                    </button>
                                </div>
                            @elseif($order->status == 'delivered')
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="contactBuyer({{ $order->id }}, '{{ $order->customer_name }}')">
                                    <i class="fas fa-comment me-1"></i>Hubungi
                                    </button>
                            @elseif($order->status == 'completed')
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <div>
                                    <button class="btn btn-sm btn-outline-success me-1" onclick="showReview({{ $order->id }})">
                                        <i class="fas fa-star me-1"></i>Ulasan
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" onclick="contactBuyer({{ $order->id }}, '{{ $order->customer_name }}')">
                                        <i class="fas fa-comment me-1"></i>Hubungi
                                    </button>
                                </div>
                            @elseif($order->status == 'cancelled')
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="contactBuyer({{ $order->id }}, '{{ $order->customer_name }}')">
                                    <i class="fas fa-comment me-1"></i>Hubungi
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada pesanan</h5>
                    <p class="text-muted">Tidak ada pesanan dengan status "{{ $currentFilter ?? 'yang dipilih' }}".</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination - Only show if there are multiple pages -->
        @if($orders->hasPages() && $orders->total() > 0)
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Previous Page Link --}}
                @if($orders->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    @if($page == $orders->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($orders->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
        @endif
    </div>
</div>

<!-- Modal untuk Detail Pembayaran -->
<div class="modal fade" id="paymentDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="payment-detail">
                    <div class="mb-3">
                        <h6>Payment ID: <span id="paymentId" class="text-primary">#ACG2344</span></h6>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>SLINGBAG</span>
                            <span>Rp 150.000</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="fw-bold">Total Pembayaran</span>
                            <span class="fw-bold">Rp 160.000</span>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        <small>
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Segera lakukan pembayaran dalam 1x24 jam, atau pesanan Anda akan otomatis dibatalkan.
                        </small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Konfirmasi Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Konfirmasi pembayaran untuk pesanan <strong id="paymentProductName"></strong>.</p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Pastikan pembayaran telah diterima sebelum mengkonfirmasi.
                </div>
                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Metode Pembayaran:</label>
                    <select class="form-select" id="paymentMethod">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="e-wallet">E-Wallet</option>
                        <option value="cod">COD (Cash on Delivery)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="paymentNotes" class="form-label">Catatan Pembayaran (Opsional):</label>
                    <textarea class="form-control" id="paymentNotes" rows="3" placeholder="Masukkan catatan pembayaran..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="confirmPayment">Konfirmasi Pembayaran</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Batalkan Pesanan -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Batalkan Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin membatalkan pesanan untuk produk <strong id="cancelProductName"></strong>?</p>
                <p>Status pesanan akan berubah menjadi "Dibatalkan" dan pelanggan akan mendapatkan notifikasi.</p>
                <div class="mb-3">
                    <label for="cancelReason" class="form-label">Alasan Pembatalan:</label>
                    <select class="form-select" id="cancelReason">
                        <option value="">Pilih Alasan Pembatalan</option>
                        <option value="out_of_stock">Stok Habis</option>
                        <option value="customer_request">Permintaan Pelanggan</option>
                        <option value="payment_failed">Pembayaran Gagal</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cancelNotes" class="form-label">Catatan Pembatalan (Opsional):</label>
                    <textarea class="form-control" id="cancelNotes" rows="3" placeholder="Masukkan catatan pembatalan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">Ya, Batalkan Pesanan</button>
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

<!-- Modal untuk Ulasan -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ulasan Pembeli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <div class="rating-display mb-2">
                        <span class="h4 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="ms-2 h5">4.5/5</span>
                    </div>
                    <p class="text-muted">Ulasan untuk produk <strong id="reviewProductName"></strong></p>
                </div>
                <div class="review-content">
                    <p>"Produknya bagus sekali, kualitasnya sesuai dengan harga. Pengirimannya juga cepat. Terima kasih!"</p>
                    <p class="text-muted small">- Pembeli, 25 September 2025</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Hubungi Pembeli -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hubungi Pembeli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Hubungi pembeli <strong id="contactCustomerName"></strong>:</p>
                <div class="contact-options">
                    <div class="mb-3">
                        <button class="btn btn-outline-primary w-100 mb-2" onclick="sendMessage()">
                            <i class="fas fa-comment me-2"></i>Kirim Pesan
                        </button>
                        <button class="btn btn-outline-success w-100" onclick="makeCall()">
                            <i class="fas fa-phone me-2"></i>Telepon Pembeli
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentOrderId = null;
    let currentCustomerName = null;

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
        const orders = document.querySelectorAll('.order-card');
        orders.forEach(order => {
            if (status === 'all' || order.dataset.status === status) {
                order.style.display = 'block';
            } else {
                order.style.display = 'none';
            }
        });
    }

    // Fungsi untuk menangani aksi pada pesanan keluar
    function showOrderDetail(orderId) {
        window.location.href = `/orders/${orderId}`;
    }

    function showPaymentDetail(orderId) {
        currentOrderId = orderId;
        const modal = new bootstrap.Modal(document.getElementById('paymentDetailModal'));
        modal.show();
    }

    function showReview(orderId) {
        currentOrderId = orderId;
        // In a real app, you would fetch the product name and review data
        document.getElementById('reviewProductName').textContent = 'Produk #' + orderId;
        const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
        modal.show();
    }

    function contactBuyer(orderId, customerName) {
        currentOrderId = orderId;
        currentCustomerName = customerName;
        document.getElementById('contactCustomerName').textContent = customerName;
        const modal = new bootstrap.Modal(document.getElementById('contactModal'));
        modal.show();
    }

    function sendMessage() {
        alert('Mengirim pesan ke ' + currentCustomerName);
        bootstrap.Modal.getInstance(document.getElementById('contactModal')).hide();
    }

    function makeCall() {
        alert('Memanggil ' + currentCustomerName);
        bootstrap.Modal.getInstance(document.getElementById('contactModal')).hide();
    }

    // Modal functions untuk pesanan keluar
    function showPaymentModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('paymentProductName').textContent = productName;
        document.getElementById('paymentMethod').value = '';
        document.getElementById('paymentNotes').value = '';
        const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
        modal.show();
    }

    function showCancelModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('cancelProductName').textContent = productName;
        document.getElementById('cancelReason').value = '';
        document.getElementById('cancelNotes').value = '';
        const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
        modal.show();
    }

    function showTrackModal(orderId, productName) {
        currentOrderId = orderId;
        document.getElementById('trackProductName').textContent = productName;
        loadOutgoingTrackingInfo(orderId);
        const modal = new bootstrap.Modal(document.getElementById('trackModal'));
        modal.show();
    }

    // Confirm actions
    document.getElementById('confirmPayment').addEventListener('click', function() {
        const method = document.getElementById('paymentMethod').value;
        const notes = document.getElementById('paymentNotes').value;

        if (!method) {
            showAlert('error', 'Pilih metode pembayaran terlebih dahulu');
            return;
        }

        confirmPayment(currentOrderId, method, notes);
        bootstrap.Modal.getInstance(document.getElementById('paymentModal')).hide();
    });

    document.getElementById('confirmCancel').addEventListener('click', function() {
        const reason = document.getElementById('cancelReason').value;
        const notes = document.getElementById('cancelNotes').value;

        if (!reason) {
            showAlert('error', 'Pilih alasan pembatalan terlebih dahulu');
            return;
        }

        cancelOrder(currentOrderId, reason, notes);
        bootstrap.Modal.getInstance(document.getElementById('cancelModal')).hide();
    });

    // AJAX functions untuk pesanan keluar
    function confirmPayment(orderId, method, notes) {
        fetch(`/orders/${orderId}/confirm-payment`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                method: method,
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
            showAlert('error', 'Terjadi kesalahan saat mengkonfirmasi pembayaran');
        });
    }

    function cancelOrder(orderId, reason, notes) {
        fetch(`/orders/${orderId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                reason: reason,
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
            showAlert('error', 'Terjadi kesalahan saat membatalkan pesanan');
        });
    }

    function loadOutgoingTrackingInfo(orderId) {
        // Simulasi data tracking untuk pesanan keluar
        const trackingData = {
            courier: 'JNE',
            tracking_number: 'RESI123456789',
            estimate: '28 - 30 September 2025',
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
    /* Order Card Styles */
    .order-item-card {
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .order-item-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .order-item-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
    }

    .order-id {
        font-weight: 600;
        color: #495057;
    }

    .order-date {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .product-image {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .payment-info {
        border-top: 1px dashed #e0e0e0;
        border-bottom: 1px dashed #e0e0e0;
        padding: 0.75rem 0;
    }

    .status-info .alert {
        margin-bottom: 0.5rem;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
    }

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

    /* Rating Styles */
    .rating-display .fa-star {
        color: #ffc107;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-options .btn {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .stat-card .stat-number {
            font-size: 1.2rem;
        }

        .stat-card .stat-title {
            font-size: 0.8rem;
        }

        .order-item-card .card-footer .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>
@endsection
