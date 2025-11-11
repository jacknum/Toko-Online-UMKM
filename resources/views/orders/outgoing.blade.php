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
                <button type="button" class="btn btn-primary" id="exportReportBtn">
                    <i class="fas fa-download me-2"></i>Export Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom shadow" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-clock text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['unpaid'] ?? 0 }}</div>
                <div class="stat-title">Belum Bayar</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom shadow" style="background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-tasks text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['processing'] }}</div>
                <div class="stat-title">Sedang Diproses</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom shadow" style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-shipping-fast text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['shipped'] }}</div>
                <div class="stat-title">Dalam Pengiriman</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom shadow" style="background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['delivered'] }}</div>
                <div class="stat-title">Berhasil Dikirim</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom shadow" style="background: linear-gradient(135deg, #858796 0%, #6c757d 100%);">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-archive text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['completed'] ?? 0 }}</div>
                <div class="stat-title">Selesai</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
        <div class="card card-custom shadow" style="background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-times-circle text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['cancelled'] ?? 0 }}</div>
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
                <h5 class="card-title mb-0 fw-bold text-primary">Daftar Pesanan Keluar</h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body py-3 px-4">
                        <ul class="nav nav-pills nav-fill" id="orderFilterTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'all', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter', 'all') == 'all' ? 'active' : '' }}"
                                   data-filter="all">
                                    Semua
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'unpaid', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter') == 'unpaid' ? 'active' : '' }}"
                                   data-filter="unpaid">
                                    Belum Bayar
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'processing', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter') == 'processing' ? 'active' : '' }}"
                                   data-filter="processing">
                                    Diproses
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'shipped', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter') == 'shipped' ? 'active' : '' }}"
                                   data-filter="shipped">
                                    Dikirim
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'delivered', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter') == 'delivered' ? 'active' : '' }}"
                                   data-filter="delivered">
                                    Terkirim
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'completed', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter') == 'completed' ? 'active' : '' }}"
                                   data-filter="completed">
                                    Selesai
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'cancelled', 'page' => 1]) }}"
                                   class="nav-link {{ request('filter') == 'cancelled' ? 'active' : '' }}"
                                   data-filter="cancelled">
                                    Dibatalkan
                                </a>
                            </li>
                        </ul>
                    </div>
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

                                <!-- Bukti Foto Terkirim -->
                                <div class="delivery-proof mt-3">
                                    <p class="small fw-bold mb-2">📸 Bukti Pengiriman:</p>
                                    <div class="proof-images">
                                        <!-- Foto bukti pengiriman sesuai produk -->
                                        @if(str_contains(strtolower($order->product_name), 'jam') && str_contains(strtolower($order->product_name), 'tangan'))
                                            <!-- Foto khusus untuk Jam Tangan -->
                                            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=200&h=200&fit=crop&crop=center"
                                                alt="Bukti Pengiriman Jam Tangan" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1511385348-a52b4a160dc2?w=600&h=400&fit=crop', 'Bukti Pengiriman {{ $order->product_name }}')">
                                        @elseif(str_contains(strtolower($order->product_name), 'dompet') && str_contains(strtolower($order->product_name), 'kulit'))
                                            <!-- Foto khusus untuk Dompet Kulit -->
                                            <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=200&h=200&fit=crop&crop=center"
                                                alt="Bukti Pengiriman Dompet" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400&h=400&fit=crop', 'Bukti Pengiriman {{ $order->product_name }}')">
                                        @elseif(str_contains(strtolower($order->product_name), 'tas') && str_contains(strtolower($order->product_name), 'laptop'))
                                            <!-- Foto khusus untuk Tas Laptop -->
                                            <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=200&h=200&fit=crop&crop=center"
                                                alt="Bukti Pengiriman Tas Laptop" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&h=400&fit=crop', 'Bukti Pengiriman {{ $order->product_name }}')">
                                        @elseif(str_contains(strtolower($order->product_name), 'topi') || str_contains(strtolower($order->product_name), 'baseball'))
                                            <!-- Foto khusus untuk Topi Baseball -->
                                            <img src="https://images.unsplash.com/photo-1575428652377-a2d80e2277fc?w=200&h=200&fit=crop&crop=center"
                                                alt="Bukti Pengiriman Topi" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1575428652377-a2d80e2277fc?w=600&h=400&fit=crop', 'Bukti Pengiriman {{ $order->product_name }}')">
                                        @else
                                            <!-- Default foto untuk produk lainnya -->
                                            <img src="https://images.unsplash.com/photo-1565689228866-1d7db786d2c1?w=200&h=200&fit=crop&crop=center"
                                                alt="Bukti Pengiriman" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1565689228866-1d7db786d2c1?w=600&h=400&fit=crop', 'Bukti Pengiriman {{ $order->product_name }}')">
                                        @endif
                                    </div>
                                    <small class="text-muted">Klik foto untuk melihat detail</small>
                                </div>
                            @elseif($order->status == 'completed')
                                <div class="alert alert-secondary py-2 mb-2">
                                    <small><i class="fas fa-flag-checkered me-1"></i>Pesanan selesai</small>
                                </div>

                                <!-- Bukti Foto Diterima Pembeli -->
                                <div class="completion-proof mt-3">
                                    <p class="small fw-bold mb-2">📦 Bukti Diterima Pembeli:</p>
                                    <div class="proof-images">
                                        <!-- Foto bukti diterima sesuai produk -->
                                        @if(str_contains(strtolower($order->product_name), 'tas') || str_contains(strtolower($order->product_name), 'laptop'))
                                            <!-- Foto khusus untuk Tas Laptop -->
                                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop&crop=center"
                                                alt="Tas Laptop Diterima" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop', '{{ $order->product_name }} Diterima')">
                                        @elseif(str_contains(strtolower($order->product_name), 'sepatu') || str_contains(strtolower($order->product_name), 'formal'))
                                            <!-- Foto khusus untuk Sepatu Formal -->
                                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=200&h=200&fit=crop&crop=center"
                                                alt="Sepatu Formal Diterima" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&h=400&fit=crop', '{{ $order->product_name }} Diterima')">
                                        @elseif(str_contains(strtolower($order->product_name), 'jam') || str_contains(strtolower($order->product_name), 'tangan'))
                                            <!-- Foto khusus untuk Jam Tangan -->
                                            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=200&h=200&fit=crop&crop=center"
                                                alt="Jam Tangan Diterima" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=200&h=200&fit=crop', '{{ $order->product_name }} Diterima')">
                                        @else
                                            <!-- Default foto untuk produk lainnya -->
                                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=200&h=200&fit=crop&crop=center"
                                                alt="Produk Diterima" class="proof-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                onclick="showImageModal('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop', '{{ $order->product_name }} Diterima')">
                                        @endif
                                    </div>
                                    <small class="text-muted">Klik foto untuk melihat detail</small>
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
                                <button class="btn btn-sm btn-outline-primary" onclick="showOrderDetail({{ $order->id }})">
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

