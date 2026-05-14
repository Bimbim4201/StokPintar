<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Halaman utama: Menggunakan redirect statis agar bisa di-cache oleh Railway
Route::redirect('/', '/dashboard');

// Semua route di bawah ini hanya bisa diakses jika sudah Login
Route::middleware(['auth'])->group(function () {
    // Route dashboard
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    
    // Resource route otomatis menghandle index, create, store, edit, update, destroy
    // Pastikan tidak ada Route::get('/products') manual lainnya agar tidak bentrok
    Route::resource('products', ProductController::class);
    
    Route::get('/reports', [ProductController::class, 'reports'])->name('reports');
    Route::get('/notifications', [ProductController::class, 'notifications'])->name('notifications');
    Route::get('/exports', [ProductController::class, 'exports'])->name('exports');
    
    // Fitur Download CSV
    Route::get('/export/products', [ProductController::class, 'exportProducts']);
    Route::get('/export/transactions', [ProductController::class, 'exportTransactions']);
    Route::get('/export/low-stock', [ProductController::class, 'exportLowStock']);
});

require __DIR__.'/auth.php';