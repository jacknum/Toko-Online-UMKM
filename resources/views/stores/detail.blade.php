@extends('layouts.store')

@section('title', $product->name . ' - Toko UMKM')

@section('content')
<!-- Product Detail Section -->
<section class="product-detail py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="product-breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('store.categories') }}">Kategori</a></li>
                <li class="breadcrumb-item"><a href="{{ route('store.category-products', \Illuminate\Support\Str::slug($product->category)) }}">{{ $product->category }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Main Product Container -->
        <div class="product-main-container bg-white rounded shadow-sm p-4 mb-5">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-5">
                    <div class="product-gallery">
                        <!-- Main Image -->
                        <div class="main-image mb-3">
                            <img src="{{ $product->images[0] ?? 'https://via.placeholder.com/500x500' }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid rounded"
                                 id="mainProductImage"
                                 onerror="this.src='https://via.placeholder.com/500x500'">
                        </div>

                        <!-- Thumbnail Images -->
                        @if(count($product->images) > 1)
                        <div class="thumbnail-images">
                            <div class="row g-2">
                                @foreach($product->images as $index => $image)
                                <div class="col-3">
                                    <img src="{{ $image }}"
                                         alt="{{ $product->name }} {{ $index + 1 }}"
                                         class="img-fluid rounded thumbnail {{ $index === 0 ? 'active' : '' }}"
                                         data-main-image="{{ $image }}"
                                         onerror="this.src='https://via.placeholder.com/100x100'">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-7">
                    <div class="product-info ps-lg-4">
                        <!-- Product Header -->
                        <div class="product-header mb-3">
                            <h1 class="product-title h3 fw-bold">{{ $product->name }}</h1>
                            <div class="product-rating mb-2 d-flex align-items-center">
                                <div class="stars text-warning me-2">
                                    @php
                                        $rating = $product->rating ?? 0;
                                        $fullStars = floor($rating);
                                        $halfStar = $rating - $fullStars >= 0.5;
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                    @endphp

                                    @for($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    @if($halfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif

                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                                <span class="rating-text text-muted small">({{ $product->review_count ?? 0 }} ulasan)</span>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section mb-4 p-3 bg-light rounded">
                            @if($product->discount_percent > 0)
                            <div class="discount-badge mb-2">
                                <span class="badge bg-danger">-{{ $product->discount_percent }}%</span>
                            </div>
                            @endif
                            <div class="current-price h4 fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            @if($product->original_price && $product->original_price > $product->price)
                            <div class="original-price text-muted text-decoration-line-through">Rp {{ number_format($product->original_price, 0, ',', '.') }}</div>
                            @endif
                        </div>

                        <!-- Product Description -->
                        <div class="product-description mb-4">
                            <h5 class="fw-semibold mb-2">Deskripsi Produk</h5>
                            <p class="mb-2">{{ $product->description ?? 'Produk berkualitas dari UMKM lokal' }}</p>
                            @if($product->long_description && $product->long_description !== $product->description)
                            <p class="text-muted">{{ $product->long_description }}</p>
                            @endif
                        </div>

                        <!-- Stock & Seller Info -->
                        <div class="product-meta mb-4">
                            <div class="stock-info mb-2">
                                <i class="fas fa-box me-2 {{ $product->stock > 10 ? 'text-success' : 'text-warning' }}"></i>
                                <span>Stok: <strong>{{ $product->stock }} unit</strong></span>
                                @if($product->stock <= 10 && $product->stock > 0)
                                <span class="badge bg-warning text-dark ms-2">Stok Terbatas!</span>
                                @endif
                            </div>
                            <div class="seller-info d-flex align-items-center">
                                <i class="fas fa-store me-2 text-primary"></i>
                                <span>Dijual oleh: <strong>{{ $product->seller['name'] }}</strong></span>
                                <span class="seller-rating ms-2 badge bg-warning text-dark">
                                    <i class="fas fa-star"></i> {{ $product->seller['rating'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Add to Cart Section -->
                        <div class="add-to-cart-section p-3 bg-light rounded">
                            <div class="quantity-selector mb-3">
                                <label class="form-label fw-medium">Jumlah:</label>
                                <div class="quantity-controls d-flex align-items-center" style="max-width: 150px;">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" id="decreaseQty">-</button>
                                    <input type="number" class="form-control quantity-input text-center mx-2" value="1" min="1" max="{{ $product->stock }}" id="productQty">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" id="increaseQty">+</button>
                                </div>
                            </div>

                            <div class="action-buttons d-flex flex-wrap gap-2">
                                <button class="btn btn-primary btn-add-to-cart flex-grow-1 py-2" data-product-id="{{ $product->id }}">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                                <button class="btn btn-outline-danger btn-wishlist py-2" data-product-id="{{ $product->id }}">
                                    <i class="far fa-heart me-2 align-center"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Product Features -->
                        <div class="product-features mt-4 d-flex flex-wrap gap-3">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shipping-fast text-primary me-2"></i>
                                <span class="small">Gratis Ongkir</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span class="small">Garansi 30 Hari</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-undo text-primary me-2"></i>
                                <span class="small">Pengembalian Mudah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="product-tabs bg-white rounded shadow-sm">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">
                                Spesifikasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                                Ulasan ({{ $product->review_count ?? 0 }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">
                                Pengiriman
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="productTabsContent">
                        <!-- Specifications Tab -->
                        <div class="tab-pane fade show active" id="specs" role="tabpanel">
                            <div class="specifications-table">
                                <table class="table">
                                    <tbody>
                                        @foreach($product->specifications as $key => $value)
                                        <tr>
                                            <td class="spec-key fw-medium" style="width: 30%;">{{ $key }}</td>
                                            <td class="spec-value">{{ $value }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="reviews-section">
                                <div class="rating-summary mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-center">
                                            <div class="average-rating">
                                                <h2 class="fw-bold">{{ $product->rating ?? 0 }}</h2>
                                                <div class="stars text-warning mb-2">
                                                    @for($i = 0; $i < $fullStars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor

                                                    @if($halfStar)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @endif

                                                    @for($i = 0; $i < $emptyStars; $i++)
                                                        <i class="far fa-star"></i>
                                                    @endfor
                                                </div>
                                                <p class="text-muted">{{ $product->review_count ?? 0 }} ulasan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sample Reviews -->
                                <div class="review-list">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Tab -->
                        <div class="tab-pane fade" id="shipping" role="tabpanel">
                            <div class="shipping-info">
                                <h5 class="fw-semibold mb-3">Informasi Pengiriman</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Gratis ongkir untuk pembelian di atas Rp 200.000</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Estimasi pengiriman: 2-5 hari kerja</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Dikirim dari: {{ $product->seller['location'] }}</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kurir: JNE, TIKI, POS Indonesia, GoSend</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts && $relatedProducts->count() > 0)
        <section class="related-products mt-5">
            <h3 class="section-title mb-4">Produk Terkait</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="store-product-card">
                        <a href="{{ route('store.product.detail', $relatedProduct->id) }}" class="product-link">
                            <div class="store-product-image">
                                <img src="{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}" class="img-fluid" onerror="this.src='https://via.placeholder.com/300x300'">
                                @if($relatedProduct->discount_percent > 0)
                                <div class="store-product-badge discount">-{{ $relatedProduct->discount_percent }}%</div>
                                @endif
                            </div>
                        </a>
                        <button class="store-wishlist-btn" data-product-id="{{ $relatedProduct->id }}">
                            <i class="far fa-heart"></i>
                        </button>
                        <div class="store-product-info">
                            <a href="{{ route('store.product.detail', $relatedProduct->id) }}" class="product-link">
                                <h5 class="store-product-title">{{ $relatedProduct->name }}</h5>
                            </a>
                            <div class="store-product-price">
                                <span class="store-price-current">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="store-product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($relatedProduct->rating ?? 0))
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <button class="btn store-add-to-cart" data-product-id="{{ $relatedProduct->id }}">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Tambah Keranjang
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</section>

<style>
/* Thumbnail styles */
.thumbnail {
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.thumbnail.active {
    border-color: #0984e3;
}

.thumbnail:hover {
    border-color: #74b9ff;
}

.main-image img {
    max-height: 500px;
    object-fit: contain;
    width: 100%;
}

.quantity-btn {
    width: 40px;
    height: 40px;
}

.quantity-input {
    width: 60px;
}

/* FIX: Wishlist button pada detail produk - BUNDAR SEMPURNA */
.btn-wishlist {
    width: 45px !important;
    height: 45px !important;
    min-width: 45px !important;
    min-height: 45px !important;
    border-radius: 50% !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
}

.btn-wishlist i {
    font-size: 18px;
    align-items: center !important;
    justify-content: center !important;
    margin-left: 7px !important;
}

.btn-wishlist:hover {
    background: #ff4757 !important;
    color: white !important;
}

/* Product card styles for related products */
.store-product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
}

.store-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.store-product-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.store-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.store-product-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ff4757;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
}

/* Wishlist button pada related products */
.store-wishlist-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: white;
    border: none;
    width: 35px;
    height: 35px;
    min-width: 35px;
    min-height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 0;
}

.store-wishlist-btn:hover {
    background: #ff4757;
    color: white;
}

.store-product-info {
    padding: 15px;
}

.store-product-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2d3436;
}

.store-product-price {
    margin-bottom: 8px;
}

.store-price-current {
    font-size: 16px;
    font-weight: 700;
    color: #ff6348;
}

.store-product-rating {
    margin-bottom: 12px;
}

.store-product-rating i {
    color: #ffd700;
    font-size: 12px;
}

.store-add-to-cart {
    width: 100%;
    background: #0984e3;
    color: white;
    border: none;
    padding: 8px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.store-add-to-cart:hover {
    background: #0770c7;
}

.product-link {
    text-decoration: none;
    color: inherit;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .action-buttons {
        flex-direction: column;
    }

    .btn-wishlist {
        width: 45px !important;
        height: 45px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail image click handler
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainProductImage');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.getAttribute('data-main-image');
        });
    });

    // Quantity controls
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const quantityInput = document.getElementById('productQty');
    const maxStock = {{ $product->stock }};

    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    }

    if (increaseBtn) {
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
            }
        });
    }

    // Add to cart functionality
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const quantity = parseInt(quantityInput.value);
            const productId = this.getAttribute('data-product-id');

            // TODO: Implement actual add to cart AJAX
            alert(`Produk "{{ $product->name }}" sebanyak ${quantity} item ditambahkan ke keranjang!`);
        });
    }

    // Wishlist functionality
    const wishlistBtn = document.querySelector('.btn-wishlist');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const icon = this.querySelector('i');

            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                alert(`Produk "{{ $product->name }}" ditambahkan ke wishlist!`);
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                alert(`Produk "{{ $product->name }}" dihapus dari wishlist!`);
            }
        });
    }
});
</script>
@endsection