<!-- Modal untuk Export Laporan Pesanan Keluar -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-export me-2"></i>Export Laporan Pesanan Keluar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                <h6 class="fw-bold">PDF Report</h6>
                                <p class="text-muted small">Laporan dengan format PDF, cocok untuk dicetak</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-file-excel fa-3x text-success mb-3"></i>
                                <h6 class="fw-bold">Excel Report</h6>
                                <p class="text-muted small">Laporan dengan format Excel, mudah untuk dianalisa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="exportForm" class="mt-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exportFormat" class="form-label fw-bold">
                                <i class="fas fa-format me-2 text-primary"></i>Format Laporan
                            </label>
                            <select class="form-select form-select-lg" id="exportFormat" required>
                                <option value="pdf">PDF Document</option>
                                <option value="excel">Excel Spreadsheet</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="orderStatus" class="form-label fw-bold">
                                <i class="fas fa-filter me-2 text-primary"></i>Status Pesanan
                            </label>
                            <select class="form-select form-select-lg" id="orderStatus">
                                <option value="all">Semua Status</option>
                                <option value="unpaid">Belum Bayar</option>
                                <option value="processing">Sedang Diproses</option>
                                <option value="shipped">Dalam Pengiriman</option>
                                <option value="delivered">Berhasil Dikirim</option>
                                <option value="completed">Selesai</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>Pilih Periode Laporan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="reportMonth" class="form-label fw-bold">Bulan</label>
                                    <select class="form-select" id="reportMonth" required>
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="reportYear" class="form-label fw-bold">Tahun</label>
                                    <select class="form-select" id="reportYear" required>
                                        <option value="">Pilih Tahun</option>
                                        <!-- Options akan diisi oleh JavaScript -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="currentPeriod" checked>
                                <label class="form-check-label text-muted" for="currentPeriod">
                                    Gunakan bulan dan tahun saat ini
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong> Laporan akan menampilkan semua pesanan keluar berdasarkan periode dan status yang dipilih.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" id="confirmExport">
                    <i class="fas fa-download me-2"></i>Export Laporan
                </button>
            </div>
        </div>
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
                    <label class="form-label">Metode Pembayaran:</label>
                    <div class="alert alert-light border mt-2" id="paymentMethodDisplay">
                        <!-- Metode pembayaran akan ditampilkan di sini -->
                    </div>
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

