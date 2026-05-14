@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-slate-800">Export Laporan</h1>
    <p class="text-sm text-slate-500 mt-1">Unduh data inventaris dalam format CSV.</p>
@endsection

@section('content')

<div class="flex flex-col gap-4">

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center group transition-shadow hover:shadow-md">
        <div class="flex items-center gap-5">
            <div class="w-12 h-12 bg-slate-50 text-slate-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Laporan Produk</h2>
                <p class="text-xs text-slate-500 mt-1">Daftar lengkap semua produk termasuk stok, harga, dan status.</p>
            </div>
        </div>
        <a href="/export/products" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors shadow-sm">
           <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
           Download CSV
        </a>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center group transition-shadow hover:shadow-md">
        <div class="flex items-center gap-5">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Riwayat Transaksi Stok</h2>
                <p class="text-xs text-slate-500 mt-1">Data semua transaksi stok masuk dan penjualan produk.</p>
            </div>
        </div>
        <a href="/export/transactions" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors shadow-sm">
           <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
           Download CSV
        </a>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center group transition-shadow hover:shadow-md">
        <div class="flex items-center gap-5">
            <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Peringatan Stok Rendah</h2>
                <p class="text-xs text-slate-500 mt-1">Daftar produk dengan stok rendah atau habis yang perlu restock.</p>
            </div>
        </div>
        <a href="/export/low-stock" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors shadow-sm">
           <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
           Download CSV
        </a>
    </div>

</div>

@endsection