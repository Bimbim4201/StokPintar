@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-slate-800">Produk</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola semua produk dalam inventaris Anda.</p>
@endsection

@section('content')

<div class="flex justify-between items-center mb-6">
    <form method="GET" action="/products" class="relative w-96">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <input type="text" name="search" placeholder="Cari produk atau SKU..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-[#111c44] transition-colors">
    </form>

    <div class="flex gap-4 items-center">
        <a href="/products/create" class="flex items-center gap-2 bg-[#111c44] hover:bg-[#1a295c] text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">
           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
           Tambah Produk
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 relative group">
        
        <div class="absolute top-5 right-5">
            @if($product->status == 'Aman')
                <span class="bg-emerald-50 text-emerald-600 px-3 py-1 text-xs font-semibold rounded-full">Aman</span>
            @elseif($product->status == 'Rendah')
                <span class="bg-amber-50 text-amber-600 px-3 py-1 text-xs font-semibold rounded-full">Rendah</span>
            @elseif($product->status == 'Habis')
                <span class="bg-rose-50 text-rose-600 px-3 py-1 text-xs font-semibold rounded-full">Habis</span>
            @endif
        </div>

        <div class="mb-4">
            <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <h2 class="text-base font-bold text-slate-800 leading-tight mb-1">{{ $product->name }}</h2>
            <p class="text-xs text-slate-400">{{ $product->sku }} • {{ $product->category ?: 'Tanpa Kategori' }}</p>
        </div>

        <div class="flex justify-between items-end border-t border-slate-50 pt-4 mt-2">
            <div>
                <p class="text-[10px] font-semibold text-slate-400 mb-0.5">STOK AWAL</p>
                <h3 class="text-lg font-bold text-slate-800">{{ $product->stock }}</h3>
            </div>
            <div>
                <p class="text-[10px] font-semibold text-slate-400 mb-0.5">TERJUAL</p>
                <h3 class="text-lg font-bold text-slate-800">{{ $product->sold }}</h3>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-semibold text-slate-400 mb-0.5">HARGA</p>
                <h3 class="text-sm font-bold text-slate-800">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="absolute inset-0 bg-white/90 backdrop-blur-sm rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
            <a href="/products/{{ $product->id }}/edit" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
               Edit
            </a>
            <form action="/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                @csrf
                @method('DELETE')
                <button class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                    Hapus
                </button>
            </form>
        </div>

    </div>
    @endforeach
</div>

@endsection