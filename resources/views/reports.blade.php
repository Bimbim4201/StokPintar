@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-slate-800">Laporan</h1>
    <p class="text-sm text-slate-500 mt-1">Ringkasan performa inventaris dan penjualan.</p>
@endsection

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Nilai Total Stok</p>
            <div class="p-2 bg-emerald-50 rounded-lg"><svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Rp {{ number_format($totalValue, 0, ',', '.') }}</h1>
            <p class="text-xs text-slate-400 mt-1">Semua produk</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Total Terjual</p>
            <div class="p-2 bg-emerald-50 rounded-lg"><svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-slate-800">{{ $totalSold }} <span class="text-lg font-normal text-slate-400">unit</span></h1>
            <p class="text-xs text-slate-400 mt-1">Semua produk</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Rata-rata Harga</p>
            <div class="p-2 bg-slate-50 rounded-lg"><svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg></div>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Rp {{ number_format($averagePrice, 0, ',', '.') }}</h1>
            <p class="text-xs text-slate-400 mt-1">Per unit terjual</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-sm text-slate-500 font-medium">Total Produk</p>
            <div class="p-2 bg-slate-50 rounded-lg"><svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg></div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-slate-800">{{ $totalProducts }}</h1>
            <p class="text-xs text-slate-400 mt-1">Jenis produk terdaftar</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="mb-6">
            <h2 class="font-bold text-lg text-slate-800">Pendapatan per Produk</h2>
            <p class="text-xs text-slate-400">Total nilai penjualan (Rupiah)</p>
        </div>
        <canvas id="revenueChart" height="150"></canvas>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="mb-6">
            <h2 class="font-bold text-lg text-slate-800">Kuantitas Terjual</h2>
            <p class="text-xs text-slate-400">Total unit laku per produk</p>
        </div>
        <canvas id="soldQtyChart" height="150"></canvas>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <h2 class="text-lg font-bold text-slate-800 mb-6">Produk Terlaris</h2>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-[10px] text-slate-400 uppercase tracking-wider border-b border-slate-50">
                <tr>
                    <th class="pb-4 font-semibold w-10">#</th>
                    <th class="pb-4 font-semibold">Produk</th>
                    <th class="pb-4 font-semibold text-right">Terjual</th>
                    <th class="pb-4 font-semibold text-right">Pendapatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($products as $index => $product)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4">
                        <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold">
                            {{ $index + 1 }}
                        </div>
                    </td>
                    <td class="py-4 font-semibold text-slate-700">
                        {{ $product->name }}
                        <p class="text-xs font-normal text-slate-400">{{ $product->category ?? 'Tanpa Kategori' }}</p>
                    </td>
                    <td class="py-4 text-slate-800 font-bold text-right">{{ $product->sold }} <span class="font-normal text-slate-400 text-xs">unit</span></td>
                    <td class="py-4 text-emerald-600 font-bold text-right">Rp {{ number_format($product->sold * $product->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const reportsData = @json($products);
    const reportLabels = reportsData.map(p => p.name);
    const revenueData = reportsData.map(p => p.sold * p.price);
    const soldData = reportsData.map(p => p.sold);

    // Area Chart untuk Pendapatan
    const revCtx = document.getElementById('revenueChart').getContext('2d');
    let grad = revCtx.createLinearGradient(0, 0, 0, 400);
    grad.addColorStop(0, 'rgba(17, 28, 68, 0.2)');
    grad.addColorStop(1, 'rgba(17, 28, 68, 0)');

    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: reportLabels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: revenueData,
                borderColor: '#111c44',
                backgroundColor: grad,
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#111c44'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { border: {display: false}, grid: { borderDash: [4, 4] }, beginAtZero: true },
                x: { border: {display: false}, grid: { display: false } }
            }
        }
    });

    // Bar Chart untuk Unit Terjual
    new Chart(document.getElementById('soldQtyChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: reportLabels,
            datasets: [{
                label: 'Unit Terjual',
                data: soldData,
                backgroundColor: '#10b981',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { border: {display: false}, grid: { borderDash: [4, 4] }, beginAtZero: true },
                x: { border: {display: false}, grid: { display: false } }
            }
        }
    });
</script>
@endpush