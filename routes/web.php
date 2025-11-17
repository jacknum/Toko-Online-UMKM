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

// Routes untuk Pembeli (Store) - Bisa diakses tanpa login
Route::prefix('store')->name('store.')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('home');
    Route::get('/search', [StoreController::class, 'search'])->name('search');
    Route::get('/product/{id}', [StoreController::class, 'productDetail'])->name('product.detail');
    Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/checkout', [StoreController::class, 'checkout'])->name('checkout');
    Route::get('/categories', [StoreController::class, 'categories'])->name('categories');
    Route::get('/category/{category}', [StoreController::class, 'categoryProducts'])->name('category.products');

    // Route langsung untuk profile dan addresses (tanpa /account)
    Route::get('/profile', [StoreAccountController::class, 'profile'])->name('profile')->middleware(['auth']);
    Route::get('/addresses', [StoreAccountController::class, 'addresses'])->name('addresses')->middleware(['auth']);
    Route::get('/security', [StoreAccountController::class, 'security'])->name('security')->middleware(['auth']);

    // Akun pengguna - butuh login
    Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
        Route::get('/profile', [StoreAccountController::class, 'profile'])->name('profile');
        Route::get('/addresses', [StoreAccountController::class, 'addresses'])->name('addresses');
        Route::get('/security', [StoreAccountController::class, 'security'])->name('security');
        Route::post('/profile/update', [StoreAccountController::class, 'updateProfile'])->name('profile.update');
        Route::post('/password/update', [StoreAccountController::class, 'updatePassword'])->name('password.update');
        Route::post('/address/add', [StoreAccountController::class, 'addAddress'])->name('address.add');
        Route::delete('/address/{id}/delete', [StoreAccountController::class, 'deleteAddress'])->name('address.delete');
    });
});

// Protected Routes - Hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard - otomatis redirect berdasarkan role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes khusus Penjual
    Route::middleware(['role:penjual'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/update-all', [SettingsController::class, 'updateAll'])->name('settings.update-all');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        // CREATE PRODUCT
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        // EDIT PRODUCT
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        // DELETE PRODUCT
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/orders/incoming', [OrderController::class, 'incoming'])->name('orders.incoming');
        Route::get('/orders/outgoing', [OrderController::class, 'outgoing'])->name('orders.outgoing');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/accept', [OrderController::class, 'accept'])->name('orders.accept');
        Route::post('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
        Route::post('/orders/{id}/process', [OrderController::class, 'process'])->name('orders.process');
        Route::post('/orders/{id}/track', [OrderController::class, 'track'])->name('orders.track');
        Route::post('/orders/{id}/ship', [OrderController::class, 'ship'])->name('orders.ship');
        Route::post('/orders/{id}/mark-delivered', [OrderController::class, 'markDelivered'])->name('orders.mark-delivered');
        Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{id}', [PaymentController::class, 'detail'])->name('payments.detail');
        Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
    });

    // Routes khusus Pembeli
    Route::middleware(['role:pembeli'])->group(function () {
        // Tambahan routes khusus pembeli jika diperlukan
    });
});

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
