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
                                            <button class="btn btn-sm btn-outline-primary edit-product" 
                                                    data-product-id="1"
                                                    data-product-name="Sepatu Running Premium"
                                                    data-product-sku="SPR-001"
                                                    data-product-category="Sepatu & Sandal"
                                                    data-product-price="450000"
                                                    data-product-stock="24"
                                                    data-product-status="active"
                                                    data-product-description="Sepatu running premium dengan teknologi terbaru untuk kenyamanan maksimal saat berlari. Dilengkapi dengan sole yang fleksibel dan bahan breathable."
                                                    data-product-weight="0.8"
                                                    data-product-dimensions="30x20x10"
                                                    data-product-tags="Running,Sport,Premium">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info view-product" data-product='{
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
                                            <button class="btn btn-sm btn-outline-danger delete-product" 
                                                    data-product-id="1"
                                                    data-product-name="Sepatu Running Premium">
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
                                            <button class="btn btn-sm btn-outline-primary edit-product"
                                                    data-product-id="2"
                                                    data-product-name="Tas Laptop Minimalis"
                                                    data-product-sku="TLM-002"
                                                    data-product-category="Aksesoris"
                                                    data-product-price="320000"
                                                    data-product-stock="15"
                                                    data-product-status="active"
                                                    data-product-description="Tas laptop dengan desain minimalis dan elegan. Cocok untuk pekerja profesional dengan kompartemen yang terorganisir."
                                                    data-product-weight="0.5"
                                                    data-product-dimensions="40x30x15"
                                                    data-product-tags="Laptop,Minimalis,Professional">
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
                                            <button class="btn btn-sm btn-outline-danger delete-product"
                                                    data-product-id="2"
                                                    data-product-name="Tas Laptop Minimalis">
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

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm">
                    <input type="hidden" id="editProductId">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="editProductName" placeholder="Masukkan nama produk" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control" id="editProductSku" placeholder="Kode SKU" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="editProductCategory" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Sepatu & Sandal">Sepatu & Sandal</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Aksesoris">Aksesoris</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="editProductStatus" required>
                                <option value="active">Aktif</option>
                                <option value="inactive">Stok Sedikit</option>
                                <option value="out_of_stock">Stok Habis</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="editProductPrice" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" id="editProductStock" placeholder="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Berat (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="editProductWeight" placeholder="0.0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dimensi (cm)</label>
                            <input type="text" class="form-control" id="editProductDimensions" placeholder="Panjang x Lebar x Tinggi" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editProductDescription" rows="4" placeholder="Deskripsi produk"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tags</label>
                            <input type="text" class="form-control" id="editProductTags" placeholder="Pisahkan dengan koma (contoh: Running, Sport, Premium)">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" id="editProductImage" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveEditProduct">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h5 class="modal-title" id="deleteProductModalLabel">Hapus Produk</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Produk:</strong> <span id="deleteProductName"></span>
                </div>
                <p class="small text-danger mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Data yang sudah dihapus tidak dapat dikembalikan. Pastikan Anda telah membackup data penting.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProduct">
                    <i class="fas fa-trash me-2"></i>Ya, Hapus Produk
                </button>
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
                <button type="button" class="btn btn-primary" id="editFromDetail">
                    <i class="fas fa-edit me-2"></i>Edit Produk
                </button>
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
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentProductId = null;
        let currentProductData = null;
        
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

        // Edit Product Modal
        const editProductButtons = document.querySelectorAll('.edit-product');
        const editProductModal = new bootstrap.Modal(document.getElementById('editProductModal'));
        
        editProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productData = {
                    id: this.getAttribute('data-product-id'),
                    name: this.getAttribute('data-product-name'),
                    sku: this.getAttribute('data-product-sku'),
                    category: this.getAttribute('data-product-category'),
                    price: this.getAttribute('data-product-price'),
                    stock: this.getAttribute('data-product-stock'),
                    status: this.getAttribute('data-product-status'),
                    description: this.getAttribute('data-product-description'),
                    weight: this.getAttribute('data-product-weight'),
                    dimensions: this.getAttribute('data-product-dimensions'),
                    tags: this.getAttribute('data-product-tags')
                };
                showEditModal(productData);
            });
        });

        function showEditModal(product) {
            currentProductId = product.id;
            
            // Fill form with product data
            document.getElementById('editProductId').value = product.id;
            document.getElementById('editProductName').value = product.name;
            document.getElementById('editProductSku').value = product.sku;
            document.getElementById('editProductCategory').value = product.category;
            document.getElementById('editProductPrice').value = product.price;
            document.getElementById('editProductStock').value = product.stock;
            document.getElementById('editProductStatus').value = product.status;
            document.getElementById('editProductDescription').value = product.description;
            document.getElementById('editProductWeight').value = product.weight;
            document.getElementById('editProductDimensions').value = product.dimensions;
            document.getElementById('editProductTags').value = product.tags;
            
            editProductModal.show();
        }

        // Delete Product Modal
        const deleteProductButtons = document.querySelectorAll('.delete-product');
        const deleteProductModal = new bootstrap.Modal(document.getElementById('deleteProductModal'));
        
        deleteProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                showDeleteModal(productId, productName);
            });
        });

        function showDeleteModal(productId, productName) {
            currentProductId = productId;
            document.getElementById('deleteProductName').textContent = productName;
            deleteProductModal.show();
        }

        // Product Detail Modal
        const viewProductButtons = document.querySelectorAll('.view-product');
        const productDetailModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
        
        viewProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productData = JSON.parse(this.getAttribute('data-product'));
                currentProductData = productData;
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

        // Edit from detail modal
        document.getElementById('editFromDetail').addEventListener('click', function() {
            if (currentProductData) {
                productDetailModal.hide();
                // Convert detail data to edit format
                const editData = {
                    id: currentProductData.sku.replace('SKU-', ''),
                    name: currentProductData.name,
                    sku: currentProductData.sku,
                    category: currentProductData.category,
                    price: currentProductData.price.replace(/[^\d]/g, ''),
                    stock: currentProductData.stock,
                    status: currentProductData.status === 'Aktif' ? 'active' : 
                           currentProductData.status === 'Stok Sedikit' ? 'low_stock' : 'out_of_stock',
                    description: currentProductData.description,
                    weight: currentProductData.weight.replace(' kg', ''),
                    dimensions: currentProductData.dimensions.replace(/ x /g, 'x').replace(' cm', ''),
                    tags: currentProductData.tags.join(',')
                };
                showEditModal(editData);
            }
        });

        // Save Edit Product
        document.getElementById('saveEditProduct').addEventListener('click', function() {
            const loadingModal = showLoadingModal();
            
            // Simulate API call
            setTimeout(() => {
                loadingModal.hide();
                editProductModal.hide();
                showAlert('success', 'Produk berhasil diperbarui!');
                // In real application, you would reload the page or update the table
            }, 1500);
        });

        // Confirm Delete Product
        document.getElementById('confirmDeleteProduct').addEventListener('click', function() {
            const loadingModal = showLoadingModal();
            deleteProductModal.hide();
            
            // Simulate API call
            setTimeout(() => {
                loadingModal.hide();
                showAlert('success', 'Produk berhasil dihapus!');
                // In real application, you would reload the page or remove the row
            }, 1500);
        });

        // Utility Functions
        function showLoadingModal() {
            const modal = new bootstrap.Modal(document.getElementById('loadingModal'));
            modal.show();
            return modal;
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
    });
</script>
@endsection