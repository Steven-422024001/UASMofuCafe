<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CategoryController;

// 1. Rute Publik (Tanpa Login)
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'loginform'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'registerform'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Untuk akses via link

// 2. Rute Terlindungi (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource Routes
    Route::resource('products', ProductController::class);
    Route::post('/products/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    Route::patch('/products/{id}/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    Route::resource('promos', PromoController::class); // Pastikan pakai 'promos' kecil agar sinkron dengan Dashboard
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('category', CategoryController::class);
    
    // Email
    Route::get('/send-email/{to}/{id}', [TransaksiController::class, 'sendEmail']);
});