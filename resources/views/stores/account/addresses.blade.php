@extends('layouts.store')

@section('title', 'Alamat Saya - Toko UMKM')

@section('content')
    <div class="container-fluid bg-light">
        <div class="container">
            <!-- Header yang Minimalis dan Informatif -->
            <div class="row align-items-center py-4">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="/" class="text-decoration-none">
                                    <i class="fas fa-home me-1"></i>Beranda
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('store.account.profile') }}" class="text-decoration-none">Akun Saya</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Alamat</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center text-muted">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span class="fw-medium">Alamat Saya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area dengan Background Putih -->
    <div class="container-fluid bg-white py-5">
        <div class="container">
            <!-- Content Alamat -->
            <div class="row">
                <div class="col-12">
                    <!-- Header dengan Tombol Tambah Alamat -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h4 class="fw-semibold mb-0">
                            <i class="fas fa-map-marker-alt me-2"></i>Alamat Saya
                        </h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                            <i class="fas fa-plus me-2"></i>Tambah Alamat Baru
                        </button>
                    </div>

                    <!-- Daftar Alamat -->
                    <div class="row g-4 mb-5">
                        @foreach($addresses as $address)
                            <div class="col-md-6 col-lg-4 position-relative">
                                <div class="address-card p-4 border rounded-3 h-100 bg-light
                                    {{ $address['is_primary'] ? 'border-primary bg-primary-light' : '' }}"
                                    style="transition: all 0.3s ease;">
                                    <!-- Badge Utama dengan Padding yang Lebih Aman -->
                                    @if($address['is_primary'])
                                        <div class="position-absolute top-0 start-0 m-3">
                                            <span class="badge bg-primary py-2 px-3">
                                                <i class="fas fa-star me-1"></i>Utama
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Header Card dengan Margin Top untuk Badge -->
                                    <div class="d-flex justify-content-between align-items-start mb-3 pt-2">
                                        <h6 class="fw-semibold mb-0 me-3 {{ $address['is_primary'] ? 'mt-4' : '' }}">{{ $address['name'] }}</h6>
                                        <div class="dropdown dropdown-custom">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown"
                                                    data-bs-boundary="viewport"
                                                    data-bs-reference="parent">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-custom">
                                                <li>
                                                    <a class="dropdown-item edit-address" href="#"
                                                       data-address-id="{{ $address['id'] }}">
                                                        <i class="fas fa-edit me-2"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    @if(!$address['is_primary'])
                                                        <a class="dropdown-item set-primary-address" href="#"
                                                           data-address-id="{{ $address['id'] }}">
                                                            <i class="fas fa-star me-2"></i>Jadikan Utama
                                                        </a>
                                                    @endif
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger delete-address"
                                                       href="#" data-address-id="{{ $address['id'] }}">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Detail Alamat -->
                                    <div class="address-details mt-3">
                                        <p class="fw-semibold mb-2 small text-dark">{{ $address['recipient'] }}</p>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-phone me-2"></i>{{ $address['phone'] }}
                                        </p>
                                        <p class="text-muted small mb-3">
                                            {{ $address['address'] }},<br>
                                            {{ $address['city'] }}, {{ $address['province'] }}<br>
                                            {{ $address['postal_code'] }}
                                        </p>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="mt-auto pt-3">
                                        @if(!$address['is_primary'])
                                            <button class="btn btn-outline-primary btn-sm w-100 set-primary-address"
                                                    data-address-id="{{ $address['id'] }}">
                                                Jadikan Alamat Utama
                                            </button>
                                        @else
                                            <div class="text-center">
                                                <span class="badge bg-success py-2 px-3">
                                                    <i class="fas fa-check me-1"></i>Alamat Utama
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Tambah Alamat Baru Card -->
                        <div class="col-md-6 col-lg-4">
                            <div class="address-card-add p-4 border border-dashed rounded-3 text-center h-100
                                         d-flex flex-column justify-content-center bg-light"
                                 style="transition: all 0.3s ease;">
                                <div class="add-address-icon mb-3">
                                    <i class="fas fa-plus-circle fa-3x text-muted opacity-50"></i>
                                </div>
                                <h6 class="fw-semibold mb-2">Tambah Alamat Baru</h6>
                                <p class="text-muted small mb-3">Tambahkan alamat pengiriman baru untuk kemudahan berbelanja</p>
                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addAddressModal">
                                    <i class="fas fa-plus me-1"></i>Tambah Alamat
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State (jika tidak ada alamat) -->
                    @if(count($addresses) === 0)
                    <div class="text-center py-5 my-5">
                        <div class="empty-address-icon mb-4">
                            <i class="fas fa-map-marker-alt fa-4x text-muted opacity-25"></i>
                        </div>
                        <h3 class="fw-semibold mb-3">Belum Ada Alamat</h3>
                        <p class="text-muted mb-4">Tambahkan alamat pengiriman untuk memudahkan proses belanja Anda</p>
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                            <i class="fas fa-plus me-2"></i>Tambah Alamat Pertama
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Links ke Halaman Lain -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('store.account.profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i>Profil Saya
                        </a>
                        <a href="{{ route('store.account.security') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shield-alt me-2"></i>Pengaturan Keamanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Spacer untuk jarak dengan footer -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5"></div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Alamat -->
    <div class="modal fade" id="addAddressModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold">
                        <i class="me-2"></i>Tambah Alamat Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('store.account.address.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="address_name" class="form-label fw-semibold">Nama Alamat</label>
                                <input type="text" class="form-control" id="address_name" name="name"
                                       placeholder="Contoh: Rumah, Kantor, Apartemen" required>
                                <div class="form-text">Berikan nama yang mudah diingat untuk alamat ini</div>
                            </div>
                            <div class="col-md-6">
                                <label for="recipient" class="form-label fw-semibold">Nama Penerima</label>
                                <input type="text" class="form-control" id="recipient" name="recipient"
                                       placeholder="Nama lengkap penerima" required>
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                       placeholder="Contoh: 081234567890" required>
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                          placeholder="Jl. Nama Jalan No. 123, RT/RW, Kelurahan" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label fw-semibold">Kota/Kabupaten</label>
                                <input type="text" class="form-control" id="city" name="city"
                                       placeholder="Contoh: Jakarta Selatan" required>
                            </div>
                            <div class="col-md-6">
                                <label for="province" class="form-label fw-semibold">Provinsi</label>
                                <input type="text" class="form-control" id="province" name="province"
                                       placeholder="Contoh: DKI Jakarta" required>
                            </div>
                            <div class="col-md-6">
                                <label for="postal_code" class="form-label fw-semibold">Kode Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                       placeholder="Contoh: 12345" required>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4 pt-2">
                                    <input class="form-check-input" type="checkbox" id="is_primary" name="is_primary" value="1">
                                    <label class="form-check-label fw-semibold" for="is_primary">
                                        Jadikan alamat utama
                                    </label>
                                    <div class="form-text">Alamat utama akan digunakan sebagai default pengiriman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Alamat -->
    <div class="modal fade" id="editAddressModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold">
                        <i class="fas fa-edit me-2"></i>Edit Alamat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editAddressForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit_address_name" class="form-label fw-semibold">Nama Alamat</label>
                                <input type="text" class="form-control" id="edit_address_name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_recipient" class="form-label fw-semibold">Nama Penerima</label>
                                <input type="text" class="form-control" id="edit_recipient" name="recipient" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_phone" class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="edit_phone" name="phone" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_address" class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea class="form-control" id="edit_address" name="address" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_city" class="form-label fw-semibold">Kota/Kabupaten</label>
                                <input type="text" class="form-control" id="edit_city" name="city" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_province" class="form-label fw-semibold">Provinsi</label>
                                <input type="text" class="form-control" id="edit_province" name="province" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_postal_code" class="form-label fw-semibold">Kode Pos</label>
                                <input type="text" class="form-control" id="edit_postal_code" name="postal_code" required>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4 pt-2">
                                    <input class="form-check-input" type="checkbox" id="edit_is_primary" name="is_primary" value="1">
                                    <label class="form-check-label fw-semibold" for="edit_is_primary">
                                        Jadikan alamat utama
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Address Modal
            document.querySelectorAll('.edit-address').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const addressId = this.getAttribute('data-address-id');
                    const address = getAddressData(addressId);

                    if (address) {
                        document.getElementById('edit_address_name').value = address.name;
                        document.getElementById('edit_recipient').value = address.recipient;
                        document.getElementById('edit_phone').value = address.phone;
                        document.getElementById('edit_address').value = address.address;
                        document.getElementById('edit_city').value = address.city;
                        document.getElementById('edit_province').value = address.province;
                        document.getElementById('edit_postal_code').value = address.postal_code;
                        document.getElementById('edit_is_primary').checked = address.is_primary;

                        // Set form action
                        document.getElementById('editAddressForm').action = `/store/account/address/${addressId}/update`;

                        // Show modal
                        new bootstrap.Modal(document.getElementById('editAddressModal')).show();
                    }
                });
            });

            // Set Primary Address
            document.querySelectorAll('.set-primary-address').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const addressId = this.getAttribute('data-address-id');

                    if (confirm('Jadikan alamat ini sebagai alamat utama?')) {
                        // Logic untuk set primary address
                        console.log('Set primary address:', addressId);
                        // Implement your API call here
                    }
                });
            });

            // Delete Address
            document.querySelectorAll('.delete-address').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const addressId = this.getAttribute('data-address-id');

                    if (confirm('Apakah Anda yakin ingin menghapus alamat ini?')) {
                        // Logic untuk delete address
                        fetch(`/store/account/address/${addressId}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus alamat');
                        });
                    }
                });
            });

            // Helper function to get address data (dummy implementation)
            function getAddressData(addressId) {
                const addresses = @json($addresses);
                return addresses.find(addr => addr.id == addressId);
            }

            // Form validation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });

            // Custom dropdown handling
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    // Close other open dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== this.nextElementSibling) {
                            menu.classList.remove('show');
                        }
                    });
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-custom')) {
                    document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
        });
    </script>
@endsection
