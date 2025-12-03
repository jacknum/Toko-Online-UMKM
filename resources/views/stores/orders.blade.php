@extends('layouts.store')

@section('title', 'Pesanan Saya - Toko UMKM')

@section('content')
    <div class="container-fluid bg-light py-4 mt-4">
        <div class="container">
            <!-- Header -->
            <div class="row align-items-center mb-4">
                <div class="col">
                    <!-- Breadcrumb dihapus -->
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center text-muted">
                        <i class="fas fa-clipboard-list me-2"></i>
                        <span class="fw-medium">Pesanan Saya</span>
                    </div>
                </div>
            </div>

            <!-- Filter dan Pencarian -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0"
                                            placeholder="Cari pesanan..." id="search-orders">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                        <select class="form-select" style="width: auto;" id="status-filter">
                                            <option value="">Semua Status</option>
                                            <option value="shipped">Dikirim</option>
                                            <option value="delivered">Terkirim</option>
                                            <option value="completed">Selesai</option>
                                        </select>
                                        <select class="form-select" style="width: auto;" id="time-filter">
                                            <option value="">Semua Waktu</option>
                                            <option value="today">Hari Ini</option>
                                            <option value="week">Minggu Ini</option>
                                            <option value="month">Bulan Ini</option>
                                            <option value="3months">3 Bulan Terakhir</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Pesanan -->
            <div class="row">
                <div class="col-12">
                    <!-- Pesanan Sedang Dikirim -->
                    <div class="mb-5">
                        <h4 class="fw-semibold mb-4">Pesanan Sedang Dikirim</h4>

                        <div class="order-list" id="active-orders">
                            @if (count($activeOrders) > 0)
                                @foreach ($activeOrders as $order)
                                    <div class="card shadow-sm border-0 mb-4 order-card"
                                        data-status="{{ $order['status'] }}" data-date="{{ $order['date'] }}"
                                        data-order="{{ $order['order_number'] }}">
                                        <div class="card-header bg-white py-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center">
                                                        <div class="order-status-badge {{ $order['status'] }} me-3">
                                                            <i class="fas fa-truck me-1"></i>
                                                            <span>{{ $order['status_text'] }}</span>
                                                        </div>
                                                        <span class="text-muted small">#{{ $order['order_number'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <span
                                                        class="text-muted small">{{ date('d M Y, H:i', strtotime($order['date'])) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                    <div class="row g-3">
                                                        @foreach ($order['items'] as $item)
                                                            <div class="col-12">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ $item['image'] }}"
                                                                        alt="{{ $item['name'] }}"
                                                                        class="rounded me-3 flex-shrink-0"
                                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                                    <div class="flex-grow-1">
                                                                        <h6 class="fw-semibold mb-1">{{ $item['name'] }}
                                                                        </h6>
                                                                        <p class="text-muted mb-1 small">
                                                                            {{ $item['quantity'] }} x Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}
                                                                        </p>
                                                                        <span
                                                                            class="badge bg-light text-dark small">{{ $item['category'] }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="mt-3">
                                                        <div class="shipping-info">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="fas fa-truck me-2 text-primary"></i>
                                                                <div>
                                                                    <strong>{{ $order['shipping_method'] }} -
                                                                        {{ $order['tracking_number'] }}</strong>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                                                <div>
                                                                    <small class="text-muted">Sedang dalam perjalanan ke
                                                                        alamat tujuan</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <button class="btn btn-outline-secondary btn-sm"
                                                            onclick="viewOrderDetail('{{ $order['order_number'] }}')">
                                                            <i class="fas fa-eye me-1"></i>Lihat Detail Pesanan
                                                        </button>
                                                        <!-- Tombol Bukti Pengiriman dihapus untuk status shipped -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mt-3 mt-lg-0">
                                                    <div class="text-lg-end">
                                                        <div class="mb-2">
                                                            <span class="fw-semibold text-primary">Total: Rp
                                                                {{ number_format($order['total'], 0, ',', '.') }}</span>
                                                        </div>

                                                        @if (isset($order['estimated_delivery']))
                                                            <div class="mb-2">
                                                                <small class="text-muted">
                                                                    Estimasi tiba:
                                                                    {{ date('d M Y', strtotime($order['estimated_delivery'])) }}
                                                                </small>
                                                            </div>
                                                        @endif

                                                        <div class="d-flex flex-column gap-2">
                                                            <button class="btn btn-primary btn-sm"
                                                                onclick="trackOrder('{{ $order['order_number'] }}')">
                                                                <i class="fas fa-map-marked-alt me-1"></i>Lacak Pengiriman
                                                            </button>
                                                            <button class="btn btn-outline-success btn-sm"
                                                                onclick="confirmDelivery('{{ $order['order_number'] }}')">
                                                                <i class="fas fa-check me-1"></i>Konfirmasi Diterima
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Empty State untuk Pesanan Aktif -->
                                <div id="no-active-orders" class="text-center py-5">
                                    <div class="empty-icon mb-4">
                                        <i class="fas fa-clipboard-list fa-4x text-muted opacity-25"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-3">Tidak Ada Pesanan Sedang Dikirim</h5>
                                    <p class="text-muted mb-4">Belum ada pesanan yang sedang dalam pengiriman.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Riwayat Pesanan -->
                    <div class="mb-5">
                        <h4 class="fw-semibold mb-4">Riwayat Pesanan</h4>

                        <div class="order-list" id="order-history">
                            @if (count($orderHistory) > 0)
                                @foreach ($orderHistory as $order)
                                    <div class="card shadow-sm border-0 mb-4 order-card"
                                        data-status="{{ $order['status'] }}" data-date="{{ $order['date'] }}"
                                        data-order="{{ $order['order_number'] }}">
                                        <div class="card-header bg-white py-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center">
                                                        <div class="order-status-badge {{ $order['status'] }} me-3">
                                                            <i
                                                                class="fas
                                                            @if ($order['status'] == 'delivered') fa-truck
                                                            @elseif($order['status'] == 'completed') fa-check-circle @endif
                                                        me-1"></i>
                                                            <span>{{ $order['status_text'] }}</span>
                                                        </div>
                                                        <span
                                                            class="text-muted small">#{{ $order['order_number'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <span
                                                        class="text-muted small">{{ date('d M Y, H:i', strtotime($order['date'])) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                    <div class="row g-3">
                                                        @foreach ($order['items'] as $item)
                                                            <div class="col-12">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ $item['image'] }}"
                                                                        alt="{{ $item['name'] }}"
                                                                        class="rounded me-3 flex-shrink-0"
                                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                                    <div class="flex-grow-1">
                                                                        <h6 class="fw-semibold mb-1">{{ $item['name'] }}
                                                                        </h6>
                                                                        <p class="text-muted mb-1 small">
                                                                            {{ $item['quantity'] }} x Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}
                                                                        </p>
                                                                        <span
                                                                            class="badge bg-light text-dark small">{{ $item['category'] }}</span>

                                                                        <!-- Tampilkan ulasan jika sudah ada -->
                                                                        @if ($order['status'] == 'completed' && isset($order['review']))
                                                                            <div class="mt-2 p-2 bg-light rounded">
                                                                                <div
                                                                                    class="d-flex align-items-center mb-1">
                                                                                    <div class="star-rating me-2">
                                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                                            <i
                                                                                                class="fas fa-star {{ $i <= $order['review']['rating'] ? 'text-warning' : 'text-muted' }}"></i>
                                                                                        @endfor
                                                                                    </div>
                                                                                    <small
                                                                                        class="text-muted">{{ date('d M Y', strtotime($order['review']['created_at'])) }}</small>
                                                                                </div>
                                                                                <p class="mb-0 small">
                                                                                    {{ $order['review']['comment'] }}</p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="mt-3">
                                                        <div class="shipping-info">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i
                                                                    class="fas fa-truck me-2
                                                                @if ($order['status'] == 'delivered') text-warning
                                                                @elseif($order['status'] == 'completed') text-success @endif"></i>
                                                                <div>
                                                                    <strong>{{ $order['shipping_method'] }} -
                                                                        {{ $order['tracking_number'] }}</strong>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i
                                                                    class="fas
                                                                @if ($order['status'] == 'delivered') fa-check-circle text-warning
                                                                @elseif($order['status'] == 'completed') fa-check-circle text-success @endif me-2"></i>
                                                                <div>
                                                                    <small class="text-muted">
                                                                        @if ($order['status'] == 'delivered')
                                                                            Pesanan telah tiba pada
                                                                            {{ date('d M Y, H:i', strtotime($order['delivered_date'])) }}
                                                                        @elseif($order['status'] == 'completed')
                                                                            Pesanan telah diterima pada
                                                                            {{ date('d M Y, H:i', strtotime($order['delivered_date'])) }}
                                                                        @endif
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <button class="btn btn-outline-secondary btn-sm"
                                                            onclick="viewOrderDetail('{{ $order['order_number'] }}')">
                                                            <i class="fas fa-eye me-1"></i>Detail Pesanan
                                                        </button>
                                                        <!-- Tombol Bukti Pengiriman hanya untuk status delivered dan completed -->
                                                        @if ($order['status'] == 'delivered' || $order['status'] == 'completed')
                                                            <button class="btn btn-outline-info btn-sm"
                                                                onclick="viewShippingProof('{{ $order['order_number'] }}')">
                                                                <i class="fas fa-file-invoice me-1"></i>Bukti Pengiriman
                                                            </button>
                                                        @endif

                                                        @if ($order['status'] == 'completed')
                                                            <button class="btn btn-outline-success btn-sm"
                                                                onclick="viewDeliveryProof('{{ $order['order_number'] }}')">
                                                                <i class="fas fa-clipboard-check me-1"></i>Bukti Diterima
                                                            </button>
                                                        @endif

                                                        <!-- Tombol Beri Ulasan untuk pesanan selesai yang belum ada ulasan -->
                                                        @if ($order['status'] == 'completed' && !isset($order['review']))
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="openReviewModal('{{ $order['order_number'] }}', {{ json_encode($order['items']) }})">
                                                                <i class="fas fa-star me-1"></i>Beri Ulasan
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mt-3 mt-lg-0">
                                                    <div class="text-lg-end">
                                                        <div class="mb-2">
                                                            <span class="fw-semibold text-primary">Total: Rp
                                                                {{ number_format($order['total'], 0, ',', '.') }}</span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <small
                                                                class="
                                                            @if ($order['status'] == 'delivered') text-warning
                                                            @elseif($order['status'] == 'completed') text-success @endif">
                                                                <i class="fas fa-check me-1"></i>
                                                                @if ($order['status'] == 'delivered')
                                                                    Tiba pada
                                                                    {{ date('d M Y', strtotime($order['delivered_date'])) }}
                                                                @elseif($order['status'] == 'completed')
                                                                    Diterima pada
                                                                    {{ date('d M Y', strtotime($order['delivered_date'])) }}
                                                                @endif
                                                            </small>
                                                        </div>

                                                        <div class="d-flex gap-2 justify-content-lg-end">
                                                            <button class="btn btn-outline-primary btn-sm"
                                                                onclick="viewOrderDetail('{{ $order['order_number'] }}')">
                                                                <i class="fas fa-eye me-1"></i>Detail
                                                            </button>
                                                            <button class="btn btn-outline-success btn-sm"
                                                                onclick="buyAgain('{{ $order['order_number'] }}')">
                                                                <i class="fas fa-redo me-1"></i>Beli Lagi
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Empty State untuk Riwayat -->
                                <div id="no-history-orders" class="text-center py-5">
                                    <div class="empty-icon mb-4">
                                        <i class="fas fa-history fa-4x text-muted opacity-25"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-3">Belum Ada Riwayat Pesanan</h5>
                                    <p class="text-muted mb-4">Riwayat pesanan selesai Anda akan muncul di sini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Pesanan -->
    <div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="orderDetailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lacak Pengiriman -->
    <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingModalLabel">Lacak Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="trackingContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bukti Pengiriman -->
    <div class="modal fade" id="shippingProofModal" tabindex="-1" aria-labelledby="shippingProofModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingProofModalLabel">Bukti Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="shippingProofContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bukti Diterima -->
    <div class="modal fade" id="deliveryProofModal" tabindex="-1" aria-labelledby="deliveryProofModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deliveryProofModalLabel">Bukti Pesanan Diterima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="deliveryProofContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ulasan -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Beri Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reviewContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize order management
            initOrderManagement();

            // Filter functionality
            initFilters();
        });

        function initOrderManagement() {
            // Check if there are active orders
            const activeOrders = document.querySelectorAll('#active-orders .order-card');
            const noActiveOrders = document.getElementById('no-active-orders');

            if (activeOrders.length === 0) {
                noActiveOrders.classList.remove('d-none');
            } else {
                noActiveOrders.classList.add('d-none');
            }

            // Check if there are history orders
            const historyOrders = document.querySelectorAll('#order-history .order-card');
            const noHistoryOrders = document.getElementById('no-history-orders');

            if (historyOrders.length === 0) {
                noHistoryOrders.classList.remove('d-none');
            } else {
                noHistoryOrders.classList.add('d-none');
            }
        }

        function initFilters() {
            const statusFilter = document.getElementById('status-filter');
            const timeFilter = document.getElementById('time-filter');
            const searchInput = document.getElementById('search-orders');

            function applyFilters() {
                const statusValue = statusFilter.value;
                const timeValue = timeFilter.value;
                const searchValue = searchInput.value.toLowerCase();

                const allOrders = document.querySelectorAll('.order-card');
                let visibleOrders = 0;

                allOrders.forEach(order => {
                    const orderStatus = order.getAttribute('data-status');
                    const orderDate = new Date(order.getAttribute('data-date'));
                    const orderText = order.textContent.toLowerCase();

                    let statusMatch = !statusValue || orderStatus === statusValue;
                    let timeMatch = !timeValue || matchesTimeFilter(orderDate, timeValue);
                    let searchMatch = !searchValue || orderText.includes(searchValue);

                    if (statusMatch && timeMatch && searchMatch) {
                        order.style.display = 'block';
                        visibleOrders++;
                    } else {
                        order.style.display = 'none';
                    }
                });

                // Update empty states
                updateEmptyStates();
            }

            statusFilter.addEventListener('change', applyFilters);
            timeFilter.addEventListener('change', applyFilters);
            searchInput.addEventListener('input', applyFilters);
        }

        function matchesTimeFilter(orderDate, timeFilter) {
            const now = new Date();
            const startOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            const startOfWeek = new Date(now.getFullYear(), now.getMonth(), now.getDate() - now.getDay());
            const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
            const threeMonthsAgo = new Date(now.getFullYear(), now.getMonth() - 3, now.getDate());

            switch (timeFilter) {
                case 'today':
                    return orderDate >= startOfDay;
                case 'week':
                    return orderDate >= startOfWeek;
                case 'month':
                    return orderDate >= startOfMonth;
                case '3months':
                    return orderDate >= threeMonthsAgo;
                default:
                    return true;
            }
        }

        function updateEmptyStates() {
            // Update active orders empty state
            const visibleActiveOrders = document.querySelectorAll('#active-orders .order-card[style="display: block"]')
                .length;
            const noActiveOrders = document.getElementById('no-active-orders');

            if (visibleActiveOrders === 0) {
                noActiveOrders.classList.remove('d-none');
            } else {
                noActiveOrders.classList.add('d-none');
            }

            // Update history orders empty state
            const visibleHistoryOrders = document.querySelectorAll('#order-history .order-card[style="display: block"]')
                .length;
            const noHistoryOrders = document.getElementById('no-history-orders');

            if (visibleHistoryOrders === 0) {
                noHistoryOrders.classList.remove('d-none');
            } else {
                noHistoryOrders.classList.add('d-none');
            }
        }

        // Fungsi untuk membuka modal ulasan
        function openReviewModal(orderId, items) {
            let reviewContent = `
                <div class="review-form">
                    <h6 class="fw-semibold mb-3">Beri Ulasan untuk Pesanan #${orderId}</h6>

                    <div class="mb-4">
                        <h6 class="fw-semibold mb-2">Produk yang Dipesan:</h6>
                        <div class="border rounded p-3">
            `;

            items.forEach((item, index) => {
                reviewContent += `
                    <div class="d-flex align-items-center mb-3 ${index > 0 ? 'pt-3 border-top' : ''}">
                        <img src="${item.image}"
                             alt="${item.name}"
                             class="rounded me-3"
                             style="width: 50px; height: 50px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1">${item.name}</h6>
                            <p class="text-muted mb-0 small">${item.quantity} x Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating untuk ${item.name}</label>
                        <div class="star-rating mb-2" data-product-id="${item.product_id}">
                            <span class="stars">
                                <i class="far fa-star" data-rating="1"></i>
                                <i class="far fa-star" data-rating="2"></i>
                                <i class="far fa-star" data-rating="3"></i>
                                <i class="far fa-star" data-rating="4"></i>
                                <i class="far fa-star" data-rating="5"></i>
                            </span>
                            <input type="hidden" name="rating_${item.product_id}" id="rating_${item.product_id}" value="0">
                            <small class="text-muted ms-2"><span id="rating-text-${item.product_id}">Pilih rating</span></small>
                        </div>

                        <div class="mb-3">
                            <label for="comment_${item.product_id}" class="form-label">Ulasan untuk ${item.name}</label>
                            <textarea class="form-control"
                                      id="comment_${item.product_id}"
                                      name="comment_${item.product_id}"
                                      rows="3"
                                      placeholder="Bagaimana pengalaman Anda dengan produk ini?"></textarea>
                            <div class="form-text">Minimal 10 karakter</div>
                        </div>
                    </div>
                `;
            });

            reviewContent += `
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Ulasan Anda akan membantu pembeli lain dalam memutuskan pembelian.
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="submitReview('${orderId}')">
                            <i class="fas fa-paper-plane me-1"></i>Kirim Ulasan
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('reviewContent').innerHTML = reviewContent;

            // Initialize star rating
            initStarRating();

            const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
            modal.show();
        }

        function initStarRating() {
            const stars = document.querySelectorAll('.star-rating .fa-star');

            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    const parent = this.closest('.star-rating');
                    highlightStars(parent, rating);
                });

                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    const parent = this.closest('.star-rating');
                    const productId = parent.getAttribute('data-product-id');
                    const hiddenInput = document.getElementById(`rating_${productId}`);
                    const ratingText = document.getElementById(`rating-text-${productId}`);

                    hiddenInput.value = rating;
                    highlightStars(parent, rating, true);

                    // Update rating text
                    const ratingLabels = {
                        1: 'Sangat Buruk',
                        2: 'Buruk',
                        3: 'Cukup',
                        4: 'Baik',
                        5: 'Sangat Baik'
                    };
                    ratingText.textContent = ratingLabels[rating];
                });
            });

            // Reset stars on mouse leave
            document.querySelectorAll('.star-rating').forEach(rating => {
                rating.addEventListener('mouseleave', function() {
                    const productId = this.getAttribute('data-product-id');
                    const currentRating = parseInt(document.getElementById(`rating_${productId}`).value);
                    highlightStars(this, currentRating, true);
                });
            });
        }

        function highlightStars(parent, rating, permanent = false) {
            const stars = parent.querySelectorAll('.fa-star');
            const ratingText = document.getElementById(`rating-text-${parent.getAttribute('data-product-id')}`);

            stars.forEach((star, index) => {
                if (index < rating) {
                    star.className = permanent ? 'fas fa-star text-warning' : 'fas fa-star text-warning';
                } else {
                    star.className = permanent ? 'far fa-star text-muted' : 'far fa-star text-muted';
                }
            });

            if (!permanent && rating > 0) {
                const ratingLabels = {
                    1: 'Sangat Buruk',
                    2: 'Buruk',
                    3: 'Cukup',
                    4: 'Baik',
                    5: 'Sangat Baik'
                };
                ratingText.textContent = ratingLabels[rating];
            }
        }

        // Fungsi untuk mengirim ulasan
        function submitReview(orderId) {
            const items = document.querySelectorAll('.star-rating');
            let isValid = true;
            const reviewData = {
                order_id: orderId,
                ratings: []
            };

            items.forEach(item => {
                const productId = item.getAttribute('data-product-id');
                const rating = parseInt(document.getElementById(`rating_${productId}`).value);
                const comment = document.getElementById(`comment_${productId}`).value.trim();

                if (rating === 0) {
                    isValid = false;
                    showToast('Harap beri rating untuk semua produk', 'error');
                    return;
                }

                if (comment.length < 10) {
                    isValid = false;
                    showToast('Ulasan minimal 10 karakter untuk setiap produk', 'error');
                    return;
                }

                reviewData.ratings.push({
                    product_id: productId,
                    rating: rating,
                    comment: comment
                });
            });

            if (!isValid) return;

            // Simulasi AJAX request
            showToast('Mengirim ulasan...', 'info');

            // Dalam implementasi nyata, gunakan fetch atau axios
            setTimeout(() => {
                        // Simulasi response sukses
                        const firstProduct = reviewData.ratings[0];
                        showToast('Ulasan berhasil dikirim!', 'success');

                        // Update UI untuk menampilkan ulasan
                        const orderCard = document.querySelector(`[data-order="${orderId}"]`);
                        if (orderCard) {
                            const reviewHtml = `
                        <div class="mt-2 p-2 bg-light rounded">
                            <div class="d-flex align-items-center mb-1">
                                <div class="star-rating me-2">
                                    ${Array.from({length: 5}, (_, i) =>
                                        ` < i class =
                                "fas fa-star ${i < firstProduct.rating ? 'text-warning' : 'text-muted'}" > < /i>`
                    ).join('')
                } <
                /div> <
                small class = "text-muted" > $ {
                    new Date().toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    })
                } < /small> <
                /div> <
                p class = "mb-0 small" > $ {
                    firstProduct.comment
                } < /p> <
                /div>
                `;

                        const itemContainer = orderCard.querySelector('.flex-grow-1');
                        if (itemContainer) {
                            const existingReview = itemContainer.querySelector('.bg-light.rounded');
                            if (existingReview) {
                                existingReview.remove();
                            }
                            itemContainer.insertAdjacentHTML('beforeend', reviewHtml);
                        }

                        // Sembunyikan tombol beri ulasan
                        const reviewButton = orderCard.querySelector('.btn-warning');
                        if (reviewButton) {
                            reviewButton.remove();
                        }
                    }

                    // Tutup modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
                    modal.hide();
                }, 1500);
            }

            // Fungsi untuk menampilkan detail pesanan
            function viewOrderDetail(orderId) {
                const orderDetailContent = ` <
                div class = "order-detail" >
                <
                div class = "row mb-4" >
                <
                div class = "col-md-6" >
                <
                h6 class = "fw-semibold" > Informasi Pesanan < /h6> <
                table class = "table table-sm table-borderless" >
                <
                tr >
                <
                td class = "text-muted"
                style = "width: 120px;" > No.Pesanan < /td> <
                td class = "fw-semibold" > $ {
                    orderId
                } < /td> <
                /tr> <
                tr >
                <
                td class = "text-muted" > Tanggal < /td> <
                td > $ {
                    new Date().toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    })
                } < /td> <
                /tr> <
                tr >
                <
                td class = "text-muted" > Status < /td> <
                td > < span class = "badge bg-success" > Selesai < /span></td >
                <
                /tr> <
                tr >
                <
                td class = "text-muted" > Metode Bayar < /td> <
                td > Transfer Bank BCA < /td> <
                /tr> <
                /table> <
                /div> <
                div class = "col-md-6" >
                <
                h6 class = "fw-semibold" > Alamat Pengiriman < /h6> <
                div class = "border rounded p-3 bg-light" >
                <
                p class = "mb-1 fw-semibold" > John Doe < /p> <
                p class = "mb-1 text-muted" > +62 812 - 3456 - 7890 < /p> <
                p class = "mb-0 text-muted small" >
                Jl.Contoh Alamat No.123, Kel.Contoh, Kec.Contoh < br >
                Kota Contoh, Provinsi Contoh - 12345 <
                /p> <
                /div> <
                /div> <
                /div>

                <
                h6 class = "fw-semibold mb-3" > Produk Dipesan < /h6> <
                div class = "table-responsive" >
                <
                table class = "table table-bordered" >
                <
                thead class = "table-light" >
                <
                tr >
                <
                th > Produk < /th> <
                th class = "text-center" > Qty < /th> <
                th class = "text-end" > Harga < /th> <
                th class = "text-end" > Subtotal < /th> <
                /tr> <
                /thead> <
                tbody >
                <
                tr >
                <
                td >
                <
                div class = "d-flex align-items-center" >
                <
                img src = "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=60&h=60&fit=crop"
                alt = "Kemeja Flanel Pria"
                class = "rounded me-2"
                style = "width: 40px; height: 40px; object-fit: cover;" >
                <
                span > Kemeja Flanel Pria < /span> <
                /div> <
                /td> <
                td class = "text-center" > 1 < /td> <
                td class = "text-end" > Rp 189.000 < /td> <
                td class = "text-end" > Rp 189.000 < /td> <
                /tr> <
                /tbody> <
                tfoot >
                <
                tr >
                <
                td colspan = "3"
                class = "text-end fw-semibold" > Total < /td> <
                td class = "text-end fw-bold text-primary" > Rp 189.000 < /td> <
                /tr> <
                /tfoot> <
                /table> <
                /div> <
                /div>
                `;

                document.getElementById('orderDetailContent').innerHTML = orderDetailContent;
                const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
                modal.show();
            }

            // Fungsi untuk melacak pengiriman
            function trackOrder(orderId) {
                const trackingContent = ` <
                div class = "tracking-info" >
                <
                div class = "row mb-4" >
                <
                div class = "col-md-6" >
                <
                h6 class = "fw-semibold" > Informasi Pengiriman < /h6> <
                table class = "table table-sm table-borderless" >
                <
                tr >
                <
                td class = "text-muted"
                style = "width: 120px;" > No.Pesanan < /td> <
                td class = "fw-semibold" > $ {
                    orderId
                } < /td> <
                /tr> <
                tr >
                <
                td class = "text-muted" > Kurir < /td> <
                td > JNE Reguler < /td> <
                /tr> <
                tr >
                <
                td class = "text-muted" > No.Resi < /td> <
                td class = "fw-semibold" > JNE1234567890 < /td> <
                /tr> <
                tr >
                <
                td class = "text-muted" > Status < /td> <
                td > < span class = "badge bg-info" > Dalam Perjalanan < /span></td >
                <
                /tr> <
                /table> <
                /div> <
                div class = "col-md-6" >
                <
                h6 class = "fw-semibold" > Alamat Tujuan < /h6> <
                div class = "border rounded p-3 bg-light" >
                <
                p class = "mb-1 fw-semibold" > John Doe < /p> <
                p class = "mb-1 text-muted" > +62 812 - 3456 - 7890 < /p> <
                p class = "mb-0 text-muted small" >
                Jl.Contoh Alamat No.123, Kel.Contoh, Kec.Contoh < br >
                Kota Contoh, Provinsi Contoh - 12345 <
                /p> <
                /div> <
                /div> <
                /div>

                <
                h6 class = "fw-semibold mb-3" > Riwayat Pengiriman < /h6> <
                div class = "tracking-timeline" >
                <
                div class = "tracking-step completed" >
                <
                div class = "step-icon" >
                <
                i class = "fas fa-check" > < /i> <
                /div> <
                div class = "step-content" >
                <
                h6 class = "fw-semibold mb-1" > Pesanan Diterima < /h6> <
                p class = "text-muted mb-1" > Pesanan telah diterima oleh sistem < /p> <
                small class = "text-muted" > 12 Jan 2024, 11: 20 < /small> <
                /div> <
                /div> <
                div class = "tracking-step completed" >
                <
                div class = "step-icon" >
                <
                i class = "fas fa-check" > < /i> <
                /div> <
                div class = "step-content" >
                <
                h6 class = "fw-semibold mb-1" > Pesanan Diproses < /h6> <
                p class = "text-muted mb-1" > Pesanan sedang diproses oleh penjual < /p> <
                small class = "text-muted" > 12 Jan 2024, 14: 30 < /small> <
                /div> <
                /div> <
                div class = "tracking-step completed" >
                <
                div class = "step-icon" >
                <
                i class = "fas fa-check" > < /i> <
                /div> <
                div class = "step-content" >
                <
                h6 class = "fw-semibold mb-1" > Pesanan Dikirim < /h6> <
                p class = "text-muted mb-1" > Pesanan telah dikirim melalui kurir < /p> <
                small class = "text-muted" > 13 Jan 2024, 09: 15 < /small> <
                /div> <
                /div> <
                div class = "tracking-step active" >
                <
                div class = "step-icon" >
                <
                i class = "fas fa-truck" > < /i> <
                /div> <
                div class = "step-content" >
                <
                h6 class = "fw-semibold mb-1" > Dalam Perjalanan < /h6> <
                p class = "text-muted mb-1" > Pesanan sedang dalam perjalanan ke alamat tujuan < /p> <
                small class = "text-muted" > Saat ini < /small> <
                /div> <
                /div> <
                div class = "tracking-step" >
                <
                div class = "step-icon" >
                <
                i class = "fas fa-home" > < /i> <
                /div> <
                div class = "step-content" >
                <
                h6 class = "fw-semibold mb-1" > Tiba di Tujuan < /h6> <
                p class = "text-muted mb-1" > Pesanan telah tiba di alamat tujuan < /p> <
                small class = "text-muted" > Estimasi: 16 Jan 2024 < /small> <
                /div> <
                /div> <
                /div> <
                /div>
                `;

                document.getElementById('trackingContent').innerHTML = trackingContent;
                const modal = new bootstrap.Modal(document.getElementById('trackingModal'));
                modal.show();
            }

            // Fungsi untuk melihat bukti pengiriman
            function viewShippingProof(orderId) {
                const shippingProofContent = ` <
                div class = "text-center" >
                <
                h6 class = "fw-semibold mb-3" > Bukti Pengiriman - $ {
                    orderId
                } < /h6> <
                img src = "https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=600&h=400&fit=crop"
                alt = "Bukti Pengiriman"
                class = "img-fluid rounded mb-3" >
                <
                p class = "text-muted" > Bukti pengiriman dari kurir untuk pesanan $ {
                    orderId
                } < /p> <
                div class = "mt-3" >
                <
                button class = "btn btn-primary"
                onclick =
                "downloadImage('https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=600&h=400&fit=crop', 'bukti-pengiriman-${orderId}')" >
                <
                i class = "fas fa-download me-2" > < /i>Download Bukti <
                /button> <
                /div> <
                /div>
                `;

                document.getElementById('shippingProofContent').innerHTML = shippingProofContent;
                const modal = new bootstrap.Modal(document.getElementById('shippingProofModal'));
                modal.show();
            }

            // Fungsi untuk melihat bukti diterima
            function viewDeliveryProof(orderId) {
                const deliveryProofContent = ` <
                div class = "text-center" >
                <
                h6 class = "fw-semibold mb-3" > Bukti Pesanan Diterima - $ {
                    orderId
                } < /h6> <
                img src = "https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600&h=400&fit=crop"
                alt = "Bukti Diterima"
                class = "img-fluid rounded mb-3" >
                <
                p class = "text-muted" > Bukti pesanan telah diterima untuk pesanan $ {
                    orderId
                } < /p> <
                div class = "mt-3" >
                <
                button class = "btn btn-primary"
                onclick =
                "downloadImage('https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600&h=400&fit=crop', 'bukti-diterima-${orderId}')" >
                <
                i class = "fas fa-download me-2" > < /i>Download Bukti <
                /button> <
                /div> <
                /div>
                `;

                document.getElementById('deliveryProofContent').innerHTML = deliveryProofContent;
                const modal = new bootstrap.Modal(document.getElementById('deliveryProofModal'));
                modal.show();
            }

            // Fungsi untuk konfirmasi penerimaan
            function confirmDelivery(orderId) {
                if (confirm(`
                Konfirmasi bahwa pesanan $ {
                    orderId
                }
                telah diterima ? `)) {
                    showToast(`
                Pesanan $ {
                    orderId
                }
                dikonfirmasi telah diterima`, 'success');
                    // Simulate API call to confirm delivery
                    setTimeout(() => {
                        const statusBadge = document.querySelector(` [data - order = "${orderId}"].order - status - badge`);
                        if (statusBadge) {
                            statusBadge.className = 'order-status-badge delivered me-3';
                            statusBadge.innerHTML = '<i class="fas fa-check-circle me-1"></i><span>Selesai</span>';
                        }
                    }, 1500);
                }
            }

            // Fungsi untuk membeli lagi
            function buyAgain(orderId) {
                showToast(`
                Menambahkan produk dari pesanan $ {
                    orderId
                }
                ke keranjang`, 'success');
                // Simulate adding products to cart
                // Redirect to cart page
                setTimeout(() => {
                    window.location.href = '/cart';
                }, 1500);
            }

            // Fungsi untuk download gambar
            function downloadImage(url, filename) {
                const link = document.createElement('a');
                link.href = url;
                link.download = filename;
                link.click();
            }

            // Fungsi untuk menampilkan toast
            function showToast(message, type = 'info') {
                const bgColor = type === 'success' ? 'bg-success' :
                               type === 'error' ? 'bg-danger' :
                               type === 'warning' ? 'bg-warning' : 'bg-info';

                const toast = document.createElement('div');
                toast.className = `
                toast align - items - center text - white $ {
                    bgColor
                }
                border - 0 position - fixed`;
                toast.style.top = '20px';
                toast.style.right = '20px';
                toast.style.zIndex = '1055';

                toast.innerHTML = ` <
                div class = "d-flex" >
                <
                div class = "toast-body" >
                <
                i class =
                "fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'} me-2" >
                < /i>
                $ {
                    message
                } <
                /div> <
                button type = "button"
                class = "btn-close btn-close-white me-2 m-auto"
                data - bs - dismiss = "toast" > < /button> <
                /div>
                `;

                document.body.appendChild(toast);

                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();

                toast.addEventListener('hidden.bs.toast', function() {
                    document.body.removeChild(toast);
                });
            }
    </script>
@endsection
