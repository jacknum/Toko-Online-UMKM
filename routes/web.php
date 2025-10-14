<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Landing Page - Halaman pertama yang dilihat user
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/features', [LandingController::class, 'features'])->name('features');
Route::get('/pricing', [LandingController::class, 'pricing'])->name('pricing');

// Public Routes - Harus diletakkan sebelum middleware auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes - Hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard - akan diarahkan kesini setelah login berhasil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/update-all', [SettingsController::class, 'updateAll'])->name('settings.update-all');

    // Products Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Orders Routes
    Route::get('/orders/incoming', [OrderController::class, 'incoming'])->name('orders.incoming');
    Route::get('/orders/outgoing', [OrderController::class, 'outgoing'])->name('orders.outgoing');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::post('/orders/{id}/process', [OrderController::class, 'process'])->name('orders.process');
    Route::post('/orders/{id}/track', [OrderController::class, 'track'])->name('orders.track');

    // Routes untuk pesanan keluar
    Route::post('/orders/{id}/ship', [OrderController::class, 'ship'])->name('orders.ship');
    Route::post('/orders/{id}/mark-delivered', [OrderController::class, 'markDelivered'])->name('orders.mark-delivered');
    Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');

    // Payments Routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [PaymentController::class, 'detail'])->name('payments.detail');
});
