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
                <button class="btn btn-outline-primary btn-sm" onclick="generateReport()">
                    <i class="fas fa-download me-1"></i> Download Report
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom shadow h-100 py-2"
                style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Produk Saya</div>
                            <div class="h5 mb-0 font-weight-bold text-white">{{ $totalProducts }}</div>
                            <small class="text-white">
                                @php
                                    $activePercentage = $totalProducts > 0 ? round(($activeProducts / $totalProducts) * 100) : 0;
                                @endphp
                                {{ $activePercentage }}% produk aktif
                            </small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-white" data-toggle="modal" data-target="#iconModal"
                                data-icon="fa-box" data-title="Produk"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom shadow h-100 py-2"
                style="background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Pesanan Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-white">67</div>
                            <small class="text-white">12 menunggu konfirmasi</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-white" data-toggle="modal" data-target="#iconModal"
                                data-icon="fa-shopping-cart" data-title="Pesanan Masuk"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom shadow h-100 py-2"
                style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Pesanan Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-white">42</div>
                            <small class="text-white">8 dalam pengiriman</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-white" data-toggle="modal" data-target="#iconModal"
                                data-icon="fa-truck" data-title="Pesanan Keluar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom shadow h-100 py-2"
                style="background: linear-gradient(135deg, #d4a017 0%, #b8860b 100%);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Pembayaran & Fee</div>
                            <div class="h5 mb-0 font-weight-bold text-white">Rp 18.250.000</div>
                            <small class="text-white">Bersih setelah potongan</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-white" data-toggle="modal" data-target="#iconModal"
                                data-icon="fa-money-bill-wave" data-title="Pembayaran & Fee"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Pendapatan (Juta Rupiah)</h6>
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
                            <div class="activity-icon bg-primary-light rounded-circle p-2 me-3"
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-shopping-cart text-primary" data-bs-toggle="modal" data-bs-target="#iconModal"
                                    data-icon="fa-shopping-cart" data-title="Pesanan Baru"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Pesanan baru #ORD-0012</p>
                                <small class="text-muted">2 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex mb-3">
                            <div class="activity-icon bg-success-light rounded-circle p-2 me-3"
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-money-bill-wave text-success" data-bs-toggle="modal" data-bs-target="#iconModal"
                                    data-icon="fa-money-bill-wave" data-title="Pembayaran Diterima"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Pembayaran diterima dari #ORD-0008</p>
                                <small class="text-muted">1 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex mb-3">
                            <div class="activity-icon bg-warning-light rounded-circle p-2 me-3"
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-box text-warning" data-bs-toggle="modal" data-bs-target="#iconModal"
                                    data-icon="fa-box" data-title="Stok Produk"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-bold">Stok produk "Sepatu Sport" hampir habis</p>
                                <small class="text-muted">3 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex">
                            <div class="activity-icon bg-danger-light rounded-circle p-2 me-3"
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-exclamation-triangle text-danger" data-bs-toggle="modal"
                                    data-bs-target="#iconModal" data-icon="fa-exclamation-triangle"
                                    data-title="Pesanan Dibatalkan"></i>
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
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Produk Terbaru</h6>
                    <div>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-list me-1"></i> Lihat Semua
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="bulkDeleteProducts()" id="bulkDeleteBtn"
                            style="display: none;">
                            <i class="fas fa-trash me-1"></i> Hapus Terpilih
                        </button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Filter & Search Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card card-custom">
                                <div class="card-body p-3">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Kategori</label>
                                            <select class="form-select" id="categoryFilter">
                                                <option value="all" selected>Semua Kategori</option>
                                                <option value="Sepatu & Sandal">Sepatu & Sandal</option>
                                                <option value="Pakaian">Pakaian</option>
                                                <option value="Elektronik">Elektronik</option>
                                                <option value="Aksesoris">Aksesoris</option>
                                                <option value="Makanan & Minuman">Makanan & Minuman</option>
                                                <option value="Kesehatan & Kecantikan">Kesehatan & Kecantikan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Status</label>
                                            <select class="form-select" id="statusFilter">
                                                <option value="all" selected>Semua Status</option>
                                                <option value="active">Aktif</option>
                                                <option value="low_stock">Stok Sedikit</option>
                                                <option value="out_of_stock">Stok Habis</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Pencarian</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchInput"
                                                    placeholder="Cari produk...">
                                                <button class="btn btn-outline-primary" type="button" id="searchButton">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-outline-secondary w-100" id="resetFilters">
                                                <i class="fas fa-refresh me-2"></i>Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th width="40">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th width="50">No</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                                @forelse ($recentProducts as $product)
                                    <tr class="product-row" id="product-row-{{ $product->id }}">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input product-checkbox" type="checkbox" value="{{ $product->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($product->image)
                                                    <img src="{{ Storage::disk('public')->exists($product->image) ? asset('storage/' . $product->image) : 'https://via.placeholder.com/40' }}"
                                                        alt="{{ $product->name }}" class="rounded me-3"
                                                        style="width: 40px; height: 40px; object-fit: cover;"
                                                        onerror="this.src='https://via.placeholder.com/40'">
                                                @else
                                                    <img src="https://via.placeholder.com/40" alt="No Image"
                                                        class="rounded me-3"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $product->name }}</strong><br>
                                                    <small class="text-muted">{{ $product->sku ?? 'SKU-' . $product->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->category }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="fw-bold {{ $product->stock == 0 ? 'text-danger' : ($product->stock <= 10 ? 'text-warning' : '') }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($product->stock == 0)
                                                <span class="badge bg-danger">Stok Habis</span>
                                            @elseif ($product->stock <= 10)
                                                <span class="badge bg-warning">Stok Menipis</span>
                                            @else
                                                <span class="badge bg-success">Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="openEditModal({{ $product->id }})" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger ms-1"
                                                onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak ada produk yang ditemukan</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- No Results Message -->
                    <div id="noResults" class="text-center py-5 d-none">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada produk yang ditemukan</h5>
                        <p class="text-muted">Coba ubah filter pencarian Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Icons -->
    <div class="modal fade" id="iconModal" tabindex="-1" aria-labelledby="iconModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iconModalLabel">Informasi Ikon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-icon-placeholder fa-4x mb-3 text-primary"></i>
                    <h4 id="iconTitle" class="mb-3">Judul Ikon</h4>
                    <p id="iconDescription">Deskripsi akan muncul di sini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editProductId" name="id">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" id="editProductName" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" id="editProductCategory" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Sepatu & Sandal">Sepatu & Sandal</option>
                                    <option value="Pakaian">Pakaian</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                    <option value="Makanan & Minuman">Makanan & Minuman</option>
                                    <option value="Kesehatan & Kecantikan">Kesehatan & Kecantikan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="editProductPrice" name="price" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input type="number" id="editProductStock" name="stock" class="form-control"
                                        required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="editProductDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                <div id="currentImage" class="mt-2"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Update Produk</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                    </div>
                    <h5 class="mb-3">Anda Yakin Ingin Menghapus Data Ini?</h5>
                    <p class="text-muted" id="deleteProductInfo">Produk: <span id="productNameToDelete"></span></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tidak
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" onclick="executeDelete()">
                        <i class="fas fa-check me-2"></i>Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stat-card-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
        }

        .stat-card-success {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%) !important;
        }

        .stat-card-warning {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%) !important;
        }

        .stat-card-danger {
            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%) !important;
        }

        .stat-card.text-white .stat-number,
        .stat-card.text-white .stat-title {
            color: white !important;
        }

        .stat-card.text-white .stat-icon {
            color: white !important;
            opacity: 0.9;
        }

        .bg-white-20 {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        .product-row {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-row:hover {
            background-color: #f8f9fa;
        }

        .card-custom {
            border: none;
            border-radius: 10px;
        }

        .table-custom th {
            border-top: none;
            font-weight: 600;
            color: #6c757d;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            vertical-align: middle;
            padding: 12px 8px;
        }

        .form-check-input:checked {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        /* Success Toast Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            border: none;
        }

        .toast-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
        }

        .toast-error {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .toast-info {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        /* Smooth transitions for filter changes */
        #productsTableBody {
            transition: opacity 0.3s ease;
        }

        #productsTableBody.loading {
            opacity: 0.6;
            pointer-events: none;
        }

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
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Data untuk chart pendapatan dari PHP
        const revenueData = @json($revenueData);
        let productToDelete = null;
        let currentFilterTimeout = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize chart
            initializeChart();

            // Icon Modal Handler
            const iconModal = document.getElementById('iconModal');
            if (iconModal) {
                iconModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const iconClass = button.getAttribute('data-icon');
                    const iconTitle = button.getAttribute('data-title');

                    const modal = this;
                    modal.querySelector('.fa-icon-placeholder').className = `fas ${iconClass} fa-4x mb-3 text-primary`;
                    modal.querySelector('#iconTitle').textContent = iconTitle;

                    let description = '';
                    switch (iconClass) {
                        case 'fa-box':
                            description = 'Ikon ini mewakili jumlah produk yang tersedia di toko Anda.';
                            break;
                        case 'fa-shopping-cart':
                            description = 'Ikon ini menunjukkan jumlah pesanan masuk yang belum diproses.';
                            break;
                        case 'fa-money-bill-wave':
                            description = 'Ikon ini menunjukkan total pendapatan dan biaya yang telah diterima.';
                            break;
                        case 'fa-star':
                            description = 'Ikon ini menunjukkan rating toko berdasarkan ulasan pelanggan.';
                            break;
                        case 'fa-exclamation-triangle':
                            description = 'Ikon ini menandakan adanya masalah atau peringatan yang perlu perhatian.';
                            break;
                        default:
                            description = 'Ikon ini memberikan informasi tentang aktivitas terbaru di toko Anda.';
                    }
                    modal.querySelector('#iconDescription').textContent = description;
                });
            }

            // Filter functionality
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const resetFilters = document.getElementById('resetFilters');

            // Event listeners for filters
            if (categoryFilter) categoryFilter.addEventListener('change', filterProducts);
            if (statusFilter) statusFilter.addEventListener('change', filterProducts);

            // Gunakan debounce untuk search input
            const debouncedFilter = debounce(filterProducts, 500);
            if (searchInput) searchInput.addEventListener('input', debouncedFilter);
            if (searchButton) searchButton.addEventListener('click', filterProducts);

            if (resetFilters) resetFilters.addEventListener('click', function() {
                categoryFilter.value = 'all';
                statusFilter.value = 'all';
                searchInput.value = '';
                filterProducts();
            });

            // Select all checkboxes
            const selectAll = document.getElementById('selectAll');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.product-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateBulkDeleteButton();
                });
            }

            // Attach event listeners to dynamically created checkboxes
            document.addEventListener('change', '.product-checkbox', updateBulkDeleteButton);
        });

        function initializeChart() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;

            const chartCtx = ctx.getContext('2d');

            const gradient = chartCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(78, 115, 223, 0.5)');
            gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');

            const data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Juta Rupiah)',
                    data: Object.values(revenueData),
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

            new Chart(chartCtx, {
                type: 'line',
                data: data,
                options: options
            });
        }

        // Utility Functions
        function getStatusBadge(stock) {
            if (stock == 0) {
                return '<span class="badge bg-danger">Stok Habis</span>';
            } else if (stock <= 10) {
                return '<span class="badge bg-warning">Stok Menipis</span>';
            } else {
                return '<span class="badge bg-success">Aktif</span>';
            }
        }

        function formatPrice(price) {
            return 'Rp ' + parseInt(price).toLocaleString('id-ID');
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        // Debounce function untuk search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Filter Products dengan AJAX
        function filterProducts() {
            const categoryValue = document.getElementById('categoryFilter').value;
            const statusValue = document.getElementById('statusFilter').value;
            const searchValue = document.getElementById('searchInput').value;

            // Clear previous timeout jika ada
            if (currentFilterTimeout) {
                clearTimeout(currentFilterTimeout);
            }

            // Langsung kosongkan tabel sementara
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = '';

            // AJAX request untuk filter
            fetch(`/dashboard/products/filter?category=${categoryValue}&status=${statusValue}&search=${searchValue}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateProductsTable(data.products);
                        updateStats(data.stats);

                        // Jika tidak ada hasil, tampilkan pesan info
                        if (data.products.length === 0) {
                            showToast('Tidak ada produk yang ditemukan untuk filter yang dipilih', 'info');
                        }
                    } else {
                        showToast(data.message || 'Gagal memfilter produk', 'error');
                        updateProductsTable([]);
                        updateStats({
                            total: 0,
                            active: 0,
                            low_stock: 0,
                            out_of_stock: 0
                        });
                    }
                })
                .catch(error => {
                    console.error('Filter Error:', error);

                    // Tampilkan error yang lebih spesifik
                    let errorMessage = 'Terjadi kesalahan saat memfilter produk';
                    if (error.message.includes('Failed to fetch')) {
                        errorMessage = 'Koneksi internet bermasalah';
                    }

                    showToast(errorMessage, 'error');
                    updateProductsTable([]);
                    updateStats({
                        total: 0,
                        active: 0,
                        low_stock: 0,
                        out_of_stock: 0
                    });
                });
        }

        function updateProductsTable(products) {
            const productsTableBody = document.getElementById('productsTableBody');
            const noResults = document.getElementById('noResults');

            productsTableBody.innerHTML = '';

            if (products.length === 0) {
                noResults.classList.remove('d-none');
                return;
            }

            noResults.classList.add('d-none');

            products.forEach((product, index) => {
                const statusBadge = getStatusBadge(product.stock);
                const stockClass = product.stock === 0 ? 'text-danger' : (product.stock <= 10 ? 'text-warning' : '');

                const row = document.createElement('tr');
                row.className = 'product-row';
                row.id = `product-row-${product.id}`;

                row.innerHTML = `
                    <td>
                        <div class="form-check">
                            <input class="form-check-input product-checkbox" type="checkbox" value="${product.id}">
                        </div>
                    </td>
                    <td>${index + 1}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="/storage/${product.image}" alt="${product.name}"
                                class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;"
                                onerror="this.src='https://via.placeholder.com/40'">
                            <div>
                                <strong>${product.name}</strong><br>
                                <small class="text-muted">${product.sku || '-'}</small>
                            </div>
                        </div>
                    </td>
                    <td>${product.category}</td>
                    <td>${formatPrice(product.price)}</td>
                    <td>
                        <span class="fw-bold ${stockClass}">${product.stock}</span>
                    </td>
                    <td>${statusBadge}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(${product.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger ms-1" onclick="confirmDelete(${product.id}, '${product.name}')" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                productsTableBody.appendChild(row);
            });
        }

        function updateStats(stats) {
            // Update hanya stat card "Produk Saya" dengan data real dari database
            const produkSayaCard = document.querySelector('.card-custom:first-child');
            if (produkSayaCard) {
                produkSayaCard.querySelector('.h5').textContent = stats.total;
                const activePercentage = stats.total > 0 ? Math.round((stats.active / stats.total) * 100) : 0;
                produkSayaCard.querySelector('small').textContent = `${activePercentage}% produk aktif`;
            }
        }

        function updateBulkDeleteButton() {
            const selectedCount = document.querySelectorAll('.product-checkbox:checked').length;
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

            if (selectedCount > 0) {
                bulkDeleteBtn.style.display = 'block';
                bulkDeleteBtn.innerHTML = `<i class="fas fa-trash me-1"></i> Hapus ${selectedCount} Item`;
            } else {
                bulkDeleteBtn.style.display = 'none';
            }
        }

        // Edit Product Modal
        window.openEditModal = function(productId) {
            fetch(`/dashboard/products/${productId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(product => {
                    const form = document.getElementById('editProductForm');
                    form.action = `/dashboard/products/${product.id}`;

                    document.getElementById('editProductId').value = product.id;
                    document.getElementById('editProductName').value = product.name;
                    document.getElementById('editProductCategory').value = product.category;
                    document.getElementById('editProductPrice').value = product.price;
                    document.getElementById('editProductStock').value = product.stock;
                    document.getElementById('editProductDescription').value = product.description || '';

                    const currentImageDiv = document.getElementById('currentImage');
                    if (product.image) {
                        currentImageDiv.innerHTML = `
                        <strong>Gambar Saat Ini:</strong><br>
                        <img src="/storage/${product.image}" alt="Current Image"
                            style="max-width: 100px; max-height: 100px; object-fit: cover;"
                            class="mt-1 rounded">
                    `;
                    } else {
                        currentImageDiv.innerHTML = '<strong>Gambar Saat Ini:</strong> Tidak ada gambar';
                    }

                    const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Gagal memuat data produk', 'error');
                });
        }

        // Function untuk submit form edit - TANPA JEDA
        window.submitEditForm = function() {
            const form = document.getElementById('editProductForm');
            const formData = new FormData(form);
            const productId = document.getElementById('editProductId').value;

            const submitBtn = document.querySelector('#editProductModal .btn-primary');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...';
            submitBtn.disabled = true;

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                const editModal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
                if (editModal) {
                    editModal.hide();
                }

                if (data.success) {
                    showToast('Produk berhasil diperbarui', 'success');

                    // LANGSUNG UPDATE DATA DI TABEL TANPA JEDA
                    updateProductRowInTable(productId, {
                        name: document.getElementById('editProductName').value,
                        category: document.getElementById('editProductCategory').value,
                        price: document.getElementById('editProductPrice').value,
                        stock: document.getElementById('editProductStock').value,
                        description: document.getElementById('editProductDescription').value
                    });

                } else {
                    showToast(data.message || 'Gagal memperbarui produk', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showToast('Terjadi kesalahan saat memperbarui produk', 'error');
            });
        }

        // Function untuk langsung update row di tabel
        function updateProductRowInTable(productId, productData) {
            const row = document.getElementById(`product-row-${productId}`);
            if (row) {
                // Update nama produk
                const nameElement = row.querySelector('strong');
                if (nameElement) {
                    nameElement.textContent = productData.name;
                }

                // Update kategori
                const categoryCell = row.cells[3];
                if (categoryCell) {
                    categoryCell.textContent = productData.category;
                }

                // Update harga
                const priceCell = row.cells[4];
                if (priceCell) {
                    priceCell.textContent = formatPrice(productData.price);
                }

                // Update stok dan status
                const stockCell = row.cells[5];
                const statusCell = row.cells[6];
                if (stockCell && statusCell) {
                    const stockSpan = stockCell.querySelector('span');
                    if (stockSpan) {
                        stockSpan.textContent = productData.stock;

                        // Update class untuk warna stok
                        stockSpan.className = 'fw-bold ' +
                            (productData.stock == 0 ? 'text-danger' :
                             (productData.stock <= 10 ? 'text-warning' : ''));
                    }

                    // Update status badge
                    statusCell.innerHTML = getStatusBadge(productData.stock);
                }
            }
        }

        // Delete Confirmation
        window.confirmDelete = function(productId, productName) {
            productToDelete = productId;
            document.getElementById('productNameToDelete').textContent = productName;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteModal.show();
        }

        // Execute Delete Function - PERBAIKAN UTAMA
        window.executeDelete = function() {
            if (!productToDelete) {
                showToast('Tidak ada produk yang dipilih untuk dihapus', 'error');
                return;
            }

            // Tampilkan loading state pada tombol
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const originalText = confirmDeleteBtn.innerHTML;
            confirmDeleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';
            confirmDeleteBtn.disabled = true;

            fetch(`/dashboard/products/${productToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Reset tombol
                confirmDeleteBtn.innerHTML = originalText;
                confirmDeleteBtn.disabled = false;

                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                if (deleteModal) {
                    deleteModal.hide();
                }

                if (data.success) {
                    showToast('Produk berhasil dihapus', 'success');
                    // LANGSUNG hapus row dari tabel TANPA JEDA
                    const row = document.getElementById(`product-row-${productToDelete}`);
                    if (row) {
                        row.remove();
                    }
                    // Update stats langsung
                    updateStatsAfterDelete();
                    // Reset productToDelete
                    productToDelete = null;
                } else {
                    showToast(data.message || 'Gagal menghapus produk', 'error');
                }
            })
            .catch(error => {
                // Reset tombol
                confirmDeleteBtn.innerHTML = originalText;
                confirmDeleteBtn.disabled = false;
                showToast('Terjadi kesalahan saat menghapus produk', 'error');
                console.error('Delete error:', error);
            });
        }

        // Update stats setelah delete
        function updateStatsAfterDelete() {
            const produkSayaCard = document.querySelector('.card-custom:first-child');
            if (produkSayaCard) {
                const currentTotal = parseInt(produkSayaCard.querySelector('.h5').textContent);
                produkSayaCard.querySelector('.h5').textContent = currentTotal - 1;

                // Update persentase
                const activeProducts = parseInt(document.querySelector('.card-custom:nth-child(2) .h5').textContent);
                const newTotal = currentTotal - 1;
                const activePercentage = newTotal > 0 ? Math.round((activeProducts / newTotal) * 100) : 0;
                produkSayaCard.querySelector('small').textContent = `${activePercentage}% produk aktif`;
            }
        }

        // Bulk Delete Products
        function bulkDeleteProducts() {
            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            const productIds = Array.from(selectedProducts).map(checkbox => parseInt(checkbox.value));

            if (productIds.length === 0) {
                showToast('Tidak ada produk yang dipilih', 'warning');
                return;
            }

            if (!confirm(`Anda yakin ingin menghapus ${productIds.length} produk?`)) {
                return;
            }

            fetch('/dashboard/products/bulk-delete', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ product_ids: productIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(`${productIds.length} produk berhasil dihapus`, 'success');
                        // Langsung hapus rows dari tabel
                        productIds.forEach(productId => {
                            const row = document.getElementById(`product-row-${productId}`);
                            if (row) {
                                row.remove();
                            }
                        });
                        // Update stats
                        updateBulkStatsAfterDelete(productIds.length);
                    } else {
                        showToast('Gagal menghapus produk', 'error');
                    }
                })
                .catch(error => {
                    showToast('Terjadi kesalahan saat menghapus produk', 'error');
                });
        }

        // Update stats setelah bulk delete
        function updateBulkStatsAfterDelete(deletedCount) {
            const produkSayaCard = document.querySelector('.card-custom:first-child');
            if (produkSayaCard) {
                const currentTotal = parseInt(produkSayaCard.querySelector('.h5').textContent);
                produkSayaCard.querySelector('.h5').textContent = currentTotal - deletedCount;

                // Update persentase
                const activeProducts = parseInt(document.querySelector('.card-custom:nth-child(2) .h5').textContent);
                const newTotal = currentTotal - deletedCount;
                const activePercentage = newTotal > 0 ? Math.round((activeProducts / newTotal) * 100) : 0;
                produkSayaCard.querySelector('small').textContent = `${activePercentage}% produk aktif`;
            }
        }

        // Enhanced Toast notification function
        function showToast(message, type = 'info') {
            const existingToasts = document.querySelectorAll('.toast-container');
            existingToasts.forEach(toast => toast.remove());

            const toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container';

            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');

            const icon = type === 'success' ? 'fa-check-circle' :
                        type === 'error' ? 'fa-exclamation-triangle' : 'fa-info-circle';

            toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas ${icon} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

            toastContainer.appendChild(toast);
            document.body.appendChild(toastContainer);

            const bsToast = new bootstrap.Toast(toast, {
                autohide: true,
                delay: 3000
            });
            bsToast.show();

            toast.addEventListener('hidden.bs.toast', () => {
                toastContainer.remove();
            });
        }

        // Generate Report Function
        function generateReport() {
            Swal.fire({
                title: 'Membuat Laporan',
                text: 'Sedang memproses laporan Anda...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF('p', 'mm', 'a4');

                doc.setFillColor(78, 115, 223);
                doc.rect(0, 0, 210, 30, 'F');

                doc.setTextColor(255, 255, 255);
                doc.setFontSize(20);
                doc.text('TOKO ONLINE UMKM', 105, 15, {
                    align: 'center'
                });

                doc.setFontSize(12);
                doc.text('LAPORAN DASHBOARD PERFORMANCE', 105, 22, {
                    align: 'center'
                });

                doc.setTextColor(0, 0, 0);
                doc.setFontSize(10);
                doc.text(`Dibuat pada: ${new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            })}`, 105, 35, {
                    align: 'center'
                });

                doc.setFontSize(14);
                doc.text('RINGKASAN PERFORMANCE', 15, 50);

                doc.setFontSize(10);
                const statsData = [
                    ['Metrik', 'Nilai', 'Keterangan'],
                    ['Total Produk', '{{ $totalProducts }} item', 'Total produk aktif'],
                    ['Pesanan Masuk', '67 item', 'Pesanan dari pembeli'],
                    ['Pesanan Keluar', '42 item', 'Pesanan yang dikirim'],
                    ['Pembayaran', 'Rp 18.250.000', 'Bersih setelah potongan']
                ];

                let yPosition = 60;

                statsData.forEach((row, index) => {
                    if (index === 0) {
                        doc.setFillColor(78, 115, 223);
                        doc.rect(15, yPosition - 5, 180, 8, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.setFont(undefined, 'bold');
                    } else {
                        doc.setTextColor(0, 0, 0);
                        doc.setFont(undefined, 'normal');
                    }

                    doc.setDrawColor(200, 200, 200);
                    doc.rect(15, yPosition - 5, 180, 8);
                    doc.rect(15, yPosition - 5, 60, 8);
                    doc.rect(75, yPosition - 5, 50, 8);
                    doc.rect(125, yPosition - 5, 70, 8);

                    doc.text(row[0], 20, yPosition);
                    doc.text(row[1], 80, yPosition);
                    doc.text(row[2], 130, yPosition);
                    yPosition += 8;
                });

                yPosition += 10;
                doc.setFontSize(14);
                doc.text('DATA PENDAPATAN BULANAN (Juta Rupiah)', 15, yPosition);

                yPosition += 10;
                doc.setFontSize(10);
                const revenueDataTable = [
                    ['Bulan', 'Pendapatan'],
                    ['Januari', 'Rp ' + (revenueData[1] || 0)],
                    ['Februari', 'Rp ' + (revenueData[2] || 0)],
                    ['Maret', 'Rp ' + (revenueData[3] || 0)],
                    ['April', 'Rp ' + (revenueData[4] || 0)],
                    ['Mei', 'Rp ' + (revenueData[5] || 0)],
                    ['Juni', 'Rp ' + (revenueData[6] || 0)],
                    ['Juli', 'Rp ' + (revenueData[7] || 0)],
                    ['Agustus', 'Rp ' + (revenueData[8] || 0)],
                    ['September', 'Rp ' + (revenueData[9] || 0)],
                    ['Oktober', 'Rp ' + (revenueData[10] || 0)],
                    ['November', 'Rp ' + (revenueData[11] || 0)],
                    ['Desember', 'Rp ' + (revenueData[12] || 0)]
                ];

                revenueDataTable.forEach((row, index) => {
                    if (index === 0) {
                        doc.setFillColor(78, 115, 223);
                        doc.rect(15, yPosition - 5, 180, 8, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.setFont(undefined, 'bold');
                    } else {
                        doc.setTextColor(0, 0, 0);
                        doc.setFont(undefined, 'normal');
                    }

                    doc.setDrawColor(200, 200, 200);
                    doc.rect(15, yPosition - 5, 180, 8);
                    doc.rect(15, yPosition - 5, 90, 8);
                    doc.rect(105, yPosition - 5, 90, 8);

                    doc.text(row[0], 20, yPosition);
                    doc.text(row[1], 110, yPosition);
                    yPosition += 8;

                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                yPosition += 10;
                doc.setFontSize(14);
                doc.text('PRODUK TERBARU', 15, yPosition);

                yPosition += 10;
                doc.setFontSize(8);
                const productsData = [
                    ['No', 'Nama Produk', 'Kategori', 'Harga', 'Stok', 'Status'],
                    ...@json($recentProducts).slice(0, 10).map((product, index) => [
                        (index + 1).toString(),
                        product.name.length > 20 ? product.name.substring(0, 20) + '...' : product.name,
                        product.category,
                        `Rp ${parseInt(product.price).toLocaleString('id-ID')}`,
                        product.stock,
                        product.stock > 10 ? 'Aktif' : product.stock > 0 ? 'Stok Sedikit' : 'Habis'
                    ])
                ];

                productsData.forEach((row, index) => {
                    if (index === 0) {
                        doc.setFillColor(78, 115, 223);
                        doc.rect(15, yPosition - 5, 180, 8, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.setFont(undefined, 'bold');
                    } else {
                        doc.setTextColor(0, 0, 0);
                        doc.setFont(undefined, 'normal');
                    }

                    doc.setDrawColor(200, 200, 200);
                    doc.rect(15, yPosition - 5, 180, 8);
                    doc.rect(15, yPosition - 5, 10, 8);
                    doc.rect(25, yPosition - 5, 50, 8);
                    doc.rect(75, yPosition - 5, 30, 8);
                    doc.rect(105, yPosition - 5, 35, 8);
                    doc.rect(140, yPosition - 5, 20, 8);
                    doc.rect(160, yPosition - 5, 35, 8);

                    doc.text(row[0], 17, yPosition);
                    doc.text(row[1], 27, yPosition);
                    doc.text(row[2], 77, yPosition);
                    doc.text(row[3], 107, yPosition);
                    doc.text(row[4], 142, yPosition);
                    doc.text(row[5], 162, yPosition);
                    yPosition += 8;

                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                yPosition += 10;
                doc.setFontSize(12);
                doc.text('ANALISIS PERFORMANCE:', 15, yPosition);

                doc.setFontSize(10);
                const analysis = [
                    '• Total produk aktif: {{ $totalProducts }} item',
                    '• Pesanan masuk: 67 item (12 menunggu konfirmasi)',
                    '• Pesanan keluar: 42 item (8 dalam pengiriman)',
                    '• Total pendapatan bersih: Rp 18.250.000',
                    '• Rekomendasi: Tingkatkan promosi untuk produk stok menipis'
                ];

                yPosition += 8;
                analysis.forEach(item => {
                    doc.text(item, 20, yPosition, {
                        maxWidth: 170
                    });
                    yPosition += 6;

                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                const pageCount = doc.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(100, 100, 100);
                    doc.text(`Halaman ${i} dari ${pageCount}`, 105, 290, {
                        align: 'center'
                    });
                    doc.text('Laporan ini dibuat otomatis oleh sistem', 105, 295, {
                        align: 'center'
                    });
                }

                setTimeout(() => {
                    doc.save(`Laporan-Performance-${new Date().toISOString().slice(0,10)}.pdf`);

                    Swal.close();

                    Swal.fire({
                        icon: 'success',
                        title: 'Laporan Berhasil Diunduh',
                        text: 'Laporan dashboard telah berhasil diunduh dalam format PDF.',
                        confirmButtonText: 'OK'
                    });
                }, 1000);

            } catch (error) {
                console.error('Error in generateReport:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal membuat laporan. Silakan coba lagi.',
                    confirmButtonText: 'OK'
                });
            }
        }
    </script>
@endsection
