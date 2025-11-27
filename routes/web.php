<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreAccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/features', [LandingController::class, 'features'])->name('features');
Route::get('/pricing', [LandingController::class, 'pricing'])->name('pricing');

// Public Routes - Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Password Reset Routes (Simplified - No Email)
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'checkEmail'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ============================================================
// STORE ROUTES - Public (Bisa diakses tanpa login)
// ============================================================
Route::prefix('store')->name('store.')->group(function () {
    // Homepage & Search
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::get('/search', [StoreController::class, 'search'])->name('search');

    // Categories - MENGGUNAKAN SLUG
    Route::get('/categories', [StoreController::class, 'categories'])->name('categories');
    Route::get('/category/{slug}', [StoreController::class, 'categoryProducts'])->name('category-products');

    // Product Detail
    Route::get('/product/{id}', [StoreController::class, 'productDetail'])->name('product.detail');

    // Cart & Wishlist (Public, bisa tanpa login dengan session)
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
    Route::get('/cart/summary', [CartController::class, 'getCartSummary'])->name('cart.summary');
    // Wishlist Routes
    Route::post('/wishlist/toggle', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/wishlist/count', [App\Http\Controllers\WishlistController::class, 'getCount'])->name('wishlist.count');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    

    // Checkout & Orders (Butuh login)
    Route::middleware(['auth'])->group(function () {
        Route::get('/checkout', [StoreController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/process', [StoreController::class, 'processCheckout'])->name('checkout.process');
        Route::get('/orders', [StoreController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [StoreController::class, 'orderDetail'])->name('orders.detail');
    });

    

    // Account Management (Butuh login)
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [StoreAccountController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [StoreAccountController::class, 'updateProfile'])->name('profile.update');

        Route::get('/addresses', [StoreAccountController::class, 'addresses'])->name('addresses');
        Route::post('/address/add', [StoreAccountController::class, 'addAddress'])->name('address.add');
        Route::put('/address/{id}/update', [StoreAccountController::class, 'updateAddress'])->name('address.update');
        Route::delete('/address/{id}/delete', [StoreAccountController::class, 'deleteAddress'])->name('address.delete');
        Route::post('/address/{id}/set-default', [StoreAccountController::class, 'setDefaultAddress'])->name('address.set-default');

        Route::get('/security', [StoreAccountController::class, 'security'])->name('security');
        Route::post('/password/update', [StoreAccountController::class, 'updatePassword'])->name('password.update');
    });
});

// ============================================================
// PROTECTED ROUTES - Butuh Login
// ============================================================
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard - otomatis redirect berdasarkan role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ============================================================
    // PENJUAL ROUTES
    // ============================================================
    Route::middleware(['role:penjual'])->group(function () {
        // Profile & Settings
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/update-all', [SettingsController::class, 'updateAll'])->name('settings.update-all');

        // PRODUCT ROUTES
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/filter', [ProductController::class, 'filter'])->name('filter');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::post('/{id}', [ProductController::class, 'update'])->name('update'); // POST untuk support FormData
            Route::put('/{id}', [ProductController::class, 'update']); // PUT fallback
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });

        // ORDER ROUTES
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/incoming', [OrderController::class, 'incoming'])->name('incoming');
            Route::get('/outgoing', [OrderController::class, 'outgoing'])->name('outgoing');
            Route::get('/{id}', [OrderController::class, 'show'])->name('show');
            Route::post('/{id}/accept', [OrderController::class, 'accept'])->name('accept');
            Route::post('/{id}/reject', [OrderController::class, 'reject'])->name('reject');
            Route::post('/{id}/process', [OrderController::class, 'process'])->name('process');
            Route::post('/{id}/track', [OrderController::class, 'track'])->name('track');
            Route::post('/{id}/ship', [OrderController::class, 'ship'])->name('ship');
            Route::post('/{id}/mark-delivered', [OrderController::class, 'markDelivered'])->name('mark-delivered');
            Route::post('/{id}/complete', [OrderController::class, 'complete'])->name('complete');
        });

        // PAYMENT ROUTES
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('/{id}', [PaymentController::class, 'detail'])->name('detail');
        });
    });

    // ============================================================
    // PEMBELI ROUTES (Optional - jika ada route khusus pembeli)
    // ============================================================
    Route::middleware(['role:pembeli'])->group(function () {
        // Tambahan routes khusus pembeli jika diperlukan
    });
});

// ============================================================
// UTILITY ROUTES
// ============================================================
// Route untuk serve CSS
Route::get('/css/{file}', function ($file) {
    $path = resource_path("css/{$file}");
    if (!File::exists($path)) {
        abort(404);
    }
    $fileContent = File::get($path);
    $response = Response::make($fileContent, 200);
    $response->header('Content-Type', 'text/css');
    return $response;
});
