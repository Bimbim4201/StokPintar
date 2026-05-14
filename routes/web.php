<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 1. Gunakan redirect sederhana (Tanpa function closure agar bisa di-cache)
Route::redirect('/', '/dashboard');

// 2. Semua rute di dalam grup middleware auth
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    
    // Resource rute (HANYA SATU INI SAJA untuk urusan produk)
    // Otomatis mencakup: products.index, products.create, products.store, dll.
    Route::resource('products', ProductController::class);
    
    // Laporan & Fitur lainnya
    Route::get('/reports', [ProductController::class, 'reports'])->name('reports');
    Route::get('/notifications', [ProductController::class, 'notifications'])->name('notifications');
    Route::get('/exports', [ProductController::class, 'exports'])->name('exports');
    
    // Fitur Download CSV (Gunakan prefix /export agar tidak bentrok dengan resource)
    Route::get('/export-csv/products', [ProductController::class, 'exportProducts'])->name('export.products');
    Route::get('/export-csv/transactions', [ProductController::class, 'exportTransactions'])->name('export.transactions');
    Route::get('/export-csv/low-stock', [ProductController::class, 'exportLowStock'])->name('export.lowstock');
});

require __DIR__.'/auth.php';