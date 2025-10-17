@extends('layouts.store')

@section('title', $product['name'] . ' - Toko UMKM')

@section('content')
<!-- Product Detail Section -->
<section class="product-detail">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="product-breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
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
                            <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}" class="img-fluid rounded" id="mainProductImage">
                        </div>

                        <!-- Thumbnail Images -->
                        <div class="thumbnail-images">
                            <div class="row g-2">
                                @foreach($product['images'] as $index => $image)
                                <div class="col-3">
                                    <img src="{{ $image }}"
                                         alt="{{ $product['name'] }} {{ $index + 1 }}"
                                         class="img-fluid rounded thumbnail {{ $index === 0 ? 'active' : '' }}"
                                         data-main-image="{{ $image }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-7">
                    <div class="product-info ps-lg-4">
                        <!-- Product Header -->
                        <div class="product-header mb-3">
                            <h1 class="product-title h3 fw-bold">{{ $product['name'] }}</h1>
                            <div class="product-rating mb-2 d-flex align-items-center">
                                <div class="stars text-warning me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($product['rating']))
                                        <i class="fas fa-star"></i>
                                        @elseif($i == ceil($product['rating']) && !is_int($product['rating']))
                                        <i class="fas fa-star-half-alt"></i>
                                        @else
                                        <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="rating-text text-muted small">({{ $product['review_count'] }} ulasan)</span>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section mb-4 p-3 bg-light rounded">
                            @if($product['discount_percent'] > 0)
                            <div class="discount-badge mb-2">
                                <span class="badge bg-danger">-{{ $product['discount_percent'] }}%</span>
                            </div>
                            @endif
                            <div class="current-price h4 fw-bold text-primary">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>
                            @if($product['original_price'] > $product['price'])
                            <div class="original-price text-muted text-decoration-line-through">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</div>
                            @endif
                        </div>

                        <!-- Product Description -->
                        <div class="product-description mb-4">
                            <h5 class="fw-semibold mb-2">Deskripsi Produk</h5>
                            <p class="mb-2">{{ $product['description'] }}</p>
                            <p class="text-muted">{{ $product['long_description'] }}</p>
                        </div>

                        <!-- Stock & Seller Info -->
                        <div class="product-meta mb-4">
                            <div class="stock-info mb-2">
                                <i class="fas fa-box me-2 text-success"></i>
                                <span>Stok: <strong>{{ $product['stock'] }} unit</strong></span>
                            </div>
                            <div class="seller-info d-flex align-items-center">
                                <i class="fas fa-store me-2 text-primary"></i>
                                <span>Dijual oleh: <strong>{{ $product['seller']['name'] }}</strong></span>
                                <span class="seller-rating ms-2 badge bg-warning text-dark">
                                    <i class="fas fa-star"></i> {{ $product['seller']['rating'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Add to Cart Section -->
                        <div class="add-to-cart-section p-3 bg-light rounded">
                            <div class="quantity-selector mb-3">
                                <label class="form-label fw-medium">Jumlah:</label>
                                <div class="quantity-controls d-flex align-items-center" style="max-width: 150px;">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" id="decreaseQty">-</button>
                                    <input type="number" class="form-control quantity-input text-center mx-2" value="1" min="1" max="{{ $product['stock'] }}" id="productQty">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" id="increaseQty">+</button>
                                </div>
                            </div>

                            <div class="action-buttons d-flex flex-wrap gap-2">
                                <button class="btn btn-primary btn-add-to-cart flex-grow-1 py-2">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                                <button class="btn btn-outline-danger btn-wishlist py-2">
                                    <i class="far fa-heart me-2"></i>
                                    Wishlist
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
                                Ulasan ({{ $product['review_count'] }})
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
                                        @foreach($product['specifications'] as $key => $value)
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
                                                <h2 class="fw-bold">{{ $product['rating'] }}</h2>
                                                <div class="stars text-warning mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($product['rating']))
                                                        <i class="fas fa-star"></i>
                                                        @elseif($i == ceil($product['rating']) && !is_int($product['rating']))
                                                        <i class="fas fa-star-half-alt"></i>
                                                        @else
                                                        <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p class="text-muted">{{ $product['review_count'] }} ulasan</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <!-- Rating distribution can be added here -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Sample Reviews -->
                                <div class="review-list">
                                    <div class="review-item border-bottom pb-3 mb-3">
                                        <div class="review-header d-flex justify-content-between mb-2">
                                            <div class="reviewer-name fw-medium">Customer 1</div>
                                            <div class="review-rating text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="review-text mb-2">Produk sangat bagus, kualitas sesuai dengan harga. Pengiriman cepat!</p>
                                        <div class="review-date text-muted small">2 hari yang lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Tab -->
                        <div class="tab-pane fade" id="shipping" role="tabpanel">
                            <div class="shipping-info">
                                <h5 class="fw-semibold mb-3">Informasi Pengiriman</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas text-success me-2"></i>Gratis ongkir untuk pembelian di atas Rp 200.000</li>
                                    <li class="mb-2"><i class="fas text-success me-2"></i>Estimasi pengiriman: 2-5 hari kerja</li>
                                    <li class="mb-2"><i class="fas text-success me-2"></i>Dikirim dari: {{ $product['seller']['location'] }}</li>
                                    <li class="mb-2"><i class="fas text-success me-2"></i>Kurir: JNE, TIKI, POS Indonesia, GoSend</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(isset($relatedProducts) && count($relatedProducts) > 0)
        <section class="related-products mt-5">
            <div class="container">
                <h3 class="section-title mb-4">Produk Terkait</h3>
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="store-product-card">
                            <div class="store-product-image">
                                <img src="{{ $relatedProduct['image'] }}" alt="{{ $relatedProduct['name'] }}" class="img-fluid">
                                <button class="store-wishlist-btn">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="store-product-info">
                                <h5 class="store-product-title">{{ $relatedProduct['name'] }}</h5>
                                <div class="store-product-price">
                                    <span class="store-price-current">Rp {{ number_format($relatedProduct['price'], 0, ',', '.') }}</span>
                                </div>
                                <div class="store-product-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($relatedProduct['rating']))
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <button class="btn store-add-to-cart">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Tambah Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail image click handler
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainProductImage');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            // Add active class to clicked thumbnail
            this.classList.add('active');
            // Update main image
            mainImage.src = this.getAttribute('data-main-image');
        });
    });

    // Quantity controls
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const quantityInput = document.getElementById('productQty');
    const maxStock = {{ $product['stock'] }};

    decreaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < maxStock) {
            quantityInput.value = currentValue + 1;
        }
    });

    // Add to cart functionality
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    addToCartBtn.addEventListener('click', function() {
        const quantity = parseInt(quantityInput.value);
        // Implement add to cart logic here
        alert(`Produk "${'{{ $product['name'] }}'}" sebanyak ${quantity} item ditambahkan ke keranjang!`);
    });

    // Wishlist functionality
    const wishlistBtn = document.querySelector('.btn-wishlist');
    wishlistBtn.addEventListener('click', function() {
        // Implement wishlist logic here
        alert(`Produk "${'{{ $product['name'] }}'" ditambahkan ke wishlist!`);
    });
});
</script>
@endsection
