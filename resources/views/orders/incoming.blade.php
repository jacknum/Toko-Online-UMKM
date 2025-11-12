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
                <button type="button" class="btn btn-primary" id="exportReportBtn">
                    <i class="fas fa-download me-2"></i>Export Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom shadow stat-card-primary">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-shopping-cart text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['new_orders'] }}</div>
                <div class="stat-title">Pesanan Baru</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom shadow stat-card-warning">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-clock text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['pending_confirmation'] }}</div>
                <div class="stat-title">Menunggu Konfirmasi</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom shadow stat-card-success">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-calendar-day text-white"></i>
                </div>
                <div class="stat-number">{{ $stats['today_orders'] }}</div>
                <div class="stat-title">Pesanan Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom shadow stat-card-info">
            <div class="card-body stat-card text-white">
                <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($stats['total_value'], 0, ',', '.') }}</div>
                <div class="stat-title">Total Nilai Pesanan</div>
            </div>
        </div>
    </div>
</div>

<!-- Orders Section -->
<div class="card card-custom shadow">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="card-title mb-0 fw-bold text-primary">Daftar Pesanan</h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body py-3 px-4">
                        <ul class="nav nav-pills nav-fill" id="incomingFilterTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link active" data-filter="all">
                                    Semua
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link" data-filter="pending">
                                    Baru
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link" data-filter="confirmed">
                                    Diproses
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#" class="nav-link" data-filter="shipped">
                                    Selesai
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover table-custom" id="ordersTable">
                <thead>
                    <tr>
                        <th class="ps-4">Produk</th>
                        <th>Customer</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th class="pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="order-row" data-status="{{ $order->status }}">
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-size: 0.8rem; font-weight: bold;">
                                    {{ substr($order->product_name, 0, 2) }}
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $order->product_name }}</h6>
                                    <small class="text-muted">{{ date('d M Y', strtotime($order->created_at)) }}</small>
                                    @if($order->buyer_courier && $order->is_courier_locked)
                                        <div class="mt-1">
                                            <small class="badge bg-info text-white">
                                                <i class="fas fa-shipping-fast me-1"></i>
                                                Kurir: {{ strtoupper($order->buyer_courier) }} ✓
                                            </small>
                                        </div>
                                    @endif
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
                            <span class="badge bg-light text-dark border px-3 py-2">{{ $order->quantity }}</span>
                        </td>
                        <td>
                            <strong>Rp {{ number_format($order->price, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge badge-custom bg-warning text-white px-3 py-2">
                                    <i class="fas fa-clock me-1"></i>Menunggu Konfirmasi
                                </span>
                            @elseif($order->status == 'confirmed')
                                <span class="badge badge-custom bg-info text-white px-3 py-2">
                                    <i class="fas fa-check me-1"></i>Dikonfirmasi
                                </span>
                            @elseif($order->status == 'shipped')
                                <span class="badge badge-custom bg-success text-white px-3 py-2">
                                    <i class="fas fa-shipping-fast me-1"></i>Dikirim
                                </span>
                            @endif
                        </td>
                        <td class="pe-4">
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary px-3" onclick="showOrderDetail({{ $order->id }})" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>

                                @if($order->status == 'pending')
                                    <button class="btn btn-sm btn-outline-success px-3" onclick="showAcceptModal({{ $order->id }}, '{{ $order->product_name }}')" title="Terima">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger px-3" onclick="showRejectModal({{ $order->id }}, '{{ $order->product_name }}')" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @elseif($order->status == 'confirmed')
                                    <button class="btn btn-sm btn-outline-info px-3"
                                        onclick="showProcessModal(
                                            {{ $order->id }},
                                            '{{ $order->product_name }}',
                                            '{{ $order->buyer_courier ?? 'all' }}',
                                            {{ $order->is_courier_locked ? 'true' : 'false' }},
                                            {{ json_encode($availableCouriers) }}
                                        )"
                                        title="Proses">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                @elseif($order->status == 'shipped')
                                    <button class="btn btn-sm btn-outline-warning px-3" onclick="showTrackModal({{ $order->id }}, '{{ $order->product_name }}')" title="Lacak">
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
        <nav aria-label="Page navigation" class="mt-4">
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

<!-- Modal untuk Export Laporan -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-export me-2"></i>Export Laporan Pesanan
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
                                <option value="pending">Pesanan Baru</option>
                                <option value="confirmed">Sedang Diproses</option>
                                <option value="shipped">Selesai Dikirim</option>
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
                        <strong>Informasi:</strong> Laporan akan menampilkan semua pesanan berdasarkan periode dan status yang dipilih.
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

                <!-- Informasi Kurir yang Dipilih Pembeli -->
                <div class="mb-3" id="buyerCourierInfo" style="display: none;">
                    <div class="alert alert-info">
                        <small>Kurir yang dipilih pembeli: <strong id="selectedBuyerCourier"></strong></small>
                    </div>
                </div>

                <!-- Informasi Kurir Terkunci -->
                <div class="mb-3" id="lockedCourierInfo" style="display: none;">
                    <div class="alert alert-warning">
                        <small><i class="fas fa-lock me-1"></i>Kurir telah dipilih pembeli dan tidak dapat diubah: <strong id="lockedCourierName"></strong></small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="courier" class="form-label">Pilih Kurir Pengiriman:</label>
                    <select class="form-select" id="courier" name="courier">
                        <option value="">Pilih Kurir</option>
                        <!-- Opsi kurir akan di-generate secara dinamis -->
                    </select>
                    <small class="form-text text-muted">
                        <span id="allCourierInfo" style="display: none;">Pembeli memilih semua kurir. Silakan pilih kurir yang akan digunakan.</span>
                        <span id="specificCourierInfo" style="display: none;">Pembeli telah memilih kurir tertentu. Rekomendasi: gunakan kurir yang sama.</span>
                        <span id="lockedCourierMessage" style="display: none;" class="text-warning"><i></i>Kurir telah dikunci sesuai pilihan pembeli dan tidak dapat diubah</span>
                    </small>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    let currentOrderId = null;

    // Data dummy untuk laporan - DIPERBAIKI: menggunakan format tanggal yang konsisten
    const dummyOrders = [
        {
            product_name: "Laptop ASUS ROG Strix G15",
            customer_name: "Budi Santoso",
            quantity: 1,
            price: 18500000,
            status: "pending",
            created_at: "15 Nov 2025"
        },
        {
            product_name: "Smartphone Samsung Galaxy S23",
            customer_name: "Sari Indah",
            quantity: 2,
            price: 12500000,
            status: "confirmed",
            created_at: "14 Nov 2025"
        },
        {
            product_name: "Tablet iPad Pro 12.9",
            customer_name: "Ahmad Wijaya",
            quantity: 1,
            price: 21500000,
            status: "shipped",
            created_at: "13 Nov 2025"
        },
        {
            product_name: "Monitor LG UltraGear 27\"",
            customer_name: "Dewi Kartika",
            quantity: 3,
            price: 4500000,
            status: "pending",
            created_at: "12 Nov 2025"
        },
        {
            product_name: "Keyboard Mechanical RGB",
            customer_name: "Rizky Pratama",
            quantity: 2,
            price: 850000,
            status: "confirmed",
            created_at: "11 Nov 2025"
        },
        {
            product_name: "Mouse Gaming Wireless",
            customer_name: "Fitri Handayani",
            quantity: 1,
            price: 650000,
            status: "shipped",
            created_at: "10 Nov 2025"
        },
        {
            product_name: "Headphone Sony WH-1000XM4",
            customer_name: "Hendra Kurniawan",
            quantity: 1,
            price: 3850000,
            status: "pending",
            created_at: "09 Nov 2025"
        },
        {
            product_name: "Webcam Logitech C920",
            customer_name: "Maya Sari",
            quantity: 2,
            price: 950000,
            status: "confirmed",
            created_at: "08 Nov 2025"
        },
        {
            product_name: "External SSD 1TB",
            customer_name: "Tono Sutrisno",
            quantity: 1,
            price: 1850000,
            status: "shipped",
            created_at: "07 Nov 2025"
        },
        {
            product_name: "Printer Epson L3210",
            customer_name: "Linda Permata",
            quantity: 1,
            price: 2450000,
            status: "pending",
            created_at: "06 Nov 2025"
        },
        // Data tambahan untuk Gaming PC dengan status confirmed dan kurir JNE terkunci
        {
            product_name: "Gaming PC RTX 4070 Ti",
            customer_name: "Kevin Maulana",
            quantity: 1,
            price: 28500000,
            status: "confirmed",
            created_at: "16 Nov 2025",
            buyer_courier: "jne",
            is_courier_locked: true
        }
    ];

    // Inisialisasi filter saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk mengelola filter pesanan
        document.querySelectorAll('#incomingFilterTabs [data-filter]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Reset semua tab ke state tidak aktif
                document.querySelectorAll('#incomingFilterTabs .nav-link').forEach(tab => {
                    tab.classList.remove('active');
                });

                // Set tab yang aktif
                this.classList.add('active');

                const filter = this.dataset.filter;
                filterOrders(filter);
            });
        });

        // Set filter default ke "all"
        filterOrders('all');

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

    function filterOrders(status) {
        const orders = document.querySelectorAll('.order-row');
        let hasVisibleRows = false;

        orders.forEach(order => {
            if (status === 'all' || order.dataset.status === status) {
                order.style.display = 'table-row';
                hasVisibleRows = true;
            } else {
                order.style.display = 'none';
            }
        });

        // Jika tidak ada row yang visible, tampilkan pesan
        const tbody = document.querySelector('tbody');
        let noResultsRow = tbody.querySelector('.no-results-row');

        if (!hasVisibleRows) {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-results-row text-center';
                noResultsRow.innerHTML = `
                    <td colspan="6" class="py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Tidak ada pesanan dengan status yang dipilih</p>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            }
            noResultsRow.style.display = 'table-row';
        } else if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    }

    // Fungsi untuk menangani aksi pada pesanan
    function showOrderDetail(orderId) {
        window.location.href = `/orders/${orderId}`;
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

    // Fungsi untuk generate PDF report
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
        const reportTitle = "LAPORAN PESANAN MASUK";
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

        // Tabel data pesanan - DIPERBAIKI: tambah pengecekan jika data kosong
        if (reportData.length === 0) {
            doc.setFontSize(12);
            doc.text("Tidak ada data pesanan untuk periode yang dipilih", 20, 90);
        } else {
            const tableColumns = [
                { header: 'No', dataKey: 'no' },
                { header: 'Tanggal', dataKey: 'date' },
                { header: 'Produk', dataKey: 'product' },
                { header: 'Customer', dataKey: 'customer' },
                { header: 'Qty', dataKey: 'quantity' },
                { header: 'Harga Satuan', dataKey: 'price' },
                { header: 'Total', dataKey: 'total' },
                { header: 'Status', dataKey: 'status' }
            ];

            const tableRows = reportData.map((order, index) => ({
                no: index + 1,
                date: order.created_at,
                product: order.product_name,
                customer: order.customer_name,
                quantity: order.quantity,
                price: `Rp ${formatNumber(order.price)}`,
                total: `Rp ${formatNumber(order.price * order.quantity)}`,
                status: getStatusText(order.status)
            }));

            // Hitung total
            const totalQty = reportData.reduce((sum, order) => sum + order.quantity, 0);
            const totalValue = reportData.reduce((sum, order) => sum + (order.price * order.quantity), 0);

            doc.autoTable({
                columns: tableColumns,
                body: tableRows,
                startY: 80,
                styles: { fontSize: 8 },
                headStyles: { fillColor: [41, 128, 185] },
                foot: [
                    [
                        { content: 'TOTAL:', colSpan: 4, styles: { fontStyle: 'bold', halign: 'right' } },
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
        const fileName = `Laporan_Pesanan_Masuk_${month}_${year}.pdf`;
        doc.save(fileName);

        showAlert('success', 'Laporan PDF berhasil diunduh');
    }

    // Fungsi untuk generate Excel report
    function generateExcelReport(month, year, orderStatus) {
        const reportData = getReportData(month, year, orderStatus);

        // Data untuk header
        const headerData = [
            ['PT. MAKMUR SEJAHTERA'],
            ['Jl. Industri No. 123, Kawasan Industri Modern, Jakarta 12940'],
            ['Telp: (021) 5567-8901 | Fax: (021) 5567-8902'],
            ['Email: info@makmursejahtera.co.id | Website: www.makmursejahtera.co.id'],
            [],
            ['LAPORAN PESANAN MASUK'],
            [`Periode Laporan: ${getReportPeriod(month, year)}`],
            [`Status Pesanan: ${getStatusText(orderStatus)}`],
            [`Total Pesanan: ${reportData.length} item`],
            [`Tanggal Cetak: ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}`],
            []
        ];

        // Header tabel
        const tableHeader = ['No', 'Tanggal', 'Produk', 'Customer', 'Qty', 'Harga Satuan', 'Total', 'Status'];

        // Data tabel - DIPERBAIKI: tambah pengecekan jika data kosong
        let tableData = [];
        if (reportData.length === 0) {
            tableData.push(['Tidak ada data pesanan untuk periode yang dipilih']);
        } else {
            tableData = reportData.map((order, index) => [
                index + 1,
                order.created_at,
                order.product_name,
                order.customer_name,
                order.quantity,
                `Rp ${formatNumber(order.price)}`,
                `Rp ${formatNumber(order.price * order.quantity)}`,
                getStatusText(order.status)
            ]);

            // Hitung total
            const totalQty = reportData.reduce((sum, order) => sum + order.quantity, 0);
            const totalValue = reportData.reduce((sum, order) => sum + (order.price * order.quantity), 0);

            tableData.push([]);
            tableData.push(['', '', '', 'TOTAL:', totalQty, '', `Rp ${formatNumber(totalValue)}`, '']);
        }

        // Gabungkan semua data
        const excelData = [...headerData, tableHeader, ...tableData];

        // Buat workbook
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(excelData);

        // Merge cells untuk header
        const merges = [
            { s: { r: 0, c: 0 }, e: { r: 0, c: 7 } },
            { s: { r: 1, c: 0 }, e: { r: 1, c: 7 } },
            { s: { r: 2, c: 0 }, e: { r: 2, c: 7 } },
            { s: { r: 3, c: 0 }, e: { r: 3, c: 7 } },
            { s: { r: 5, c: 0 }, e: { r: 5, c: 7 } },
            { s: { r: 6, c: 0 }, e: { r: 6, c: 7 } },
            { s: { r: 7, c: 0 }, e: { r: 7, c: 7 } },
            { s: { r: 8, c: 0 }, e: { r: 8, c: 7 } },
            { s: { r: 9, c: 0 }, e: { r: 9, c: 7 } }
        ];
        ws['!merges'] = merges;

        // Atur lebar kolom
        ws['!cols'] = [
            { wch: 5 },   // No
            { wch: 12 },  // Tanggal
            { wch: 30 },  // Produk
            { wch: 20 },  // Customer
            { wch: 8 },   // Qty
            { wch: 15 },  // Harga Satuan
            { wch: 15 },  // Total
            { wch: 15 }   // Status
        ];

        XLSX.utils.book_append_sheet(wb, ws, 'Laporan Pesanan');

        // Simpan file
        const fileName = `Laporan_Pesanan_Masuk_${month}_${year}.xlsx`;
        XLSX.writeFile(wb, fileName);

        showAlert('success', 'Laporan Excel berhasil diunduh');
    }

    // Helper functions - DIPERBAIKI: fungsi isDateInPeriod
    function getReportData(month, year, orderStatus) {
        // Gunakan data dummy untuk prototype
        let filteredData = dummyOrders.filter(order => {
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
            // Konversi date string "15 Nov 2025" ke Date object
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
            'pending': 'Menunggu Konfirmasi',
            'confirmed': 'Sedang Diproses',
            'shipped': 'Selesai Dikirim'
        };
        return statusMap[status] || status;
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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

    function showProcessModal(orderId, productName, buyerCourier = null, isCourierLocked = false, availableCouriers = null) {
        currentOrderId = orderId;
        document.getElementById('processProductName').textContent = productName;
        document.getElementById('courier').value = '';
        document.getElementById('trackingNumber').value = '';

        // Reset semua elemen informasi kurir
        resetCourierModalElements();

        // Setup pilihan kurir berdasarkan kondisi
        setupCourierSelection(buyerCourier, isCourierLocked, availableCouriers);

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

    // Fungsi untuk reset elemen modal kurir
    function resetCourierModalElements() {
        // Sembunyikan semua elemen informasi
        document.getElementById('buyerCourierInfo').style.display = 'none';
        document.getElementById('allCourierInfo').style.display = 'none';
        document.getElementById('specificCourierInfo').style.display = 'none';
        document.getElementById('lockedCourierInfo').style.display = 'none';
        document.getElementById('lockedCourierMessage').style.display = 'none';

        // Reset dropdown kurir ke default
        const courierSelect = document.getElementById('courier');
        courierSelect.innerHTML = '<option value="">Pilih Kurir</option>';
        courierSelect.disabled = false;

        // Hapus pesan informasi yang mungkin sudah ada sebelumnya
        const existingInfoText = courierSelect.parentNode.querySelector('.form-text.text-warning');
        if (existingInfoText) {
            existingInfoText.remove();
        }
    }

    // Fungsi untuk setup pilihan kurir berdasarkan kondisi pembeli
    function setupCourierSelection(buyerCourier, isCourierLocked, availableCouriers) {
        const courierSelect = document.getElementById('courier');

        // Parse available couriers
        const couriers = parseAvailableCouriers(availableCouriers);

        // Populate dropdown dengan kurir yang tersedia
        populateCourierDropdown(courierSelect, couriers);

        // Handle kondisi berdasarkan kurir yang dipilih pembeli
        handleBuyerCourierCondition(buyerCourier, isCourierLocked, courierSelect, couriers);
    }

    // Fungsi untuk parse available couriers
    function parseAvailableCouriers(availableCouriers) {
        if (!availableCouriers) {
            // Default couriers jika tidak ada data
            return [
                { code: 'jne', name: 'JNE' },
                { code: 'tiki', name: 'TIKI' },
                { code: 'pos', name: 'POS Indonesia' },
                { code: 'jnt', name: 'J&T Express' },
                { code: 'sicepat', name: 'SiCepat' },
                { code: 'anteraja', name: 'Anteraja' }
            ];
        }

        if (Array.isArray(availableCouriers)) {
            return availableCouriers;
        }

        try {
            return JSON.parse(availableCouriers);
        } catch (error) {
            console.error('Error parsing available couriers:', error);
            return [];
        }
    }

    // Fungsi untuk populate dropdown kurir
    function populateCourierDropdown(selectElement, couriers) {
        selectElement.innerHTML = '<option value="">Pilih Kurir</option>';

        couriers.forEach(courier => {
            const option = document.createElement('option');
            option.value = courier.code;
            option.textContent = courier.name;
            selectElement.appendChild(option);
        });
    }

    // Fungsi untuk handle kondisi kurir pembeli
    function handleBuyerCourierCondition(buyerCourier, isCourierLocked, courierSelect, couriers) {
        const buyerCourierInfo = document.getElementById('buyerCourierInfo');
        const allCourierInfo = document.getElementById('allCourierInfo');
        const specificCourierInfo = document.getElementById('specificCourierInfo');
        const lockedCourierInfo = document.getElementById('lockedCourierInfo');
        const lockedCourierMessage = document.getElementById('lockedCourierMessage');

        // Hapus pesan informasi yang mungkin sudah ada sebelumnya
        const existingInfoText = courierSelect.parentNode.querySelector('.form-text.text-warning');
        if (existingInfoText) {
            existingInfoText.remove();
        }

        if (!buyerCourier || buyerCourier === 'all' || buyerCourier === '') {
            // Kondisi 1: Pembeli memilih semua kurir
            allCourierInfo.style.display = 'inline';
            document.getElementById('selectedBuyerCourier').textContent = 'Semua Kurir';
            buyerCourierInfo.style.display = 'block';

            // Reset kondisi lainnya
            specificCourierInfo.style.display = 'none';
            lockedCourierInfo.style.display = 'none';
            lockedCourierMessage.style.display = 'none';
            courierSelect.disabled = false;
        } else if (isCourierLocked) {
            // Kondisi 2: Pembeli memilih kurir tertentu dan terkunci
            lockedCourierInfo.style.display = 'block';
            lockedCourierMessage.style.display = 'inline';
            document.getElementById('lockedCourierName').textContent = getCourierName(buyerCourier);

            // Nonaktifkan dropdown dan set ke kurir yang dipilih pembeli
            courierSelect.disabled = true;
            courierSelect.value = buyerCourier;

            // Reset kondisi lainnya
            allCourierInfo.style.display = 'none';
            specificCourierInfo.style.display = 'none';
            buyerCourierInfo.style.display = 'none';

            // Tambahkan pesan informasi (hanya sekali)
            const infoText = document.createElement('small');
            infoText.className = 'form-text text-warning mt-1';
            infoText.innerHTML = '<i class="fas fa-lock me-1"></i>';
            courierSelect.parentNode.appendChild(infoText);
        } else {
            // Kondisi 3: Pembeli memilih kurir tertentu tapi tidak terkunci
            specificCourierInfo.style.display = 'inline';
            document.getElementById('selectedBuyerCourier').textContent = getCourierName(buyerCourier);
            buyerCourierInfo.style.display = 'block';

            // Reset kondisi lainnya
            allCourierInfo.style.display = 'none';
            lockedCourierInfo.style.display = 'none';
            lockedCourierMessage.style.display = 'none';
            courierSelect.disabled = false;

            // Auto-select kurir yang dipilih pembeli jika tersedia
            autoSelectBuyerCourier(buyerCourier, courierSelect);
        }
    }

    // Fungsi untuk auto-select kurir pembeli
    function autoSelectBuyerCourier(buyerCourier, courierSelect) {
        const buyerCourierOption = courierSelect.querySelector(`option[value="${buyerCourier}"]`);
        if (buyerCourierOption) {
            courierSelect.value = buyerCourier;
        }
    }

    // Fungsi untuk mendapatkan nama kurir dari kode
    function getCourierName(courierCode) {
        const courierNames = {
            'jne': 'JNE',
            'tiki': 'TIKI',
            'pos': 'POS Indonesia',
            'jnt': 'J&T Express',
            'sicepat': 'SiCepat',
            'anteraja': 'Anteraja',
            'all': 'Semua Kurir',
            'jnt_cargo': 'J&T Cargo',
            'rpx': 'RPX',
            'wahana': 'Wahana',
            'ninja': 'Ninja Xpress',
            'lion': 'Lion Parcel',
            'ide': 'IDE'
        };
        return courierNames[courierCode] || courierCode;
    }

    // Update fungsi processOrder untuk handle data kurir
    function processOrder(orderId, courier, trackingNumber) {
        // Validasi tambahan
        if (!courier) {
            showAlert('error', 'Pilih kurir pengiriman terlebih dahulu');
            return;
        }

        if (!trackingNumber) {
            showAlert('error', 'Masukkan nomor resi terlebih dahulu');
            return;
        }

        // Tampilkan loading
        showAlert('info', 'Memproses pengiriman...');

        fetch(`/orders/${orderId}/process`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                courier: courier,
                tracking_number: trackingNumber,
                processed_at: new Date().toISOString()
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert('error', data.message || 'Terjadi kesalahan saat memproses pesanan');
            }
        })
        .catch(error => {
            console.error('Error processing order:', error);
            showAlert('error', 'Terjadi kesalahan saat memproses pesanan');
        });
    }

    // Tambahkan event listener untuk modal process
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan event listener untuk confirmProcess sudah ada
        const confirmProcessBtn = document.getElementById('confirmProcess');
        if (confirmProcessBtn) {
            // Hapus event listener lama jika ada
            confirmProcessBtn.replaceWith(confirmProcessBtn.cloneNode(true));

            // Tambahkan event listener baru
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
        }

        // Inisialisasi tooltip untuk informasi kurir (jika menggunakan Bootstrap tooltip)
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Helper function untuk format kurir (optional)
    function formatCourierForDisplay(courierData) {
        if (!courierData) return 'Belum dipilih';

        if (typeof courierData === 'string') {
            return getCourierName(courierData);
        }

        if (Array.isArray(courierData)) {
            return courierData.map(courier => getCourierName(courier.code || courier)).join(', ');
        }

        return 'Format tidak valid';
    }
</script>
@endsection
