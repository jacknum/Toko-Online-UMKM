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
                            <div class="h5 mb-0 font-weight-bold text-white">145</div>
                            <small class="text-white">+5 dari bulan lalu</small>
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
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Pendapatan</h6>
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
                                <i class="fas fa-shopping-cart text-primary" data-toggle="modal" data-target="#iconModal"
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
                                <i class="fas fa-money-bill-wave text-success" data-toggle="modal" data-target="#iconModal"
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
                                <i class="fas fa-box text-warning" data-toggle="modal" data-target="#iconModal"
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
                                <i class="fas fa-exclamation-triangle text-danger" data-toggle="modal"
                                    data-target="#iconModal" data-icon="fa-exclamation-triangle"
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
                    <button class="btn btn-sm btn-outline-danger" onclick="bulkDeleteProducts()" id="bulkDeleteBtn"
                        style="display: none;">
                        <i class="fas fa-trash me-1"></i> Hapus Terpilih
                    </button>
                </div>
                <div class="card-body">
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
                                    <th width="80">Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                                <!-- Data produk akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Product pagination">
                        <ul class="pagination justify-content-center mb-0" id="productsPagination">
                            <!-- Pagination akan diisi oleh JavaScript -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Icons -->
    <div class="modal fade" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="iconModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iconModalLabel">Informasi Ikon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-icon-placeholder fa-4x mb-3 text-primary"></i>
                    <h4 id="iconTitle" class="mb-3">Judul Ikon</h4>
                    <p id="iconDescription">Deskripsi akan muncul di sini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Actions -->
    <div class="modal fade" id="editActionModal" tabindex="-1" role="dialog" aria-labelledby="editActionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editActionModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editActionForm">
                        <input type="hidden" id="editProductId">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editProductName">Nama Produk</label>
                                    <input type="text" class="form-control" id="editProductName" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="editProductCategory">Kategori</label>
                                    <input type="text" class="form-control" id="editProductCategory" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="editProductPrice">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="editProductPrice" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editProductStock">Stok</label>
                                    <input type="number" class="form-control" id="editProductStock" min="0"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editProductStatus">Status</label>
                                    <select class="form-control" id="editProductStatus" required>
                                        <option value="active">Aktif</option>
                                        <option value="warning">Stok Sedikit</option>
                                        <option value="danger">Habis</option>
                                        <option value="inactive">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editProductImagePreview">Gambar Produk</label>
                                    <div class="image-preview mb-2 text-center">
                                        <img src="https://via.placeholder.com/150/6c757d/ffffff?text=Preview"
                                            alt="Preview" class="img-thumbnail" id="editProductImagePreview"
                                            style="max-height: 150px;">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editProductImage"
                                            accept="image/*">
                                        <label class="custom-file-label" for="editProductImage">Ubah gambar</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editProductDescription">Deskripsi Produk</label>
                            <textarea class="form-control" id="editProductDescription" rows="3"></textarea>
                        </div>

                        <div class="alert alert-info mt-3">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Perubahan akan langsung diterapkan setelah Anda menyimpannya.
                            </small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="deleteProductBtn"
                        onclick="confirmDeleteProduct()">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn" onclick="saveProductChanges()">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Tambahan styling untuk kontras yang lebih baik */
        .text-white-90 {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .text-white-70 {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .report-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-custom {
            border: none;
            border-radius: 10px;
        }

        .badge-custom {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        .product-image-container {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            margin: 0 auto;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 10px;
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

        .pagination .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .pagination .page-link {
            color: #4e73df;
        }

        .pagination .page-link:hover {
            color: #224abe;
        }

        /* Styling untuk modal edit */
        #editActionModal .modal-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
        }

        #editActionModal .modal-header .close {
            color: white;
            opacity: 0.8;
        }

        #editActionModal .modal-header .close:hover {
            opacity: 1;
        }

        #editActionModal .form-control:read-only {
            background-color: #f8f9fa;
            opacity: 0.8;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Data produk dengan lebih banyak item untuk demo pagination
        const allProducts = [{
                id: 1,
                name: 'Sepatu Running Premium',
                category: 'Olahraga',
                price: '450000',
                stock: '24',
                status: 'active',
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&h=150&q=80',
                description: 'Sepatu running dengan teknologi terbaru untuk kenyamanan maksimal'
            },
            {
                id: 2,
                name: 'Tas Laptop Minimalis',
                category: 'Aksesoris',
                price: '320000',
                stock: '15',
                status: 'active',
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&h=150&q=80',
                description: 'Tas laptop dengan desain minimalis dan bahan waterproof'
            },
            {
                id: 3,
                name: 'Smartwatch Series 5',
                category: 'Elektronik',
                price: '1200000',
                stock: '8',
                status: 'warning',
                image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&h=150&q=80',
                description: 'Smartwatch dengan fitur kesehatan dan konektivitas lengkap'
            },
            {
                id: 4,
                name: 'Kaos Polo Cotton',
                category: 'Pakaian',
                price: '125000',
                stock: '0',
                status: 'danger',
                image: 'https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&h=150&q=80',
                description: 'Kaos polo berbahan cotton premium dengan jahitan rapi'
            }
        ];

        let currentPage = 1;
        const productsPerPage = 4;

        document.addEventListener('DOMContentLoaded', function() {
            // Load products table
            loadProductsTable();

            // Initialize chart hanya jika elemen ada
            const chartCanvas = document.getElementById('revenueChart');
            if (chartCanvas) {
                initializeChart();
            }

            // Icon Modal Handler
            $('#iconModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const iconClass = button.data('icon');
                const iconTitle = button.data('title');
                const modal = $(this);

                modal.find('.fa-icon-placeholder').attr('class',
                    `fas ${iconClass} fa-4x mb-3 text-primary`);
                modal.find('#iconTitle').text(iconTitle);

                let description = '';
                switch (iconClass) {
                    case 'fa-box':
                        description = 'Ikon ini mewakili jumlah produk yang tersedia di toko Anda.';
                        break;
                    case 'fa-shopping-cart':
                        description = 'Ikon ini menunjukkan jumlah pesanan masuk yang belum diproses.';
                        break;
                    case 'fa-truck':
                        description =
                            'Ikon ini menampilkan jumlah pesanan yang sedang dalam proses pengiriman.';
                        break;
                    case 'fa-money-bill-wave':
                        description =
                            'Ikon ini menunjukkan total pendapatan dan biaya yang telah diterima.';
                        break;
                    case 'fa-exclamation-triangle':
                        description =
                            'Ikon ini menandakan adanya masalah atau peringatan yang perlu perhatian.';
                        break;
                    default:
                        description =
                            'Ikon ini memberikan informasi tentang aktivitas terbaru di toko Anda.';
                }
                modal.find('#iconDescription').text(description);
            });

            // Image preview handler untuk modal edit
            $('#editProductImage').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#editProductImagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                    $(this).next('.custom-file-label').html(file.name);
                }
            });

            // Select all checkboxes
            $('#selectAll').on('change', function() {
                $('.product-checkbox').prop('checked', this.checked);
                updateBulkDeleteButton();
            });

            // Attach event listeners to dynamically created checkboxes
            $(document).on('change', '.product-checkbox', updateBulkDeleteButton);
        });

        function initializeChart() {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(78, 115, 223, 0.5)');
            gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');

            const data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Juta Rupiah)',
                    data: [5, 7, 8, 10, 12, 15, 18, 16, 14, 12, 10, 8],
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

            new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        }

        function loadProductsTable() {
            const startIndex = (currentPage - 1) * productsPerPage;
            const endIndex = startIndex + productsPerPage;
            const currentProducts = allProducts.slice(startIndex, endIndex);

            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = '';

            currentProducts.forEach((product, index) => {
                const rowNumber = startIndex + index + 1;
                const statusBadge = getStatusBadge(product.status);

                const row = `
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input product-checkbox" type="checkbox" value="${product.id}">
                        </div>
                    </td>
                    <td>${rowNumber}</td>
                    <td>
                        <div class="product-image-container">
                            <img src="${product.image}" alt="${product.name}" class="product-image">
                        </div>
                    </td>
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>Rp ${formatPrice(product.price)}</td>
                    <td>${product.stock}</td>
                    <td>${statusBadge}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(${product.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger ms-1" onclick="deleteProduct(${product.id})" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
                tableBody.innerHTML += row;
            });

            updatePagination();
        }

        function getStatusBadge(status) {
            switch (status) {
                case 'active':
                    return '<span class="badge bg-success badge-custom">Aktif</span>';
                case 'warning':
                    return '<span class="badge bg-warning badge-custom">Stok Sedikit</span>';
                case 'danger':
                    return '<span class="badge bg-danger badge-custom">Habis</span>';
                default:
                    return '<span class="badge bg-secondary badge-custom">Tidak Aktif</span>';
            }
        }

        function formatPrice(price) {
            return parseInt(price).toLocaleString('id-ID');
        }

        function updatePagination() {
            const totalPages = Math.ceil(allProducts.length / productsPerPage);
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

        function changePage(page) {
            currentPage = page;
            loadProductsTable();
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

        // EDIT PRODUCT FUNCTION - FIXED VERSION
        function openEditModal(id) {
            console.log('Opening edit modal for product ID:', id);

            const product = allProducts.find(p => p.id === id);

            if (product) {
                // Isi form dengan data produk
                $('#editProductId').val(product.id);
                $('#editProductName').val(product.name);
                $('#editProductCategory').val(product.category);
                $('#editProductPrice').val('Rp ' + formatPrice(product.price));
                $('#editProductStock').val(product.stock);
                $('#editProductDescription').val(product.description);
                $('#editProductStatus').val(product.status);
                $('#editProductImagePreview').attr('src', product.image);

                // Reset file input
                $('#editProductImage').val('');
                $('#editProductImage').next('.custom-file-label').html('Ubah gambar');

                // Tampilkan modal dengan jQuery
                $('#editActionModal').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Produk Tidak Ditemukan',
                    text: 'Produk yang akan diedit tidak ditemukan!',
                    confirmButtonText: 'OK'
                });
            }

            editProduct(id);
        }

        function saveProductChanges() {
            const productId = parseInt($('#editProductId').val());
            const newStock = $('#editProductStock').val();
            const newStatus = $('#editProductStatus').val();
            const newDescription = $('#editProductDescription').val();

            if (!newStock || newStock < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Stok Tidak Valid',
                    text: 'Harap masukkan stok yang valid!',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const productIndex = allProducts.findIndex(p => p.id === productId);

            if (productIndex !== -1) {
                allProducts[productIndex].stock = newStock;
                allProducts[productIndex].status = newStatus;
                allProducts[productIndex].description = newDescription;

                const imageInput = document.getElementById('editProductImage');
                if (imageInput.files && imageInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        allProducts[productIndex].image = e.target.result;
                        loadProductsTable();
                        showEditSuccess();
                    };
                    reader.readAsDataURL(imageInput.files[0]);
                } else {
                    loadProductsTable();
                    showEditSuccess();
                }
            }
        }

        function showEditSuccess() {
            $('#editActionModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Perubahan Disimpan',
                text: 'Data produk berhasil diperbarui.',
                confirmButtonText: 'OK',
                timer: 2000
            });
        }

        function confirmDeleteProduct() {
            const productId = parseInt($('#editProductId').val());
            const product = allProducts.find(p => p.id === productId);

            if (product) {
                Swal.fire({
                    title: 'Hapus Produk?',
                    html: `Anda akan menghapus produk <strong>"${product.name}"</strong>. Tindakan ini tidak dapat dibatalkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editActionModal').modal('hide');
                        deleteProduct(productId);
                    }
                });
            }
        }

        function deleteProduct(id) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Anda tidak dapat mengembalikan produk yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const index = allProducts.findIndex(p => p.id === id);
                    if (index !== -1) {
                        allProducts.splice(index, 1);
                        loadProductsTable();
                    }
                    Swal.fire('Terhapus!', 'Produk telah berhasil dihapus.', 'success');
                }
            });
        }

        function bulkDeleteProducts() {
            const selectedProducts = $('.product-checkbox:checked').map(function() {
                return parseInt($(this).val());
            }).get();

            if (selectedProducts.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak ada produk dipilih',
                    text: 'Silakan pilih produk terlebih dahulu.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Hapus Produk Terpilih?',
                text: `Anda akan menghapus ${selectedProducts.length} produk. Tindakan ini tidak dapat dibatalkan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    selectedProducts.forEach(id => {
                        const index = allProducts.findIndex(p => p.id === id);
                        if (index !== -1) {
                            allProducts.splice(index, 1);
                        }
                    });
                    loadProductsTable();
                    Swal.fire('Terhapus!', `${selectedProducts.length} produk telah berhasil dihapus.`, 'success');
                }
            });
        }

        // Generate Report Function
        function generateReport() {
            // Show loading indicator
            Swal.fire({
                title: 'Membuat Laporan',
                text: 'Sedang memproses laporan Anda...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                // Initialize PDF
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF('p', 'mm', 'a4');

                // Add kop surat/header
                doc.setFillColor(78, 115, 223);
                doc.rect(0, 0, 210, 30, 'F');

                doc.setTextColor(255, 255, 255);
                doc.setFontSize(20);
                doc.text('TOKO ONLINE ELEGAN', 105, 15, {
                    align: 'center'
                });

                doc.setFontSize(12);
                doc.text('LAPORAN DASHBOARD PERFORMANCE', 105, 22, {
                    align: 'center'
                });

                // Add header info
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

                // Add stats summary with table borders
                doc.setFontSize(14);
                doc.text('RINGKASAN PERFORMANCE', 15, 50);

                doc.setFontSize(10);
                const statsData = [
                    ['Metrik', 'Nilai', 'Keterangan'],
                    ['Total Produk', '145 item', '+5 dari bulan lalu'],
                    ['Pesanan Masuk', '67 pesanan', '12 menunggu konfirmasi'],
                    ['Pesanan Keluar', '42 pesanan', '8 dalam pengiriman'],
                    ['Total Pendapatan', 'Rp 18.250.000', 'Bersih setelah potongan']
                ];

                let yPosition = 60;

                // Draw table with borders
                statsData.forEach((row, index) => {
                    // Header background
                    if (index === 0) {
                        doc.setFillColor(78, 115, 223);
                        doc.rect(15, yPosition - 5, 180, 8, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.setFont(undefined, 'bold');
                    } else {
                        doc.setTextColor(0, 0, 0);
                        doc.setFont(undefined, 'normal');
                    }

                    // Draw cell borders
                    doc.setDrawColor(200, 200, 200);
                    doc.rect(15, yPosition - 5, 180, 8);
                    doc.rect(15, yPosition - 5, 60, 8); // Column 1
                    doc.rect(75, yPosition - 5, 50, 8); // Column 2
                    doc.rect(125, yPosition - 5, 70, 8); // Column 3

                    doc.text(row[0], 20, yPosition);
                    doc.text(row[1], 80, yPosition);
                    doc.text(row[2], 130, yPosition);
                    yPosition += 8;
                });

                // Add revenue chart data as table
                yPosition += 10;
                doc.setFontSize(14);
                doc.text('DATA PENDAPATAN BULANAN', 15, yPosition);

                yPosition += 10;
                doc.setFontSize(10);
                const revenueData = [
                    ['Bulan', 'Pendapatan'],
                    ['Januari', 'Rp 5.000.000'],
                    ['Februari', 'Rp 7.000.000'],
                    ['Maret', 'Rp 8.000.000'],
                    ['April', 'Rp 10.000.000'],
                    ['Mei', 'Rp 12.000.000'],
                    ['Juni', 'Rp 15.000.000'],
                    ['Juli', 'Rp 18.000.000'],
                    ['Agustus', 'Rp 16.000.000'],
                    ['September', 'Rp 14.000.000'],
                    ['Oktober', 'Rp 12.000.000'],
                    ['November', 'Rp 10.000.000'],
                    ['Desember', 'Rp 8.000.000']
                ];

                // Draw revenue table with borders
                revenueData.forEach((row, index) => {
                    if (index === 0) {
                        doc.setFillColor(78, 115, 223);
                        doc.rect(15, yPosition - 5, 180, 8, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.setFont(undefined, 'bold');
                    } else {
                        doc.setTextColor(0, 0, 0);
                        doc.setFont(undefined, 'normal');
                    }

                    // Draw cell borders
                    doc.setDrawColor(200, 200, 200);
                    doc.rect(15, yPosition - 5, 180, 8);
                    doc.rect(15, yPosition - 5, 90, 8); // Column 1
                    doc.rect(105, yPosition - 5, 90, 8); // Column 2

                    doc.text(row[0], 20, yPosition);
                    doc.text(row[1], 110, yPosition);
                    yPosition += 8;

                    // Check if we need a new page
                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                // Add products table
                yPosition += 10;
                doc.setFontSize(14);
                doc.text('PRODUK TERBARU', 15, yPosition);

                yPosition += 10;
                doc.setFontSize(8); // Smaller font for product table
                const productsData = [
                    ['No', 'Nama Produk', 'Kategori', 'Harga', 'Stok', 'Status'],
                    ...allProducts.map((product, index) => [
                        (index + 1).toString(),
                        product.name,
                        product.category,
                        `Rp ${formatPrice(product.price)}`,
                        product.stock,
                        product.status === 'active' ? 'Aktif' : product.status === 'warning' ? 'Stok Sedikit' :
                        'Habis'
                    ])
                ];

                // Draw products table with borders
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

                    // Draw cell borders
                    doc.setDrawColor(200, 200, 200);
                    doc.rect(15, yPosition - 5, 180, 8);
                    doc.rect(15, yPosition - 5, 10, 8); // No
                    doc.rect(25, yPosition - 5, 50, 8); // Nama
                    doc.rect(75, yPosition - 5, 30, 8); // Kategori
                    doc.rect(105, yPosition - 5, 35, 8); // Harga
                    doc.rect(140, yPosition - 5, 20, 8); // Stok
                    doc.rect(160, yPosition - 5, 35, 8); // Status

                    doc.text(row[0], 17, yPosition);
                    doc.text(row[1], 27, yPosition, {
                        maxWidth: 45
                    });
                    doc.text(row[2], 77, yPosition);
                    doc.text(row[3], 107, yPosition);
                    doc.text(row[4], 142, yPosition);
                    doc.text(row[5], 162, yPosition);
                    yPosition += 8;

                    // Check if we need a new page
                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                // Add summary
                yPosition += 10;
                doc.setFontSize(12);
                doc.text('ANALISIS PERFORMANCE:', 15, yPosition);

                doc.setFontSize(10);
                const analysis = [
                    '• Pertumbuhan pendapatan menunjukkan tren positif dengan peningkatan 15% dari bulan sebelumnya',
                    '• Stok produk perlu diperhatikan, terutama untuk produk yang hampir habis',
                    '• Rasio konversi pesanan masuk ke pesanan keluar sebesar 62.7%',
                    '• Rekomendasi: Fokus pada restock produk populer dan optimasi proses pengiriman'
                ];

                yPosition += 8;
                analysis.forEach(item => {
                    doc.text(item, 20, yPosition, {
                        maxWidth: 170
                    });
                    yPosition += 8;

                    // Check if we need a new page
                    if (yPosition > 270) {
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                // Add footer
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

                // Save the PDF
                setTimeout(() => {
                    doc.save(`Laporan-Performance-${new Date().toISOString().slice(0,10)}.pdf`);

                    // Close loading indicator
                    Swal.close();

                    // Show success message
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

        // === Perbaikan fungsi tombol Edit ===
        // Memastikan kompatibilitas dengan Bootstrap 5
        function openEditModal(id) {
            const product = allProducts.find(p => p.id === id);
            if (!product) return alert("Produk tidak ditemukan");

            // Isi data ke form modal edit
            document.getElementById('editProductId').value = product.id;
            document.getElementById('editProductName').value = product.name;
            document.getElementById('editProductCategory').value = product.category;
            document.getElementById('editProductPrice').value = 'Rp ' + product.price.toLocaleString('id-ID');
            document.getElementById('editProductStock').value = product.stock;
            document.getElementById('editProductDescription').value = product.description;
            document.getElementById('editProductStatus').value = product.status;

            const imgPreview = document.getElementById('editProductImagePreview');
            if (imgPreview) imgPreview.src = product.image;

            // Buka modal dengan Bootstrap 5
            const modalEl = document.getElementById('editActionModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>
@endsection
