@extends('layouts.app')

@section('title', 'Pengaturan Sistem - ')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">Pengaturan Sistem</h1>
                <p class="mb-0 text-muted">Kelola konfigurasi dan preferensi sistem</p>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" id="saveAllSettings">
                    <i class="fas fa-save me-2"></i>Simpan Semua Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body py-3">
                    <ul class="nav nav-pills nav-fill" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="fas fa-cog me-2"></i>Umum
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
                                <i class="fas fa-shield-alt me-2"></i>Keamanan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">
                                <i class="fas fa-bell me-2"></i>Notifikasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab">
                                <i class="fas fa-palette me-2"></i>Tampilan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="integration-tab" data-bs-toggle="tab" data-bs-target="#integration" type="button" role="tab">
                                <i class="fas fa-plug me-2"></i>Integrasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced" type="button" role="tab">
                                <i class="fas fa-tools me-2"></i>Lanjutan
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="settingsTabContent">
                
                <!-- General Settings -->
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="card card-custom shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cog text-primary me-2"></i>
                                Pengaturan Umum
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="generalSettingsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Aplikasi</label>
                                        <input type="text" class="form-control" name="app_name" 
                                               value="{{ config('app.name', 'Laravel') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Administrator</label>
                                        <input type="email" class="form-control" name="admin_email" 
                                               value="{{ old('admin_email', 'admin@example.com') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Zona Waktu</label>
                                        <select class="form-select" name="timezone" required>
                                            <option value="Asia/Jakarta" selected>WIB (Asia/Jakarta)</option>
                                            <option value="Asia/Makassar">WITA (Asia/Makassar)</option>
                                            <option value="Asia/Jayapura">WIT (Asia/Jayapura)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Bahasa Default</label>
                                        <select class="form-select" name="locale" required>
                                            <option value="id" selected>Bahasa Indonesia</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Deskripsi Aplikasi</label>
                                        <textarea class="form-control" name="app_description" rows="3" 
                                                  placeholder="Deskripsi singkat tentang aplikasi">{{ old('app_description') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="maintenance_mode" 
                                                   id="maintenanceMode" value="1">
                                            <label class="form-check-label" for="maintenanceMode">
                                                Mode Maintenance
                                            </label>
                                        </div>
                                        <div class="form-text">
                                            Aktifkan untuk menghentikan sementara akses pengguna ke aplikasi
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="tab-pane fade" id="security" role="tabpanel">
                    <div class="card card-custom shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-shield-alt text-success me-2"></i>
                                Pengaturan Keamanan
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="securitySettingsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">Kebijakan Kata Sandi</h6>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="password_uppercase" 
                                                   id="passwordUppercase" value="1" checked>
                                            <label class="form-check-label" for="passwordUppercase">
                                                Harus mengandung huruf besar
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="password_numbers" 
                                                   id="passwordNumbers" value="1" checked>
                                            <label class="form-check-label" for="passwordNumbers">
                                                Harus mengandung angka
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="password_special" 
                                                   id="passwordSpecial" value="1">
                                            <label class="form-check-label" for="passwordSpecial">
                                                Harus mengandung karakter khusus
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Panjang Minimal Kata Sandi</label>
                                        <input type="number" class="form-control" name="password_min_length" 
                                               value="8" min="6" max="20">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Masa Berlaku Kata Sandi (hari)</label>
                                        <input type="number" class="form-control" name="password_expiry_days" 
                                               value="90" min="30" max="365">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Autentikasi</h6>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="two_factor_auth" 
                                                   id="twoFactorAuth" value="1">
                                            <label class="form-check-label" for="twoFactorAuth">
                                                Autentikasi Dua Faktor
                                            </label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="login_attempts_limit" 
                                                   id="loginAttemptsLimit" value="1" checked>
                                            <label class="form-check-label" for="loginAttemptsLimit">
                                                Batas Percobaan Login
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Maksimal Percobaan Login</label>
                                        <input type="number" class="form-control" name="max_login_attempts" 
                                               value="5" min="3" max="10">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Waktu Blokir (menit)</label>
                                        <input type="number" class="form-control" name="lockout_time" 
                                               value="30" min="5" max="1440">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="tab-pane fade" id="notifications" role="tabpanel">
                    <div class="card card-custom shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-bell text-warning me-2"></i>
                                Pengaturan Notifikasi
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="notificationSettingsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">Email Notifikasi</h6>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="email_notifications" 
                                                   id="emailNotifications" value="1" checked>
                                            <label class="form-check-label" for="emailNotifications">
                                                Aktifkan Notifikasi Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">SMTP Host</label>
                                        <input type="text" class="form-control" name="smtp_host" 
                                               value="{{ old('smtp_host', 'smtp.gmail.com') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">SMTP Port</label>
                                        <input type="number" class="form-control" name="smtp_port" 
                                               value="{{ old('smtp_port', '587') }}">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Jenis Notifikasi</h6>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="notify_new_users" 
                                                   id="notifyNewUsers" value="1" checked>
                                            <label class="form-check-label" for="notifyNewUsers">
                                                Pengguna Baru
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="notify_errors" 
                                                   id="notifyErrors" value="1" checked>
                                            <label class="form-check-label" for="notifyErrors">
                                                Error Sistem
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="notify_backups" 
                                                   id="notifyBackups" value="1">
                                            <label class="form-check-label" for="notifyBackups">
                                                Backup Selesai
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Push Notifikasi</h6>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="push_notifications" 
                                                   id="pushNotifications" value="1">
                                            <label class="form-check-label" for="pushNotifications">
                                                Aktifkan Push Notifikasi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Appearance Settings -->
                <div class="tab-pane fade" id="appearance" role="tabpanel">
                    <div class="card card-custom shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-palette text-info me-2"></i>
                                Pengaturan Tampilan
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="appearanceSettingsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tema Aplikasi</label>
                                        <select class="form-select" name="theme" required>
                                            <option value="light" selected>Tema Terang</option>
                                            <option value="dark">Tema Gelap</option>
                                            <option value="auto">Sesuai Sistem</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Warna Primer</label>
                                        <input type="color" class="form-control form-control-color" name="primary_color" 
                                               value="#4361ee" title="Pilih warna primer">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Logo & Branding</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Logo Aplikasi</label>
                                        <input type="file" class="form-control" name="app_logo" accept="image/*">
                                        <div class="form-text">Format: PNG, JPG, SVG. Maksimal 2MB</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Favicon</label>
                                        <input type="file" class="form-control" name="favicon" accept="image/*">
                                        <div class="form-text">Format: ICO, PNG. Maksimal 500KB</div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Tata Letak</h6>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="fixed_header" 
                                                   id="fixedHeader" value="1" checked>
                                            <label class="form-check-label" for="fixedHeader">
                                                Header Tetap
                                            </label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="sidebar_collapsed" 
                                                   id="sidebarCollapsed" value="1">
                                            <label class="form-check-label" for="sidebarCollapsed">
                                                Sidebar Terlipat Default
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Integration Settings -->
                <div class="tab-pane fade" id="integration" role="tabpanel">
                    <div class="card card-custom shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-plug text-danger me-2"></i>
                                Pengaturan Integrasi
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="integrationSettingsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">API Settings</h6>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="api_enabled" 
                                                   id="apiEnabled" value="1" checked>
                                            <label class="form-check-label" for="apiEnabled">
                                                Aktifkan API
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">API Key</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="api_key" 
                                                   value="{{ Str::random(32) }}" readonly>
                                            <button class="btn btn-outline-secondary" type="button" id="generateApiKey">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Rate Limit (per minute)</label>
                                        <input type="number" class="form-control" name="api_rate_limit" 
                                               value="60" min="10" max="1000">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Third-Party Integrations</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Google Analytics ID</label>
                                        <input type="text" class="form-control" name="google_analytics_id" 
                                               placeholder="UA-XXXXXXXXX-X">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Facebook Pixel ID</label>
                                        <input type="text" class="form-control" name="facebook_pixel_id" 
                                               placeholder="XXXXXXXXXXXXXXX">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Advanced Settings -->
                <div class="tab-pane fade" id="advanced" role="tabpanel">
                    <div class="card card-custom shadow">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-tools text-secondary me-2"></i>
                                Pengaturan Lanjutan
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="advancedSettingsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">Database & Backup</h6>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="auto_backup" 
                                                   id="autoBackup" value="1" checked>
                                            <label class="form-check-label" for="autoBackup">
                                                Backup Otomatis
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Interval Backup</label>
                                        <select class="form-select" name="backup_interval">
                                            <option value="daily" selected>Harian</option>
                                            <option value="weekly">Mingguan</option>
                                            <option value="monthly">Bulanan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Maksimal Backup</label>
                                        <input type="number" class="form-control" name="max_backups" 
                                               value="30" min="5" max="100">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <h6 class="mb-3">Cache & Performance</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Driver Cache</label>
                                        <select class="form-select" name="cache_driver">
                                            <option value="file" selected>File</option>
                                            <option value="redis">Redis</option>
                                            <option value="memcached">Memcached</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Cache Lifetime (menit)</label>
                                        <input type="number" class="form-control" name="cache_lifetime" 
                                               value="60" min="1" max="1440">
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Peringatan:</strong> Pengaturan ini hanya untuk administrator sistem.
                                            Perubahan yang tidak tepat dapat mempengaruhi performa aplikasi.
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                <h5 class="mb-2">Menyimpan Pengaturan...</h5>
                <p class="text-muted mb-0">Harap tunggu sebentar</p>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-pills .nav-link {
        border-radius: 10px;
        margin: 0 2px;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .nav-pills .nav-link:not(.active) {
        background-color: #f8f9fa;
        color: #6c757d;
    }
    
    .nav-pills .nav-link:not(.active):hover {
        background-color: #e9ecef;
        color: #495057;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 1.25rem 1.5rem;
    }
    
    .card-title {
        color: #495057;
        font-weight: 600;
    }
    
    .form-check-input:checked {
        background-color: #4361ee;
        border-color: #4361ee;
    }
    
    .form-control-color {
        height: 45px;
        padding: 5px;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate API Key
        document.getElementById('generateApiKey').addEventListener('click', function() {
            const apiKeyInput = document.querySelector('input[name="api_key"]');
            const newApiKey = generateApiKey(32);
            apiKeyInput.value = newApiKey;
            showAlert('success', 'API Key berhasil digenerate!');
        });

        // Save All Settings
        document.getElementById('saveAllSettings').addEventListener('click', function() {
            saveAllSettings();
        });

        // Form submission handlers
        const forms = document.querySelectorAll('form[id$="SettingsForm"]');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                saveFormSettings(this);
            });
        });

        // Utility Functions
        function generateApiKey(length) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        function saveFormSettings(form) {
            const formData = new FormData(form);
            const loadingModal = showLoadingModal();
            
            // Simulate API call to Laravel backend
            setTimeout(() => {
                loadingModal.hide();
                showAlert('success', 'Pengaturan berhasil disimpan!');
                
                // In real application, you would use:
                // fetch('{{ route('settings.update') }}', {
                //     method: 'POST',
                //     body: formData,
                //     headers: {
                //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     }
                // })
                // .then(response => response.json())
                // .then(data => {
                //     loadingModal.hide();
                //     if (data.success) {
                //         showAlert('success', data.message);
                //     } else {
                //         showAlert('error', data.message);
                //     }
                // })
                // .catch(error => {
                //     loadingModal.hide();
                //     showAlert('error', 'Terjadi kesalahan saat menyimpan pengaturan');
                // });
                
            }, 1500);
        }

        function saveAllSettings() {
            const loadingModal = showLoadingModal();
            let hasError = false;
            
            // Collect all form data
            const allFormData = new FormData();
            forms.forEach((form, index) => {
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    allFormData.append(key, value);
                }
            });
            
            // Simulate API call to save all settings
            setTimeout(() => {
                loadingModal.hide();
                if (!hasError) {
                    showAlert('success', 'Semua pengaturan berhasil disimpan!');
                } else {
                    showAlert('error', 'Beberapa pengaturan gagal disimpan');
                }
                
                // In real application:
                // fetch('{{ route('settings.update-all') }}', {
                //     method: 'POST',
                //     body: allFormData,
                //     headers: {
                //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     }
                // })
                // .then(response => response.json())
                // .then(data => {
                //     loadingModal.hide();
                //     if (data.success) {
                //         showAlert('success', data.message);
                //     } else {
                //         showAlert('error', data.message);
                //     }
                // });
                
            }, 2000);
        }

        function showLoadingModal() {
            const modal = new bootstrap.Modal(document.getElementById('loadingModal'));
            modal.show();
            return modal;
        }

        function showAlert(type, message) {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.alert-dismissible.position-fixed');
            existingAlerts.forEach(alert => alert.remove());
            
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
            alertDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle me-2"></i>
                    <div>${message}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.parentNode.removeChild(alertDiv);
                }
            }, 5000);
        }

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection