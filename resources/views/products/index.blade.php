@extends('layouts.app')

@section('title', 'Produk Saya - Toko Online UMKM')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h3 mb-0">Produk Saya</h1>
                    <p class="mb-0 text-muted">Kelola produk toko online Anda</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-plus me-2"></i>Tambah Produk
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body p-4">
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

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-custom shadow stat-card-primary">
                    <div class="card-body stat-card text-white p-4">
                        <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                            <i class="fas fa-box text-white"></i>
                        </div>
                        <div class="stat-number">{{ $products->count() }}</div>
                        <div class="stat-title">Total Produk</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-custom shadow stat-card-success">
                    <div class="card-body stat-card text-white p-4">
                        <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                        <div class="stat-number">{{ $products->where('stock', '>', 10)->count() }}</div>
                        <div class="stat-title">Produk Aktif</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-custom shadow stat-card-warning">
                    <div class="card-body stat-card text-white p-4">
                        <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                        <div class="stat-number">{{ $products->where('stock', '>', 0)->where('stock', '<=', 10)->count() }}
                        </div>
                        <div class="stat-title">Stok Menipis</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-custom shadow stat-card-danger">
                    <div class="card-body stat-card text-white p-4">
                        <div class="stat-icon bg-white-20 rounded-circle p-3 mb-3">
                            <i class="fas fa-times-circle text-white"></i>
                        </div>
                        <div class="stat-number">{{ $products->where('stock', 0)->count() }}</div>
                        <div class="stat-title">Stok Habis</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-custom shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-cog me-2"></i>Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-export me-2"></i>Export
                                        Data</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th width="50" class="ps-4">No</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Tags</th>
                                        <th>Tanggal Ditambah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    @forelse ($products as $product)
                                        <tr class="product-row">
                                            <td class="ps-4">{{ $loop->iteration }}</td>
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
                                                        <small
                                                            class="text-muted">{{ $product->sku ?? 'SKU-' . $product->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $product->category }}</td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if ($product->status == 'out_of_stock')
                                                    <span class="badge bg-danger">Stok Habis</span>
                                                @elseif ($product->status == 'low_stock')
                                                    <span class="badge bg-warning">Stok Menipis</span>
                                                @else
                                                    <span class="badge bg-success">Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->tags)
                                                    @php
                                                        $tagsArray = explode(',', $product->tags);
                                                    @endphp
                                                    @foreach (array_slice($tagsArray, 0, 2) as $tag)
                                                        <span class="product-tag">{{ trim($tag) }}</span>
                                                    @endforeach
                                                    @if (count($tagsArray) > 2)
                                                        <span class="product-tag">+{{ count($tagsArray) - 2 }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="openEditModal({{ $product->id }})" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger ms-1"
                                                    onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
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

                        <!-- Pagination -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center" id="productsPagination">
                                <!-- Pagination akan diisi oleh JavaScript -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" action="{{ route('products.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Masukkan nama produk" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="category" required>
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
                                    <input type="number" name="price" class="form-control" placeholder="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga Asli</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="original_price" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stock" class="form-control" placeholder="0" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Tags</label>
                                <input type="text" name="tags" class="form-control"
                                    placeholder="Pisahkan dengan koma, contoh: trending, baru, diskon">
                                <small class="text-muted">Masukkan tags untuk produk, pisahkan dengan koma</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Deskripsi produk"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="addProductForm" class="btn btn-primary">Simpan Produk</button>
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
                                <label class="form-label">Harga Asli</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="editProductOriginalPrice" name="original_price"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input type="number" id="editProductStock" name="stock" class="form-control"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Tags</label>
                                <input type="text" id="editProductTags" name="tags" class="form-control"
                                    placeholder="Pisahkan dengan koma">
                                <small class="text-muted">Masukkan tags untuk produk, pisahkan dengan koma</small>
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
                    <button type="submit" form="editProductForm" class="btn btn-primary">Update Produk</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-check me-2"></i>Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .product-tag {
            display: inline-block;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            padding: 4px 12px;
            margin: 2px;
            font-size: 0.8rem;
            color: #6c757d;
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

        /* Pagination Styles */
        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-color: #4e73df;
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.3);
            transform: translateY(-1px);
        }

        .pagination .page-link {
            color: #4e73df;
            border: 1px solid #e3e6f0;
            padding: 8px 16px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            min-width: 45px;
            text-align: center;
        }

        .pagination .page-link:hover {
            background-color: #f8f9fc;
            border-color: #4e73df;
            color: #224abe;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pagination .page-item.disabled .page-link {
            color: #b7b9cc;
            background-color: #f8f9fc;
            border-color: #e3e6f0;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
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
    </style>
@endsection

@section('scripts')
    <script>
        let currentPage = 1;
        const productsPerPage = 10;
        let productToDelete = null;
        let currentFilterTimeout = null;

        // Utility Functions
        function getStatusBadge(status) {
            switch (status) {
                case 'active':
                    return '<span class="badge bg-success">Aktif</span>';
                case 'low_stock':
                    return '<span class="badge bg-warning">Stok Menipis</span>';
                case 'out_of_stock':
                    return '<span class="badge bg-danger">Stok Habis</span>';
                default:
                    return '<span class="badge bg-secondary">Tidak Diketahui</span>';
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

        function formatTags(tags) {
            if (!tags) return '<span class="text-muted">-</span>';

            const tagsArray = tags.split(',');
            let html = '';

            tagsArray.slice(0, 2).forEach(tag => {
                html += `<span class="product-tag">${tag.trim()}</span>`;
            });

            if (tagsArray.length > 2) {
                html += `<span class="product-tag">+${tagsArray.length - 2}</span>`;
            }

            return html;
        }

        // Filter Products dengan AJAX - NO LOADING VERSION
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
            fetch(`{{ route('products.filter') }}?category=${categoryValue}&status=${statusValue}&search=${searchValue}`)
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
                const statusBadge = getStatusBadge(product.status);
                const stockClass = product.stock === 0 ? 'text-danger' : (product.stock <= 10 ? 'text-warning' : '');

                const row = document.createElement('tr');
                row.className = 'product-row';

                row.innerHTML = `
                <td class="ps-4">${index + 1}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage') }}/${product.image}" alt="${product.name}"
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
                <td>${formatTags(product.tags)}</td>
                <td>${formatDate(product.created_at)}</td>
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
            const statNumbers = document.querySelectorAll('.stat-number');
            if (statNumbers.length >= 4) {
                statNumbers[0].textContent = stats.total;
                statNumbers[1].textContent = stats.active;
                statNumbers[2].textContent = stats.low_stock;
                statNumbers[3].textContent = stats.out_of_stock;
            }
        }

        // HAPUS function editProduct() yang duplikat di sini!
        // Hanya pakai window.openEditModal di bawah

        // Edit Product Modal
        window.openEditModal = function(productId) {
            fetch(`/products/${productId}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(product => {
                    // Set form action dengan route yang benar
                    const form = document.getElementById('editProductForm');
                    form.action = `/products/${product.id}`;

                    // Isi form edit dengan data produk
                    document.getElementById('editProductId').value = product.id;
                    document.getElementById('editProductName').value = product.name;
                    document.getElementById('editProductCategory').value = product.category;
                    document.getElementById('editProductPrice').value = product.price;
                    document.getElementById('editProductOriginalPrice').value = product.original_price || '';
                    document.getElementById('editProductStock').value = product.stock;
                    document.getElementById('editProductTags').value = product.tags || '';
                    document.getElementById('editProductDescription').value = product.description || '';

                    // Tampilkan gambar saat ini jika ada
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

                    // Show edit modal
                    const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Gagal memuat data produk', 'error');
                });
        }

        // Delete Confirmation
        window.confirmDelete = function(productId, productName) {
            productToDelete = productId;

            // Update modal content
            document.getElementById('productNameToDelete').textContent = productName;

            // Show delete confirmation modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteModal.show();
        }

        // Delete Product Function
        window.deleteProduct = function(productId) {
            fetch(`/products/${productId}`, {
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
                    // Hide delete modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                    if (deleteModal) {
                        deleteModal.hide();
                    }

                    if (data.success) {
                        showToast('Produk berhasil dihapus', 'success');
                        location.reload();
                    } else {
                        showToast('Gagal menghapus produk', 'error');
                    }
                })
                .catch(error => {
                    showToast('Terjadi kesalahan saat menghapus produk', 'error');
                });
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

        // Initialize event listeners when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const resetFilters = document.getElementById('resetFilters');

            if (categoryFilter) categoryFilter.addEventListener('change', filterProducts);
            if (statusFilter) statusFilter.addEventListener('change', filterProducts);

            const debouncedFilter = debounce(filterProducts, 500);
            if (searchInput) searchInput.addEventListener('input', debouncedFilter);
            if (searchButton) searchButton.addEventListener('click', filterProducts);

            if (resetFilters) resetFilters.addEventListener('click', function() {
                categoryFilter.value = 'all';
                statusFilter.value = 'all';
                searchInput.value = '';
                filterProducts();
            });

            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function() {
                    if (productToDelete) {
                        deleteProduct(productToDelete);
                    }
                });
            }
        });
    </script>
@endsection