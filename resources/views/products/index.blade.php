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
                                    <option value="sepatu">Sepatu & Sandal</option>
                                    <option value="pakaian">Pakaian</option>
                                    <option value="elektronik">Elektronik</option>
                                    <option value="aksesoris">Aksesoris</option>
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
                        <div class="stat-number">24</div>
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
                        <div class="stat-number">18</div>
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
                        <div class="stat-number">3</div>
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
                        <div class="stat-number">2</div>
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
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="rounded me-3"
                                                        style="width: 40px; height: 40px; object-fit: cover;">

                                                    <div>
                                                        <strong>{{ $product->name }}</strong><br>
                                                        <small class="text-muted">{{ $product->sku ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $product->category }}</td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if ($product->stock == 0)
                                                    <span class="badge bg-danger">Stok Habis</span>
                                                @elseif ($product->stock < 5)
                                                    <span class="badge bg-warning">Stok Menipis</span>
                                                @else
                                                    <span class="badge bg-success">Aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" onclick="openEditModal({{ $product->id }})" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger ms-1" onclick="deleteProduct({{ $product->id }})" title="Hapus">
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
                    <form id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama produk" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Fashion">Sepatu & Sandal</option>
                                    <option value="Elektronik">Aksesoris</option>
                                    <option value="Makanan">Elektronik</option>
                                    <option value="Kesehatan">Pakaian</option>
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
                                <label class="form-label">Stok</label>
                                <input type="number" name="stock" class="form-control" placeholder="0" required>
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

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="detailProductImage" src="" alt="Product Image" class="img-fluid rounded"
                                style="max-height: 400px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="detailProductName" class="mb-2"></h4>
                            <p class="text-muted mb-3" id="detailProductSKU"></p>

                            <div class="mb-3">
                                <span class="badge bg-primary me-2" id="detailProductCategory"></span>
                                <span class="badge" id="detailProductStatus"></span>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Harga:</strong>
                                    <div class="h5 text-primary" id="detailProductPrice"></div>
                                </div>
                                <div class="col-6">
                                    <strong>Stok Tersedia:</strong>
                                    <div class="h5" id="detailProductStock"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong>Deskripsi:</strong>
                                <p id="detailProductDescription" class="mt-2"></p>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <strong>Berat:</strong>
                                    <p id="detailProductWeight" class="mb-1"></p>
                                </div>
                                <div class="col-6">
                                    <strong>Dimensi:</strong>
                                    <p id="detailProductDimensions" class="mb-1"></p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong>Tanggal Ditambah:</strong>
                                <p id="detailProductDate" class="mb-1"></p>
                            </div>

                            <div class="mb-3">
                                <strong>Tags:</strong>
                                <div id="detailProductTags" class="mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

        /* Custom arrow styles */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            font-weight: 600;
            background-color: #f8f9fc;
        }

        .pagination .page-item:first-child .page-link:hover,
        .pagination .page-item:last-child .page-link:hover {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
        }

        /* Mobile responsive */
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 6px 12px;
                min-width: 40px;
                font-size: 0.875rem;
            }
        }

        /* Animation for page change */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        let currentPage = 1;
        const productsPerPage = 4;

        // Utility Functions
        function getStatusBadge(status) {
            switch (status) {
                case 'active':
                    return '<span class="badge bg-success badge-custom px-3 py-2">Aktif</span>';
                case 'low_stock':
                    return '<span class="badge bg-warning badge-custom px-3 py-2">Stok Sedikit</span>';
                case 'out_of_stock':
                    return '<span class="badge bg-danger badge-custom px-3 py-2">Stok Habis</span>';
                default:
                    return '<span class="badge bg-secondary badge-custom px-3 py-2">Tidak Aktif</span>';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'active':
                    return 'Aktif';
                case 'low_stock':
                    return 'Stok Sedikit';
                case 'out_of_stock':
                    return 'Stok Habis';
                default:
                    return 'Tidak Aktif';
            }
        }

        function getCategoryName(category) {
            switch (category) {
                case 'sepatu':
                    return 'Sepatu & Sandal';
                case 'pakaian':
                    return 'Pakaian';
                case 'elektronik':
                    return 'Elektronik';
                case 'aksesoris':
                    return 'Aksesoris';
                default:
                    return category;
            }
        }

        function formatPrice(price) {
            return parseInt(price).toLocaleString('id-ID');
        }

        // Global function for pagination
        window.changePage = function(page) {
            currentPage = page;

            // Get current filtered products
            const categoryValue = document.getElementById('categoryFilter').value;
            const statusValue = document.getElementById('statusFilter').value;
            const searchValue = document.getElementById('searchInput').value.toLowerCase();

            const filteredProducts = allProducts.filter(product => {
                const categoryMatch = categoryValue === 'all' || product.category === categoryValue;
                const statusMatch = statusValue === 'all' || product.status === statusValue;
                const searchMatch = product.name.toLowerCase().includes(searchValue) ||
                    product.sku.toLowerCase().includes(searchValue);

                return categoryMatch && statusMatch && searchMatch;
            });

            updateProductsTable(filteredProducts);
        };

        function updateProductsTable(products) {
            const startIndex = (currentPage - 1) * productsPerPage;
            const endIndex = startIndex + productsPerPage;
            const currentProducts = products.slice(startIndex, endIndex);

            const productsTableBody = document.getElementById('productsTableBody');
            const noResults = document.getElementById('noResults');

            productsTableBody.innerHTML = '';

            if (currentProducts.length === 0) {
                noResults.classList.remove('d-none');
                updatePagination(products.length);
                return;
            }

            noResults.classList.add('d-none');

            currentProducts.forEach((product, index) => {
                const rowNumber = startIndex + index + 1;
                const statusBadge = getStatusBadge(product.status);
                const stockClass = product.stock === 0 ? 'text-danger' : (product.stock <= 3 ? 'text-warning' : '');

                const row = document.createElement('tr');
                row.className = 'product-row';
                row.setAttribute('data-category', product.category);
                row.setAttribute('data-status', product.status);
                row.setAttribute('data-name', product.name);
                row.addEventListener('click', () => showProductDetail(product));

                row.innerHTML = `
                    <td class="ps-4">${rowNumber}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${product.image}" alt="${product.name}" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                            <div>
                                <div class="fw-bold">${product.name}</div>
                                <small class="text-muted">SKU: ${product.sku}</small>
                            </div>
                        </div>
                    </td>
                    <td>${getCategoryName(product.category)}</td>
                    <td>Rp ${formatPrice(product.price)}</td>
                    <td>
                        <span class="fw-bold ${stockClass}">${product.stock}</span>
                    </td>
                    <td>${statusBadge}</td>
                    <td>${product.date_added}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(${product.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger ms-1" onclick="deleteProduct(${product.id})" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                productsTableBody.appendChild(row);
            });

            updatePagination(products.length);
        }

        function updatePagination(totalProducts) {
            const totalPages = Math.ceil(totalProducts / productsPerPage);
            const pagination = document.getElementById('productsPagination');
            pagination.innerHTML = '';

            // Previous button
            const prevDisabled = currentPage === 1 ? 'disabled' : '';
            pagination.innerHTML += `
                <li class="page-item ${prevDisabled}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1})" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            `;

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const active = i === currentPage ? 'active' : '';
                pagination.innerHTML += `
                    <li class="page-item ${active}">
                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                    </li>
                `;
            }

            // Next button
            const nextDisabled = currentPage === totalPages ? 'disabled' : '';
            pagination.innerHTML += `
                <li class="page-item ${nextDisabled}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1})" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            `;
        }

        function loadProductsTable() {
            updateProductsTable(allProducts);
        }

        function filterProducts() {
            const categoryValue = document.getElementById('categoryFilter').value;
            const statusValue = document.getElementById('statusFilter').value;
            const searchValue = document.getElementById('searchInput').value.toLowerCase();

            const filteredProducts = allProducts.filter(product => {
                const categoryMatch = categoryValue === 'all' || product.category === categoryValue;
                const statusMatch = statusValue === 'all' || product.status === statusValue;
                const searchMatch = product.name.toLowerCase().includes(searchValue) ||
                    product.sku.toLowerCase().includes(searchValue);

                return categoryMatch && statusMatch && searchMatch;
            });

            currentPage = 1;
            updateProductsTable(filteredProducts);
        }

        // Product Detail Modal
        window.showProductDetail = function(product) {
            // Set badge color based on status
            let statusClass = 'bg-success';
            if (product.status === 'low_stock') {
                statusClass = 'bg-warning';
            } else if (product.status === 'out_of_stock') {
                statusClass = 'bg-danger';
            }

            // Format price
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(product.price);

            // Update modal content
            document.getElementById('detailProductImage').src = product.image;
            document.getElementById('detailProductName').textContent = product.name;
            document.getElementById('detailProductSKU').textContent = `SKU: ${product.sku}`;
            document.getElementById('detailProductCategory').textContent = getCategoryName(product.category);
            document.getElementById('detailProductStatus').textContent = getStatusText(product.status);
            document.getElementById('detailProductStatus').className = `badge ${statusClass}`;
            document.getElementById('detailProductPrice').textContent = formattedPrice;
            document.getElementById('detailProductStock').textContent = product.stock;
            document.getElementById('detailProductStock').className = product.stock === 0 ? 'h5 text-danger' : 'h5';
            document.getElementById('detailProductDescription').textContent = product.description;
            document.getElementById('detailProductWeight').textContent = product.weight;
            document.getElementById('detailProductDimensions').textContent = product.dimensions;
            document.getElementById('detailProductDate').textContent = product.date_added;

            // Update tags
            const tagsContainer = document.getElementById('detailProductTags');
            tagsContainer.innerHTML = '';
            product.tags.forEach(tag => {
                const tagElement = document.createElement('span');
                tagElement.className = 'product-tag';
                tagElement.textContent = tag;
                tagsContainer.appendChild(tagElement);
            });

            // Show modal
            const productDetailModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
            productDetailModal.show();
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Load products table
            loadProductsTable();

            // Filter functionality
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const resetFilters = document.getElementById('resetFilters');

            // Event listeners for filters
            categoryFilter.addEventListener('change', filterProducts);
            statusFilter.addEventListener('change', filterProducts);
            searchInput.addEventListener('input', filterProducts);
            searchButton.addEventListener('click', filterProducts);
            resetFilters.addEventListener('click', function() {
                categoryFilter.value = 'all';
                statusFilter.value = 'all';
                searchInput.value = '';
                loadProductsTable();
            });
        });
    </script>
@endsection
