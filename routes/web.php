<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
