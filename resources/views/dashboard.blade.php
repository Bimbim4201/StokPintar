@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
    <p class="text-sm text-slate-500 mt-1">Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut ringkasan stok milikmu.</p>
@endsection

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Total Produk</p>
            <div class="p-2 bg-slate-50 rounded-lg"><svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg></div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-slate-800">{{ $totalProducts }}</h1>
            <p class="text-xs text-slate-400 mt-1">unit tersedia</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Nilai Stok</p>
            <div class="p-2 bg-emerald-50 rounded-lg"><svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Rp {{ number_format($totalValue, 0, ',', '.') }}</h1>
            <p class="text-xs text-emerald-500 font-medium mt-1">Total nilai aset gudang</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Total Terjual</p>
            <div class="p-2 bg-emerald-50 rounded-lg"><svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-slate-800">{{ $totalSold }}</h1>
            <p class="text-xs text-emerald-500 font-medium mt-1">Produk laku terjual</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Stok Rendah</p>
            <div class="p-2 bg-amber-50 rounded-lg"><svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-slate-800">{{ $lowStock }} <span class="text-lg font-normal text-slate-400">produk</span></h1>
            <p class="text-xs text-rose-500 font-medium mt-1">Perlu segera restock</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="mb-6">
            <h2 class="font-bold text-lg text-slate-800">Aktivitas Stok & Penjualan</h2>
            <p class="text-xs text-slate-400">Perbandingan stok awal vs terjual per produk</p>
        </div>
        <canvas id="activityChart" height="150"></canvas>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
         <div class="mb-6">
            <h2 class="font-bold text-lg text-slate-800">Komposisi Status Produk</h2>
            <p class="text-xs text-slate-400">Distribusi kondisi kesehatan stok saat ini</p>
        </div>
        <div class="relative h-[220px] flex justify-center">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-slate-800">Daftar Produk</h2>
        <a href="/export/products" class="text-sm font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export CSV
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-[10px] text-slate-400 uppercase tracking-wider border-b border-slate-50">
                <tr>
                    <th class="pb-4 font-semibold">Produk</th>
                    <th class="pb-4 font-semibold">SKU</th>
                    <th class="pb-4 font-semibold">Stok</th>
                    <th class="pb-4 font-semibold">Harga</th>
                    <th class="pb-4 font-semibold">Terjual</th>
                    <th class="pb-4 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($products as $product)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 font-semibold text-slate-700">{{ $product->name }}</td>
                    <td class="py-4 text-slate-500">{{ $product->sku }}</td>
                    <td class="py-4 text-slate-700 font-medium">{{ $product->stock }}</td>
                    <td class="py-4 text-slate-700">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-4 text-slate-700">{{ $product->sold }}</td>
                    <td class="py-4">
                        @if($product->status == 'Aman')
                            <span class="px-2.5 py-1 text-[11px] font-bold bg-emerald-50 text-emerald-600 rounded-full">Aman</span>
                        @elseif($product->status == 'Rendah')
                            <span class="px-2.5 py-1 text-[11px] font-bold bg-amber-50 text-amber-600 rounded-full">Rendah</span>
                        @else
                            <span class="px-2.5 py-1 text-[11px] font-bold bg-rose-50 text-rose-600 rounded-full">Habis</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <div class="flex items-center gap-2 mb-6">
        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <h2 class="text-lg font-bold text-slate-800">Peringatan Stok</h2>
    </div>

    <div class="space-y-3">
        @foreach($products as $product)
            @if($product->status == 'Rendah')
                <div class="flex items-center justify-between p-4 bg-amber-50 border border-amber-100 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                        <span class="text-sm font-medium text-amber-800">{{ $product->name }} stok mulai menipis</span>
                    </div>
                    <span class="text-xs font-bold text-amber-600">Sisa {{ max(0, $product->stock - $product->sold) }}</span>
                </div>
            @endif

            @if($product->status == 'Habis')
                <div class="flex items-center justify-between p-4 bg-rose-50 border border-rose-100 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-rose-500 rounded-full"></div>
                        <span class="text-sm font-medium text-rose-800">{{ $product->name }} stok habis</span>
                    </div>
                    <span class="text-xs font-bold text-rose-600">{{ max(0, $product->stock - $product->sold) }} tersisa</span>
                </div>
            @endif
        @endforeach
        
        @if($lowStock == 0)
            <div class="text-center py-6 text-slate-400">
                <p class="text-sm">Semua stok aman. Tidak ada peringatan hari ini.</p>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    const productsData = @json($products);
    
    // Data untuk Bar Chart
    const labels = productsData.map(p => p.name);
    const stocks = productsData.map(p => p.stock);
    const solds = productsData.map(p => p.sold);

    new Chart(document.getElementById('activityChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                // Bagian ini yang diganti menjadi 'Stok Awal'
                { label: 'Stok Awal', data: stocks, backgroundColor: '#2dce89', borderRadius: 4 },
                { label: 'Terjual', data: solds, backgroundColor: '#111c44', borderRadius: 4 }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { border: {display: false}, grid: { borderDash: [4, 4] }, beginAtZero: true },
                x: { border: {display: false}, grid: { display: false } }
            }
        }
    });

    // Data untuk Doughnut Chart
    let aman = 0, rendah = 0, habis = 0;
    productsData.forEach(p => {
        if(p.status === 'Aman') aman++;
        else if(p.status === 'Rendah') rendah++;
        else habis++;
    });

    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Aman', 'Rendah', 'Habis'],
            datasets: [{
                data: [aman, rendah, habis],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush