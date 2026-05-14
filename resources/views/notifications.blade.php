@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-slate-800">Notifikasi</h1>
    <p class="text-sm text-slate-500 mt-1">Peringatan stok dan aktivitas sistem.</p>
@endsection

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 min-h-[60vh]">
    
    @if(isset($notifications) && $notifications->count() > 0)
        <div class="space-y-4">
            @foreach($notifications as $item)
                @if($item->status == 'Habis')
                    <div class="flex items-start gap-4 p-5 bg-rose-50 border border-rose-100 rounded-xl">
                        <div class="p-2 bg-rose-500 text-white rounded-lg mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-rose-800">Stok Habis: {{ $item->name }}</h3>
                            <p class="text-sm text-rose-600 mt-1">Stok {{ $item->name }} habis (sisa 0), disarankan untuk segera restok!</p>
                        </div>
                    </div>
                @elseif($item->status == 'Rendah')
                    <div class="flex items-start gap-4 p-5 bg-amber-50 border border-amber-100 rounded-xl">
                        <div class="p-2 bg-amber-500 text-white rounded-lg mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-amber-800">Stok Menipis: {{ $item->name }}</h3>
                            <p class="text-sm text-amber-600 mt-1">Stok {{ $item->name }} hampir habis (tersisa {{ max(0, $item->stock - $item->sold) }} unit), Segera untuk restok!</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20">
            <div class="bg-slate-50 p-6 rounded-full mb-6">
                <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-slate-700 mb-2">Belum ada notifikasi</h2>
            <p class="text-slate-400 text-sm text-center max-w-sm">
                Saat ini sistem inventaris Anda berjalan lancar. Semua stok dalam kondisi aman.
            </p>
        </div>
    @endif

</div>

@endsection