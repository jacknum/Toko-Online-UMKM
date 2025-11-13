<div class="col-6 col-md-4 col-lg-3">
    <div class="card product-card h-100 border-0 shadow-sm position-relative" data-product-id="{{ $item['id'] }}">
        <!-- Wishlist Button -->
        <button class="btn-wishlist active" data-product-id="{{ $item['id'] }}">
            <i class="fas fa-heart"></i>
        </button>

        <!-- Product Image -->
        <div class="product-image-wrapper position-relative">
            <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['name'] }}"
                style="height: 200px; object-fit: cover; cursor: pointer;"
                onclick="window.location.href='/store/product/{{ $item['id'] }}'">

            <!-- Product Badges Container -->
            <div class="product-badges">
                @if ($item['discount'])
                    <span class="product-badge discount">-{{ $item['discount'] }}%</span>
                @endif
                @if ($item['is_new'])
                    <span class="product-badge new">Baru</span>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="card-body d-flex flex-column p-3" style="cursor: pointer;" 
             onclick="window.location.href='/store/product/{{ $item['id'] }}'">
            <h6 class="card-title fw-semibold mb-2 line-clamp-2" style="min-height: 48px;">{{ $item['name'] }}</h6>

            <div class="mb-2">
                @if ($item['discount'])
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-danger fw-bold fs-6">Rp
                            {{ number_format($item['discounted_price'], 0, ',', '.') }}</span>
                        <span class="text-muted text-decoration-line-through small">Rp
                            {{ number_format($item['price'], 0, ',', '.') }}</span>
                    </div>
                @else
                    <span class="text-primary fw-bold fs-6">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                @endif
            </div>

            <!-- Rating -->
            <div class="d-flex align-items-center mb-3">
                <div class="rating-stars me-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $item['rating'])
                            <i class="fas fa-star text-warning small"></i>
                        @else
                            <i class="far fa-star text-muted small"></i>
                        @endif
                    @endfor
                </div>
                <small class="text-muted">({{ $item['review_count'] }})</small>
            </div>

            <!-- Stock & Store -->
            <div class="mb-3">
                @if ($item['stock'] > 0)
                    <span class="badge bg-success bg-opacity-10 text-success small">
                        <i class="fas fa-check-circle me-1"></i>Tersedia
                    </span>
                @else
                    <span class="badge bg-danger bg-opacity-10 text-danger small">
                        <i class="fas fa-times-circle me-1"></i>Habis
                    </span>
                @endif
                <small class="text-muted d-block mt-1">{{ $item['store_name'] }}</small>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card-footer border-0 bg-transparent pt-0">
            @if ($item['stock'] > 0)
                <button class="btn btn-primary btn-sm w-100 add-to-cart" 
                        data-product-id="{{ $item['id'] }}"
                        data-in-cart="false">
                    <i class="fas fa-cart-plus me-1"></i>Tambah ke Keranjang
                </button>
            @else
                <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                    <i class="fas fa-bell me-1"></i>Notifikasi Stok
                </button>
            @endif
        </div>
    </div>
</div>