<!-- Modal untuk Lihat Foto Bukti -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Bukti Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Bukti Foto" class="img-fluid" style="max-height: 70vh; object-fit: contain;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Detail Pesanan -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="orderDetailContent">
                    <!-- Content akan diisi oleh JavaScript -->
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat detail pesanan...</p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    let currentOrderId = null;
    let currentCustomerName = null;

    // Data dummy untuk laporan pesanan keluar - DIPERBAIKI: tambah lebih banyak data dengan format tanggal yang konsisten
    const dummyOutgoingOrders = [
        {
            order_number: "ORD001",
            product_name: "Laptop ASUS ROG Strix G15",
            customer_name: "Budi Santoso",
            quantity: 1,
            price: 18500000,
            total_price: 18500000,
            status: "unpaid",
            created_at: "15 Nov 2024"
        },
        {
            order_number: "ORD002",
            product_name: "Smartphone Samsung Galaxy S23",
            customer_name: "Sari Indah",
            quantity: 2,
            price: 12500000,
            total_price: 25000000,
            status: "processing",
            created_at: "14 Nov 2024"
        },
        {
            order_number: "ORD003",
            product_name: "Tablet iPad Pro 12.9",
            customer_name: "Ahmad Wijaya",
            quantity: 1,
            price: 21500000,
            total_price: 21500000,
            status: "shipped",
            created_at: "13 Nov 2024"
        },
        {
            order_number: "ORD004",
            product_name: "Monitor LG UltraGear 27\"",
            customer_name: "Dewi Kartika",
            quantity: 3,
            price: 4500000,
            total_price: 13500000,
            status: "delivered",
            created_at: "12 Nov 2024"
        },
        {
            order_number: "ORD005",
            product_name: "Keyboard Mechanical RGB",
            customer_name: "Rizky Pratama",
            quantity: 2,
            price: 850000,
            total_price: 1700000,
            status: "completed",
            created_at: "11 Nov 2024"
        },
        {
            order_number: "ORD006",
            product_name: "Mouse Gaming Wireless",
            customer_name: "Fitri Handayani",
            quantity: 1,
            price: 650000,
            total_price: 650000,
            status: "cancelled",
            created_at: "10 Nov 2024"
        },
        {
            order_number: "ORD007",
            product_name: "Headphone Sony WH-1000XM4",
            customer_name: "Hendra Kurniawan",
            quantity: 1,
            price: 3850000,
            total_price: 3850000,
            status: "processing",
            created_at: "09 Nov 2024"
        },
        {
            order_number: "ORD008",
            product_name: "Webcam Logitech C920",
            customer_name: "Maya Sari",
            quantity: 2,
            price: 950000,
            total_price: 1900000,
            status: "shipped",
            created_at: "08 Nov 2024"
        },
        {
            order_number: "ORD009",
            product_name: "External SSD 1TB",
            customer_name: "Tono Sutrisno",
            quantity: 1,
            price: 1850000,
            total_price: 1850000,
            status: "delivered",
            created_at: "07 Nov 2024"
        },
        {
            order_number: "ORD010",
            product_name: "Printer Epson L3210",
            customer_name: "Linda Permata",
            quantity: 1,
            price: 2450000,
            total_price: 2450000,
            status: "completed",
            created_at: "06 Nov 2024"
        },
        {
            order_number: "ORD011",
            product_name: "Smart TV LG 55\" 4K",
            customer_name: "Joko Widodo",
            quantity: 1,
            price: 8500000,
            total_price: 8500000,
            status: "unpaid",
            created_at: "05 Nov 2024"
        },
        {
            order_number: "ORD012",
            product_name: "Air Conditioner Sharp 1/2 PK",
            customer_name: "Ani Susanti",
            quantity: 2,
            price: 3500000,
            total_price: 7000000,
            status: "processing",
            created_at: "04 Nov 2024"
        },
        {
            order_number: "ORD013",
            product_name: "Microwave Panasonic",
            customer_name: "Bambang Pamungkas",
            quantity: 1,
            price: 1200000,
            total_price: 1200000,
            status: "shipped",
            created_at: "03 Nov 2024"
        },
        {
            order_number: "ORD014",
            product_name: "Blender Philips",
            customer_name: "Citra Lestari",
            quantity: 1,
            price: 650000,
            total_price: 650000,
            status: "delivered",
            created_at: "02 Nov 2024"
        },
        {
            order_number: "ORD015",
            product_name: "Rice Cooker Miyako",
            customer_name: "Dedi Kusnadi",
            quantity: 1,
            price: 450000,
            total_price: 450000,
            status: "completed",
            created_at: "01 Nov 2024"
        },
        {
            order_number: "ORD016",
            product_name: "Kulkas 2 Pintu Samsung",
            customer_name: "Eka Putri",
            quantity: 1,
            price: 6500000,
            total_price: 6500000,
            status: "cancelled",
            created_at: "31 Oct 2024"
        },
        {
            order_number: "ORD017",
            product_name: "Mesin Cuci LG Front Loading",
            customer_name: "Fajar Nugroho",
            quantity: 1,
            price: 4200000,
            total_price: 4200000,
            status: "unpaid",
            created_at: "30 Oct 2024"
        },
        {
            order_number: "ORD018",
            product_name: "Kipas Angin Cosmos",
            customer_name: "Gita Maharani",
            quantity: 3,
            price: 350000,
            total_price: 1050000,
            status: "processing",
            created_at: "29 Oct 2024"
        },
        {
            order_number: "ORD019",
            product_name: "Setrika Philips",
            customer_name: "Hadi Pranoto",
            quantity: 1,
            price: 280000,
            total_price: 280000,
            status: "shipped",
            created_at: "28 Oct 2024"
        },
        {
            order_number: "ORD020",
            product_name: "Vacuum Cleaner Sharp",
            customer_name: "Indah Permata",
            quantity: 1,
            price: 850000,
            total_price: 850000,
            status: "delivered",
            created_at: "27 Oct 2024"
        }
    ];

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk tombol export laporan
        document.getElementById('exportReportBtn').addEventListener('click', function() {
            initializeExportModal();
            const modal = new bootstrap.Modal(document.getElementById('exportModal'));
            modal.show();
        });

        // Event listener untuk konfirmasi export
        document.getElementById('confirmExport').addEventListener('click', function() {
            exportReport();
        });

        // Event listener untuk checkbox periode saat ini
        document.getElementById('currentPeriod').addEventListener('change', function() {
            if (this.checked) {
                setCurrentPeriod();
            }
        });

        // Set periode saat ini saat modal pertama kali dibuka
        setCurrentPeriod();
    });

    // Inisialisasi modal export
    function initializeExportModal() {
        // Generate tahun dari 2020 sampai tahun sekarang + 1
        const yearSelect = document.getElementById('reportYear');
        const currentYear = new Date().getFullYear();

        yearSelect.innerHTML = '<option value="">Pilih Tahun</option>';
        for (let year = 2020; year <= currentYear + 1; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }

        // Set bulan dan tahun saat ini
        setCurrentPeriod();
    }

    // Set periode saat ini
    function setCurrentPeriod() {
        const now = new Date();
        document.getElementById('reportMonth').value = now.getMonth() + 1;
        document.getElementById('reportYear').value = now.getFullYear();
    }

    // Fungsi untuk export laporan
    function exportReport() {
        const format = document.getElementById('exportFormat').value;
        const orderStatus = document.getElementById('orderStatus').value;
        const month = document.getElementById('reportMonth').value;
        const year = document.getElementById('reportYear').value;

        // Validasi input
        if (!month || !year) {
            showAlert('error', 'Harap pilih bulan dan tahun untuk periode laporan');
            return;
        }

        // Tampilkan loading
        showAlert('info', 'Mempersiapkan laporan...');

        // Tutup modal
        bootstrap.Modal.getInstance(document.getElementById('exportModal')).hide();

        // Generate laporan berdasarkan format
        if (format === 'pdf') {
            generatePDFReport(month, year, orderStatus);
        } else {
            generateExcelReport(month, year, orderStatus);
        }
    }

    // Fungsi untuk generate PDF report untuk pesanan keluar
    function generatePDFReport(month, year, orderStatus) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Data untuk header perusahaan
        const companyData = {
            name: "PT. MAKMUR SEJAHTERA",
            address: "Jl. Industri No. 123, Kawasan Industri Modern, Jakarta 12940",
            phone: "Telp: (021) 5567-8901 | Fax: (021) 5567-8902",
            email: "Email: info@makmursejahtera.co.id | Website: www.makmursejahtera.co.id"
        };

        // Data untuk laporan
        const reportData = getReportData(month, year, orderStatus);
        const reportTitle = "LAPORAN PESANAN KELUAR";
        const reportPeriod = getReportPeriod(month, year);

        // Header dengan kop surat
        doc.setFontSize(16);
        doc.setFont(undefined, 'bold');
        doc.text(companyData.name, 105, 20, { align: 'center' });

        doc.setFontSize(9);
        doc.setFont(undefined, 'normal');
        doc.text(companyData.address, 105, 27, { align: 'center' });
        doc.text(companyData.phone, 105, 32, { align: 'center' });
        doc.text(companyData.email, 105, 37, { align: 'center' });

        // Garis pemisah
        doc.setLineWidth(0.5);
        doc.line(20, 42, 190, 42);

        // Judul laporan
        doc.setFontSize(14);
        doc.setFont(undefined, 'bold');
        doc.text(reportTitle, 105, 50, { align: 'center' });

        // Periode laporan
        doc.setFontSize(10);
        doc.setFont(undefined, 'normal');
        doc.text(`Periode Laporan: ${reportPeriod}`, 20, 60);
        doc.text(`Status Pesanan: ${getStatusText(orderStatus)}`, 20, 65);
        doc.text(`Total Pesanan: ${reportData.length} item`, 20, 70);
        doc.text(`Tanggal Cetak: ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}`, 20, 75);

        // Tabel data pesanan
        if (reportData.length === 0) {
            doc.setFontSize(12);
            doc.text("Tidak ada data pesanan keluar untuk periode yang dipilih", 20, 90);
        } else {
            const tableColumns = [
                { header: 'No', dataKey: 'no' },
                { header: 'No. Pesanan', dataKey: 'order_number' },
                { header: 'Tanggal', dataKey: 'date' },
                { header: 'Produk', dataKey: 'product' },
                { header: 'Customer', dataKey: 'customer' },
                { header: 'Qty', dataKey: 'quantity' },
                { header: 'Harga', dataKey: 'price' },
                { header: 'Total', dataKey: 'total' },
                { header: 'Status', dataKey: 'status' }
            ];

            const tableRows = reportData.map((order, index) => ({
                no: index + 1,
                order_number: order.order_number,
                date: order.created_at,
                product: order.product_name,
                customer: order.customer_name,
                quantity: order.quantity,
                price: `Rp ${formatNumber(order.price)}`,
                total: `Rp ${formatNumber(order.total_price)}`,
                status: getStatusText(order.status)
            }));

            // Hitung total
            const totalQty = reportData.reduce((sum, order) => sum + order.quantity, 0);
            const totalValue = reportData.reduce((sum, order) => sum + order.total_price, 0);

            doc.autoTable({
                columns: tableColumns,
                body: tableRows,
                startY: 80,
                styles: { fontSize: 8 },
                headStyles: { fillColor: [41, 128, 185] },
                foot: [
                    [
                        { content: 'TOTAL:', colSpan: 5, styles: { fontStyle: 'bold', halign: 'right' } },
                        { content: totalQty.toString(), styles: { fontStyle: 'bold' } },
                        { content: '', styles: { fontStyle: 'bold' } },
                        { content: `Rp ${formatNumber(totalValue)}`, colSpan: 2, styles: { fontStyle: 'bold' } }
                    ]
                ],
                footStyles: { fillColor: [240, 240, 240] }
            });
        }

        // Footer
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(8);
            doc.text(`Halaman ${i} dari ${pageCount}`, 105, doc.internal.pageSize.height - 10, { align: 'center' });
        }

        // Simpan PDF
        const fileName = `Laporan_Pesanan_Keluar_${month}_${year}.pdf`;
        doc.save(fileName);

        showAlert('success', 'Laporan PDF berhasil diunduh');
    }

    // Fungsi untuk generate Excel report untuk pesanan keluar
    function generateExcelReport(month, year, orderStatus) {
        const reportData = getReportData(month, year, orderStatus);

        // Data untuk header
        const headerData = [
            ['PT. MAKMUR SEJAHTERA'],
            ['Jl. Industri No. 123, Kawasan Industri Modern, Jakarta 12940'],
            ['Telp: (021) 5567-8901 | Fax: (021) 5567-8902'],
            ['Email: info@makmursejahtera.co.id | Website: www.makmursejahtera.co.id'],
            [],
            ['LAPORAN PESANAN KELUAR'],
            [`Periode Laporan: ${getReportPeriod(month, year)}`],
            [`Status Pesanan: ${getStatusText(orderStatus)}`],
            [`Total Pesanan: ${reportData.length} item`],
            [`Tanggal Cetak: ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}`],
            []
        ];

        // Header tabel
        const tableHeader = ['No', 'No. Pesanan', 'Tanggal', 'Produk', 'Customer', 'Qty', 'Harga', 'Total', 'Status'];

        // Data tabel
        let tableData = [];
        if (reportData.length === 0) {
            tableData.push(['Tidak ada data pesanan keluar untuk periode yang dipilih']);
        } else {
            tableData = reportData.map((order, index) => [
                index + 1,
                order.order_number,
                order.created_at,
                order.product_name,
                order.customer_name,
                order.quantity,
                `Rp ${formatNumber(order.price)}`,
                `Rp ${formatNumber(order.total_price)}`,
                getStatusText(order.status)
            ]);

            // Hitung total
            const totalQty = reportData.reduce((sum, order) => sum + order.quantity, 0);
            const totalValue = reportData.reduce((sum, order) => sum + order.total_price, 0);

            tableData.push([]);
            tableData.push(['', '', '', '', 'TOTAL:', totalQty, '', `Rp ${formatNumber(totalValue)}`, '']);
        }

        // Gabungkan semua data
        const excelData = [...headerData, tableHeader, ...tableData];

        // Buat workbook
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(excelData);

        // Merge cells untuk header
        const merges = [
            { s: { r: 0, c: 0 }, e: { r: 0, c: 8 } },
            { s: { r: 1, c: 0 }, e: { r: 1, c: 8 } },
            { s: { r: 2, c: 0 }, e: { r: 2, c: 8 } },
            { s: { r: 3, c: 0 }, e: { r: 3, c: 8 } },
            { s: { r: 5, c: 0 }, e: { r: 5, c: 8 } },
            { s: { r: 6, c: 0 }, e: { r: 6, c: 8 } },
            { s: { r: 7, c: 0 }, e: { r: 7, c: 8 } },
            { s: { r: 8, c: 0 }, e: { r: 8, c: 8 } },
            { s: { r: 9, c: 0 }, e: { r: 9, c: 8 } }
        ];
        ws['!merges'] = merges;

        // Atur lebar kolom
        ws['!cols'] = [
            { wch: 5 },   // No
            { wch: 12 },  // No. Pesanan
            { wch: 12 },  // Tanggal
            { wch: 25 },  // Produk
            { wch: 20 },  // Customer
            { wch: 8 },   // Qty
            { wch: 15 },  // Harga
            { wch: 15 },  // Total
            { wch: 15 }   // Status
        ];

        XLSX.utils.book_append_sheet(wb, ws, 'Laporan Pesanan Keluar');

        // Simpan file
        const fileName = `Laporan_Pesanan_Keluar_${month}_${year}.xlsx`;
        XLSX.writeFile(wb, fileName);

        showAlert('success', 'Laporan Excel berhasil diunduh');
    }

    // Helper functions untuk pesanan keluar
    function getReportData(month, year, orderStatus) {
        // Gunakan data dummy untuk prototype
        let filteredData = dummyOutgoingOrders.filter(order => {
            // Filter berdasarkan status
            if (orderStatus !== 'all' && order.status !== orderStatus) {
                return false;
            }

            // Filter berdasarkan bulan dan tahun
            return isDateInPeriod(order.created_at, month, year);
        });

        return filteredData;
    }

    function isDateInPeriod(dateString, month, year) {
        try {
            // Konversi date string "15 Nov 2024" ke Date object
            const months = {
                'Jan': 0, 'Feb': 1, 'Mar': 2, 'Apr': 3, 'May': 4, 'Jun': 5,
                'Jul': 6, 'Aug': 7, 'Sep': 8, 'Oct': 9, 'Nov': 10, 'Dec': 11
            };

            const parts = dateString.split(' ');
            if (parts.length < 3) return false;

            const dateMonth = months[parts[1]];
            const dateYear = parseInt(parts[2]);

            return dateMonth === parseInt(month) - 1 && dateYear === parseInt(year);
        } catch (error) {
            console.error('Error parsing date:', error);
            return false;
        }
    }

    function getReportPeriod(month, year) {
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        return `${monthNames[parseInt(month) - 1]} ${year}`;
    }

    function getStatusText(status) {
        const statusMap = {
            'all': 'Semua Status',
            'unpaid': 'Belum Bayar',
            'processing': 'Sedang Diproses',
            'shipped': 'Dalam Pengiriman',
            'delivered': 'Berhasil Dikirim',
            'completed': 'Selesai',
            'cancelled': 'Dibatalkan'
        };
        return statusMap[status] || status;
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk menampilkan modal gambar
    function showImageModal(imageSrc, title) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModalTitle').textContent = title;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }

    // Fungsi untuk menampilkan detail pesanan
    function showOrderDetail(orderId) {
        currentOrderId = orderId;

        // Tampilkan modal loading
        const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
        modal.show();

        // Load detail pesanan
        loadOrderDetail(orderId);
    }

    // Fungsi untuk memuat detail pesanan
    function loadOrderDetail(orderId) {
        // Simulasi data detail pesanan berdasarkan status
        const orderDetails = {
            1: {
                status: 'unpaid',
                title: 'Detail Pesanan - Belum Bayar',
                content: `
                    <div class="order-detail">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Pesanan</h6>
                                <p><strong>ID Pesanan:</strong> #ACG2344</p>
                                <p><strong>Tanggal Pesanan:</strong> 15 Jan 2024 10:30</p>
                                <p><strong>Status:</strong> <span class="badge bg-warning">Belum Bayar</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Pembeli</h6>
                                <p><strong>Nama:</strong> Budi Santoso</p>
                                <p><strong>Email:</strong> budi.santoso@email.com</p>
                                <p><strong>Telepon:</strong> 081234567890</p>
                            </div>
                        </div>

                        <div class="product-detail mb-4">
                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>SLINGBAG</td>
                                            <td>1</td>
                                            <td>Rp 150.000</td>
                                            <td>Rp 150.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
                                            <td>Rp 10.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 160.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="payment-info">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Pembayaran Belum Dikonfirmasi</strong><br>
                                Segera lakukan pembayaran dalam 1x24 jam, atau pesanan akan otomatis dibatalkan.
                            </div>
                        </div>
                    </div>
                `
            },
            4: {
                status: 'processing',
                title: 'Detail Pesanan - Sedang Diproses',
                content: `
                    <div class="order-detail">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Pesanan</h6>
                                <p><strong>ID Pesanan:</strong> #ACG2347</p>
                                <p><strong>Tanggal Pesanan:</strong> 13 Jan 2024 14:20</p>
                                <p><strong>Status:</strong> <span class="badge bg-info">Sedang Diproses</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Pembeli</h6>
                                <p><strong>Nama:</strong> Andi Pratama</p>
                                <p><strong>Email:</strong> andi.pratama@email.com</p>
                                <p><strong>Telepon:</strong> 081234567891</p>
                            </div>
                        </div>

                        <div class="product-detail mb-4">
                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kaos Polos</td>
                                            <td>3</td>
                                            <td>Rp 70.000</td>
                                            <td>Rp 210.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
                                            <td>Rp 15.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 225.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="processing-info">
                            <div class="alert alert-info">
                                <i class="fas fa-box me-2"></i>
                                <strong>Pesanan Sedang Dikemas</strong><br>
                                Pesanan sedang dipersiapkan untuk pengiriman. Perkiraan tiba: 28 - 30 September 2025.
                            </div>
                        </div>
                    </div>
                `
            },
            6: {
                status: 'shipped',
                title: 'Detail Pesanan - Dalam Pengiriman',
                content: `
                    <div class="order-detail">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Pesanan</h6>
                                <p><strong>ID Pesanan:</strong> #ACG2349</p>
                                <p><strong>Tanggal Pesanan:</strong> 11 Jan 2024 16:30</p>
                                <p><strong>Status:</strong> <span class="badge bg-primary">Dalam Pengiriman</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Pembeli</h6>
                                <p><strong>Nama:</strong> Fajar Nugroho</p>
                                <p><strong>Email:</strong> fajar.nugroho@email.com</p>
                                <p><strong>Telepon:</strong> 081234567892</p>
                            </div>
                        </div>

                        <div class="product-detail mb-4">
                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Celana Jeans</td>
                                            <td>2</td>
                                            <td>Rp 190.000</td>
                                            <td>Rp 380.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
                                            <td>Rp 15.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 395.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="shipping-info">
                            <h6>Informasi Pengiriman</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Kurir:</strong> JNE</p>
                                    <p><strong>No. Resi:</strong> RESI001234570</p>
                                    <p><strong>Estimasi:</strong> 28 - 30 September 2025</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Alamat Pengiriman:</strong></p>
                                    <p>Jl. Merdeka No. 123<br>Jakarta Pusat<br>DKI Jakarta 10110</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            8: {
                status: 'delivered',
                title: 'Detail Pesanan - Berhasil Dikirim',
                content: `
                    <div class="order-detail">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Pesanan</h6>
                                <p><strong>ID Pesanan:</strong> #ACG2351</p>
                                <p><strong>Tanggal Pesanan:</strong> 9 Jan 2024 14:15</p>
                                <p><strong>Status:</strong> <span class="badge bg-success">Berhasil Dikirim</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Pembeli</h6>
                                <p><strong>Nama:</strong> Hendra Setiawan</p>
                                <p><strong>Email:</strong> hendra.setiawan@email.com</p>
                                <p><strong>Telepon:</strong> 081234567893</p>
                            </div>
                        </div>

                        <div class="product-detail mb-4">
                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Dompet Kulit</td>
                                            <td>1</td>
                                            <td>Rp 120.000</td>
                                            <td>Rp 120.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
                                            <td>Rp 15.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 135.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="delivery-info">
                            <h6>Informasi Pengiriman</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Kurir:</strong> SiCepat</p>
                                    <p><strong>No. Resi:</strong> RESI001234572</p>
                                    <p><strong>Tanggal Diterima:</strong> 25 Jan 2024</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Alamat Pengiriman:</strong></p>
                                    <p>Jl. Sudirman No. 456<br>Jakarta Selatan<br>DKI Jakarta 12190</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            10: {
                status: 'completed',
                title: 'Detail Pesanan - Selesai',
                content: `
                    <div class="order-detail">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Pesanan</h6>
                                <p><strong>ID Pesanan:</strong> #ACG2353</p>
                                <p><strong>Tanggal Pesanan:</strong> 5 Jan 2024 13:45</p>
                                <p><strong>Status:</strong> <span class="badge bg-secondary">Selesai</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Pembeli</h6>
                                <p><strong>Nama:</strong> Joko Widodo</p>
                                <p><strong>Email:</strong> joko.widodo@email.com</p>
                                <p><strong>Telepon:</strong> 081234567894</p>
                            </div>
                        </div>

                        <div class="product-detail mb-4">
                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tas Laptop</td>
                                            <td>1</td>
                                            <td>Rp 350.000</td>
                                            <td>Rp 350.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
                                            <td>Rp 15.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 365.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="completion-info">
                            <h6>Informasi Penyelesaian</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Tanggal Diterima:</strong> 20 Jan 2024</p>
                                    <p><strong>Rating Pembeli:</strong>
                                        <span class="text-warning">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                        4.5/5
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Ulasan Pembeli:</strong></p>
                                    <div class="alert alert-light">
                                        "Produknya bagus sekali, kualitasnya sesuai dengan harga. Pengirimannya juga cepat. Terima kasih!"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            13: {
                status: 'cancelled',
                title: 'Detail Pesanan - Dibatalkan',
                content: `
                    <div class="order-detail">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Pesanan</h6>
                                <p><strong>ID Pesanan:</strong> #ACG2356</p>
                                <p><strong>Tanggal Pesanan:</strong> 15 Jan 2024 08:30</p>
                                <p><strong>Status:</strong> <span class="badge bg-danger">Dibatalkan</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Pembeli</h6>
                                <p><strong>Nama:</strong> Maya Sari</p>
                                <p><strong>Email:</strong> maya.sari@email.com</p>
                                <p><strong>Telepon:</strong> 081234567895</p>
                            </div>
                        </div>

                        <div class="product-detail mb-4">
                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kacamata Hitam</td>
                                            <td>1</td>
                                            <td>Rp 150.000</td>
                                            <td>Rp 150.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
                                            <td>Rp 15.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 165.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="cancellation-info">
                            <div class="alert alert-danger">
                                <i class="fas fa-times-circle me-2"></i>
                                <strong>Pesanan Dibatalkan</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Alasan Pembatalan:</strong> Pembayaran Gagal</p>
                                    <p><strong>Tanggal Pembatalan:</strong> 16 Jan 2024</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Catatan Pembatalan:</strong></p>
                                    <p>Pembayaran tidak dilakukan dalam waktu 24 jam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            }
        };

        // Default content jika orderId tidak ditemukan
        const defaultContent = {
            title: 'Detail Pesanan',
            content: `
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h5>Detail pesanan tidak ditemukan</h5>
                    <p class="text-muted">Data untuk pesanan ini tidak tersedia.</p>
                </div>
            `
        };

        const detail = orderDetails[orderId] || defaultContent;

        // Update modal content
        document.querySelector('#orderDetailModal .modal-title').textContent = detail.title;
        document.getElementById('orderDetailContent').innerHTML = detail.content;
    }

    // Modal functions untuk pesanan keluar
    function showPaymentModal(orderId, productName, paymentMethod = "Bank BSI") {
        currentOrderId = orderId;
        document.getElementById('paymentProductName').textContent = productName;
        document.getElementById('paymentMethodDisplay').textContent = paymentMethod;
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

    function showReview(orderId) {
        currentOrderId = orderId;
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
            estimate: '28 - 30 November 2024',
            status: 'Paket dalam perjalanan ke alamat penerima',
            timeline: [
                { time: '2024-11-15 14:30', description: 'Paket dalam perjalanan ke kota tujuan', status: 'in_transit' },
                { time: '2024-11-15 12:15', description: 'Paket tiba di hub pengiriman', status: 'arrived' },
                { time: '2024-11-15 10:00', description: 'Paket dipickup oleh kurir', status: 'picked_up' },
                { time: '2024-11-15 08:30', description: 'Paket dikemas dan siap dikirim', status: 'processed' }
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
@endsection
