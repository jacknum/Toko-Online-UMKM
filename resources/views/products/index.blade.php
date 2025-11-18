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
                                            <td>{{ $product->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="openEditModal({{ $product->id }})" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger ms-1"
                                                    onclick="deleteProduct({{ $product->id }})" title="Hapus">
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
                    <button type="submit" form="editProductForm" class="btn btn-primary">Update Produk</button>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-gradient-danger text-white border-0">
                    <div class="modal-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0" id="deleteProductModalLabel">Konfirmasi Hapus</h5>
                        <p class="mb-0 small opacity-75">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="delete-icon">
                        <i class="fas fa-trash"></i>
                    </div>
                    <h4 class="text-danger mb-3">Hapus Produk?</h4>
                    <p class="text-muted mb-2">Anda akan menghapus produk:</p>
                    <h6 class="text-dark mb-3" id="deleteProductName">Nama Produk</h6>
                    <p class="text-danger small mb-0">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        Data yang dihapus tidak dapat dikembalikan
                    </p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-lg btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="button" class="btn btn-lg btn-danger px-4 shadow-sm" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-2"></i>Ya, Hapus
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

        /* Enhanced Delete Modal Styles */
        #deleteProductModal .modal-content {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(231, 76, 60, 0.3);
            border: none;
            overflow: hidden;
        }

        #deleteProductModal .modal-header {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 2rem 1.5rem 1rem;
            position: relative;
        }

        #deleteProductModal .modal-header .modal-icon {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #deleteProductModal .modal-header .modal-icon i {
            font-size: 1.5rem;
            color: #e74c3c;
        }

        #deleteProductModal .modal-body {
            padding: 2rem 1.5rem;
        }

        #deleteProductModal .delete-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ffeaea 0%, #ffd1d1 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            border: 3px solid #ffebee;
        }

        #deleteProductModal .delete-icon i {
            font-size: 2rem;
            color: #e74c3c;
        }

        #deleteProductModal .modal-footer {
            padding: 1.5rem;
            background: #f8f9fa;
        }

        #deleteProductModal .btn {
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        #deleteProductModal .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }

        #deleteProductModal .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
        }

        #deleteProductModal .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
        }

        #deleteProductModal .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.6);
        }

        /* Animation for modal */
        @keyframes modalEnter {
            0% {
                opacity: 0;
                transform: scale(0.8) translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        #deleteProductModal .modal-content {
            animation: modalEnter 0.3s ease-out;
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

        /* Improved Loading Modal Styles */
        #loadingModal .modal-content {
            border-radius: 15px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        #loadingModal .spinner-border {
            border-width: 3px;
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

        // Utility Functions - UPDATED
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

        // Filter Products dengan AJAX - IMPROVED VERSION
        function filterProducts() {
            const categoryValue = document.getElementById('categoryFilter').value;
            const statusValue = document.getElementById('statusFilter').value;
            const searchValue = document.getElementById('searchInput').value;

            // Show loading
            showLoading();

            // Clear previous timeout jika ada
            if (window.filterTimeout) {
                clearTimeout(window.filterTimeout);
            }

            // Set timeout yang lebih pendek (3 detik)
            window.filterTimeout = setTimeout(() => {
                hideLoading();
                showToast('Permintaan terlalu lama, coba lagi', 'error');
            }, 3000); // 3 seconds timeout saja

            // AJAX request untuk filter
            fetch(`{{ route('products.filter') }}?category=${categoryValue}&status=${statusValue}&search=${searchValue}`)
                .then(response => {
                    // Clear timeout karena response sudah diterima
                    clearTimeout(window.filterTimeout);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateProductsTable(data.products);
                        updateStats(data.stats);

                        // Jika tidak ada hasil, tampilkan pesan
                        if (data.products.length === 0) {
                            showToast('Tidak ada produk yang ditemukan', 'info');
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
                    clearTimeout(window.filterTimeout);
                    console.error('Filter Error:', error);

                    // Tampilkan error yang lebih spesifik
                    let errorMessage = 'Terjadi kesalahan saat memfilter produk';
                    if (error.message.includes('Failed to fetch')) {
                        errorMessage = 'Koneksi internet bermasalah';
                    } else if (error.message.includes('timeout')) {
                        errorMessage = 'Permintaan timeout';
                    }

                    showToast(errorMessage, 'error');
                    updateProductsTable([]);
                    updateStats({
                        total: 0,
                        active: 0,
                        low_stock: 0,
                        out_of_stock: 0
                    });
                })
                .finally(() => {
                    hideLoading();
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
                const stockClass = product.stock === 0 ? 'text-danger' : (product.stock <= 10 ? 'text-warning' :
                '');

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
                <td>${formatDate(product.created_at)}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(${product.id})" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger ms-1" onclick="confirmDelete(${product.id}, '${product.name.replace(/'/g, "\\'")}')" title="Hapus">
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
                    document.getElementById('editProductStock').value = product.stock;
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
                    alert('Gagal memuat data produk');
                });
        }

        // Delete Confirmation
        window.confirmDelete = function(productId, productName) {
            productToDelete = productId;

            // Update modal content
            document.getElementById('deleteProductName').textContent = productName;

            // Show delete confirmation modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteProductModal'));
            deleteModal.show();
        }

        // Confirm Delete Action
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (productToDelete) {
                deleteProduct(productToDelete);
            }
        });

        // Delete Product Function
        window.deleteProduct = function(productId) {
            showLoading();

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
                    hideLoading();

                    // Hide delete modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteProductModal'));
                    if (deleteModal) {
                        deleteModal.hide();
                    }

                    if (data.success) {
                        showToast('Produk berhasil dihapus', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showToast('Gagal menghapus produk', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showToast('Terjadi kesalahan saat menghapus produk', 'error');
                });
        }

        // Enhanced Toast notification function
        function showToast(message, type = 'info') {
            // Remove existing toasts
            const existingToasts = document.querySelectorAll('.toast-container');
            existingToasts.forEach(toast => toast.remove());

            const toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container';

            const toast = document.createElement('div');
            toast.className =
            `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');

            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';

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

            // Remove toast after hide
            toast.addEventListener('hidden.bs.toast', () => {
                toastContainer.remove();
            });
        }

        // Loading functions - IMPROVED
        function showLoading() {
            try {
                const loadingModalElement = document.getElementById('loadingModal');
                if (loadingModalElement) {
                    const loadingModal = new bootstrap.Modal(loadingModalElement);
                    loadingModal.show();
                }
            } catch (error) {
                console.error('Error showing loading modal:', error);
            }
        }

        function hideLoading() {
            try {
                const loadingModalElement = document.getElementById('loadingModal');
                if (loadingModalElement) {
                    const loadingModal = bootstrap.Modal.getInstance(loadingModalElement);
                    if (loadingModal) {
                        loadingModal.hide();
                    } else {
                        const newModal = new bootstrap.Modal(loadingModalElement);
                        newModal.hide();
                    }
                }
            } catch (error) {
                console.error('Error hiding loading modal:', error);
                const loadingModalElement = document.getElementById('loadingModal');
                if (loadingModalElement) {
                    loadingModalElement.classList.remove('show');
                    loadingModalElement.style.display = 'none';
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                }
            }
        }

        // Initialize event listeners when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
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

            // Initialize confirm delete button
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
