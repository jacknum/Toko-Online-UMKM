<!-- Modals -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <div class="success-animation">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <h4 class="modal-title mb-3 text-success">Berhasil Ditambahkan!</h4>
                <p class="text-muted mb-4">Produk telah ditambahkan ke keranjang belanja Anda</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Lanjut Belanja</button>
                    <a href="{{ url('/store/cart') }}" class="btn btn-primary">Lihat Keranjang</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cartRemoveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <div class="remove-animation">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
                <h4 class="modal-title mb-3 text-danger">Dihapus dari Keranjang!</h4>
                <p class="text-muted mb-4">Produk telah dihapus dari keranjang belanja Anda</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ url('/store/cart') }}" class="btn btn-danger">Lihat Keranjang</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <div class="heart-animation">
                        <i class="fas fa-heart"></i>
                    </div>
                </div>
                <h4 class="modal-title mb-3 text-danger">Ditambahkan ke Wishlist!</h4>
                <p class="text-muted mb-4">Produk telah disimpan ke daftar keinginan Anda</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Lanjut Belanja</button>
                    <a href="{{ url('/store/wishlist') }}" class="btn btn-danger">Lihat Wishlist</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="wishlistRemoveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <div class="heart-remove-animation">
                        <i class="fas fa-heart-broken"></i>
                    </div>
                </div>
                <h4 class="modal-title mb-3 text-secondary">Dihapus dari Wishlist!</h4>
                <p class="text-muted mb-4">Produk telah dihapus dari daftar keinginan Anda</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ url('/store/wishlist') }}" class="btn btn-secondary">Lihat Wishlist</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animation Base */
.success-animation, .remove-animation, .heart-animation, .heart-remove-animation {
    width: 80px; height: 80px; margin: 0 auto;
}

.success-animation i { font-size: 4rem; color: #28a745; animation: successPop 0.6s ease; }
.remove-animation i { font-size: 4rem; color: #dc3545; animation: removePop 0.6s ease; }
.heart-animation i { font-size: 4rem; color: #dc3545; animation: heartBeat 0.6s ease; }
.heart-remove-animation i { font-size: 4rem; color: #6c757d; animation: heartBreak 0.8s ease; }

@keyframes successPop {
    0% { transform: scale(0.5); opacity: 0; }
    70% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes removePop {
    0% { transform: scale(0.5) rotate(0deg); opacity: 0; }
    50% { transform: scale(1.3) rotate(180deg); }
    100% { transform: scale(1) rotate(360deg); opacity: 1; }
}

@keyframes heartBeat {
    0% { transform: scale(1); }
    25% { transform: scale(1.3); }
    50% { transform: scale(1.1); }
    75% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

@keyframes heartBreak {
    0% { transform: scale(1) rotate(0deg); color: #dc3545; }
    25% { transform: scale(1.2) rotate(-15deg); color: #ff6b7a; }
    50% { transform: scale(1.1) rotate(15deg); color: #ff6b7a; }
    75% { transform: scale(0.8) rotate(-10deg); color: #6c757d; opacity: 0.7; }
    100% { transform: scale(1) rotate(0deg); color: #6c757d; opacity: 1; }
}

/* Button States */
.store-wishlist-btn.active i { color: #dc3545 !important; animation: heartPop 0.3s ease; }
.store-add-to-cart.added { background: #28a745 !important; animation: cartPulse 0.5s ease; }
.store-add-to-cart.removing { background: #6c757d !important; animation: cartShrink 0.3s ease; }

@keyframes heartPop { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(1); } }
@keyframes cartPulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
@keyframes cartShrink { 0% { transform: scale(1); } 50% { transform: scale(0.95); } 100% { transform: scale(1); } }

/* Modal & UI Enhancements */
.modal-content { border: none; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
.modal-body { padding: 2.5rem !important; }
.btn { border-radius: 10px; font-weight: 600; padding: 12px 24px; transition: all 0.3s ease; }
.btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }

.store-product-card { transition: all 0.3s ease; }
.store-product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }

.store-badge { animation: badgePulse 2s infinite; }
@keyframes badgePulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.1); } }
</style>

<script>
class ProductManager {
    constructor() {
        this.wishlistState = new Map();
        this.cartState = new Map();
        this.init();
    }

    init() {
        this.bindWishlistEvents();
        this.bindCartEvents();
        this.bindProductCardHover();
        this.autoHideModals();
    }

    bindWishlistEvents() {
        document.querySelectorAll('.store-wishlist-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault(); e.stopPropagation();
                this.toggleWishlist(btn.dataset.productId, btn);
            });
        });
    }

    bindCartEvents() {
        document.querySelectorAll('.store-add-to-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault(); e.stopPropagation();
                this.toggleCart(btn.dataset.productId, btn);
            });
        });
    }

    bindProductCardHover() {
        document.querySelectorAll('.store-product-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
                card.style.boxShadow = '0 15px 30px rgba(0,0,0,0.15)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
            });
        });
    }

    toggleWishlist(productId, button) {
        const isInWishlist = this.wishlistState.get(productId) || false;
        const icon = button.querySelector('i');

        if (!isInWishlist) {
            this.addToWishlist(productId, button, icon);
        } else {
            this.removeFromWishlist(productId, button, icon);
        }
    }

    addToWishlist(productId, button, icon) {
        this.wishlistState.set(productId, true);
        icon.classList.replace('far', 'fas');
        button.classList.add('active');
        this.showModal('wishlistModal');
        this.updateWishlistCount(1);
    }

    removeFromWishlist(productId, button, icon) {
        this.wishlistState.set(productId, false);
        icon.classList.replace('fas', 'far');
        button.classList.remove('active');
        button.classList.add('removing');
        this.showModal('wishlistRemoveModal');
        this.updateWishlistCount(-1);
        setTimeout(() => button.classList.remove('removing'), 300);
    }

    toggleCart(productId, button) {
        const isInCart = this.cartState.get(productId) || false;

        if (!isInCart) {
            this.addToCart(productId, button);
        } else {
            this.removeFromCart(productId, button);
        }
    }

    addToCart(productId, button) {
        this.cartState.set(productId, true);
        button.classList.add('added');
        button.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Keranjang';
        this.showModal('cartModal');
        this.updateCartCount(1);
    }

    removeFromCart(productId, button) {
        this.cartState.set(productId, false);
        button.classList.remove('added');
        button.classList.add('removing');
        button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';
        this.showModal('cartRemoveModal');
        this.updateCartCount(-1);
        setTimeout(() => button.classList.remove('removing'), 300);
    }

    showModal(modalId) {
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }

    updateCartCount(increment) {
        this.updateBadgeCount('.store-nav-icon[href*="cart"] .store-badge', increment);
    }

    updateWishlistCount(increment) {
        this.updateBadgeCount('.store-nav-icon[href*="wishlist"] .store-badge', increment);
    }

    updateBadgeCount(selector, increment) {
        const badge = document.querySelector(selector);
        if (badge) {
            const current = parseInt(badge.textContent) || 0;
            badge.textContent = Math.max(0, current + increment);
            this.animateBadge(badge);
        }
    }

    animateBadge(badge) {
        badge.style.animation = 'none';
        setTimeout(() => badge.style.animation = 'badgePulse 0.6s ease', 10);
    }

    autoHideModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', () => {
                setTimeout(() => bootstrap.Modal.getInstance(modal)?.hide(), 4000);
            });
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => new ProductManager());
</script>
