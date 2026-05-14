<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Halaman utama: jika sudah login ke dashboard, jika belum ke halaman login
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

// Semua route di bawah ini hanya bisa diakses jika sudah Login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::get('/reports', [ProductController::class, 'reports']);
    Route::get('/notifications', [ProductController::class, 'notifications']);
    Route::get('/exports', [ProductController::class, 'exports']);
    
    // Fitur Download CSV
    Route::get('/export/products', [ProductController::class, 'exportProducts']);
    Route::get('/export/transactions', [ProductController::class, 'exportTransactions']);
    Route::get('/export/low-stock', [ProductController::class, 'exportLowStock']);
});

require __DIR__.'/auth.php';