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
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select">
                                <option selected>Semua Kategori</option>
                                <option>Sepatu & Sandal</option>
                                <option>Pakaian</option>
                                <option>Elektronik</option>
                                <option>Aksesoris</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Semua Status</option>
                                <option>Aktif</option>
                                <option>Nonaktif</option>
                                <option>Stok Habis</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pencarian</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari produk...">
                                <button class="btn btn-outline-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Produk Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Stok Menipis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Stok Habis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
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
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-2"></i>Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-export me-2"></i>Export Data</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Tanggal Ditambah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&h=150&fit=crop&crop=center" alt="Sepatu Running" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">Sepatu Running Premium</div>
                                                <small class="text-muted">SKU: SPR-001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Sepatu & Sandal</td>
                                    <td>Rp 450.000</td>
                                    <td>
                                        <span class="fw-bold">24</span>
                                    </td>
                                    <td><span class="badge bg-success badge-custom">Aktif</span></td>
                                    <td>15 Jan 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info view-product" data-bs-toggle="tooltip" title="Lihat" data-product='{
                                                "name": "Sepatu Running Premium",
                                                "sku": "SPR-001",
                                                "category": "Sepatu & Sandal",
                                                "price": "450000",
                                                "stock": "24",
                                                "status": "Aktif",
                                                "description": "Sepatu running premium dengan teknologi terbaru untuk kenyamanan maksimal saat berlari. Dilengkapi dengan sole yang fleksibel dan bahan breathable.",
                                                "image": "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=400&fit=crop&crop=center",
                                                "date_added": "15 Jan 2024",
                                                "weight": "0.8 kg",
                                                "dimensions": "30 x 20 x 10 cm",
                                                "tags": ["Running", "Sport", "Premium"]
                                            }'>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=150&h=150&fit=crop&crop=center" alt="Tas Laptop" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">Tas Laptop Minimalis</div>
                                                <small class="text-muted">SKU: TLM-002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Aksesoris</td>
                                    <td>Rp 320.000</td>
                                    <td>
                                        <span class="fw-bold">15</span>
                                    </td>
                                    <td><span class="badge bg-success badge-custom">Aktif</span></td>
                                    <td>12 Jan 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info view-product" data-product='{
                                                "name": "Tas Laptop Minimalis",
                                                "sku": "TLM-002",
                                                "category": "Aksesoris",
                                                "price": "320000",
                                                "stock": "15",
                                                "status": "Aktif",
                                                "description": "Tas laptop dengan desain minimalis dan elegan. Cocok untuk pekerja profesional dengan kompartemen yang terorganisir.",
                                                "image": "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop&crop=center",
                                                "date_added": "12 Jan 2024",
                                                "weight": "0.5 kg",
                                                "dimensions": "40 x 30 x 15 cm",
                                                "tags": ["Laptop", "Minimalis", "Professional"]
                                            }'>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=150&h=150&fit=crop&crop=center" alt="Smartwatch" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">Smartwatch Series 5</div>
                                                <small class="text-muted">SKU: SWS-003</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Elektronik</td>
                                    <td>Rp 1.200.000</td>
                                    <td>
                                        <span class="fw-bold text-warning">8</span>
                                    </td>
                                    <td><span class="badge bg-warning badge-custom">Stok Sedikit</span></td>
                                    <td>10 Jan 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info view-product" data-product='{
                                                "name": "Smartwatch Series 5",
                                                "sku": "SWS-003",
                                                "category": "Elektronik",
                                                "price": "1200000",
                                                "stock": "8",
                                                "status": "Stok Sedikit",
                                                "description": "Smartwatch canggih dengan fitur kesehatan lengkap, GPS, dan battery life hingga 7 hari. Kompatibel dengan iOS dan Android.",
                                                "image": "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=400&fit=crop&crop=center",
                                                "date_added": "10 Jan 2024",
                                                "weight": "0.1 kg",
                                                "dimensions": "4 x 4 x 1 cm",
                                                "tags": ["Smartwatch", "Elektronik", "Health"]
                                            }'>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=150&h=150&fit=crop&crop=center" alt="Kaos Polo" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">Kaos Polo Cotton</div>
                                                <small class="text-muted">SKU: KPC-004</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Pakaian</td>
                                    <td>Rp 125.000</td>
                                    <td>
                                        <span class="fw-bold text-danger">0</span>
                                    </td>
                                    <td><span class="badge bg-danger badge-custom">Habis</span></td>
                                    <td>08 Jan 2024</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info view-product" data-product='{
                                                "name": "Kaos Polo Cotton",
                                                "sku": "KPC-004",
                                                "category": "Pakaian",
                                                "price": "125000",
                                                "stock": "0",
                                                "status": "Habis",
                                                "description": "Kaos polo dengan bahan cotton premium yang nyaman dipakai sehari-hari. Tersedia dalam berbagai ukuran dan warna.",
                                                "image": "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=400&fit=crop&crop=center",
                                                "date_added": "08 Jan 2024",
                                                "weight": "0.3 kg",
                                                "dimensions": "35 x 25 x 2 cm",
                                                "tags": ["Polo", "Cotton", "Casual"]
                                            }'>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
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
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama produk" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option>Sepatu & Sandal</option>
                                <option>Pakaian</option>
                                <option>Elektronik</option>
                                <option>Aksesoris</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi produk"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan Produk</button>
            </div>
        </div>
    </div>
</div>

<!-- Product Detail Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="detailProductImage" src="" alt="Product Image" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
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
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Produk
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
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all checkbox
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('tbody .form-check-input');
        
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add product form submission
        const addProductForm = document.getElementById('addProductForm');
        if (addProductForm) {
            addProductForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Handle form submission here
                alert('Produk berhasil ditambahkan!');
                $('#addProductModal').modal('hide');
            });
        }

        // Product detail modal
        const viewProductButtons = document.querySelectorAll('.view-product');
        const productDetailModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
        
        viewProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productData = JSON.parse(this.getAttribute('data-product'));
                showProductDetail(productData);
            });
        });

        function showProductDetail(product) {
            // Set badge color based on status
            let statusClass = 'bg-success';
            if (product.status === 'Stok Sedikit') {
                statusClass = 'bg-warning';
            } else if (product.status === 'Habis') {
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
            document.getElementById('detailProductCategory').textContent = product.category;
            document.getElementById('detailProductStatus').textContent = product.status;
            document.getElementById('detailProductStatus').className = `badge ${statusClass}`;
            document.getElementById('detailProductPrice').textContent = formattedPrice;
            document.getElementById('detailProductStock').textContent = product.stock;
            document.getElementById('detailProductStock').className = product.stock === '0' ? 'h5 text-danger' : 'h5';
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
            productDetailModal.show();
        }
    });
</script>
@endsection