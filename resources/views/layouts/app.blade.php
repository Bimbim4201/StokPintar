<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StokPintar - Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-[#f8f9fc] text-slate-700">

<div class="flex min-h-screen">

    <aside class="w-64 bg-[#111c44] text-slate-300 flex flex-col transition-all duration-300">
        
        <div class="flex items-center gap-3 p-6 mb-4">
            <div class="bg-emerald-400 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white leading-tight">StokPintar</h1>
                <p class="text-[10px] tracking-widest text-slate-400">INVENTORY SYSTEM</p>
            </div>
        </div>

        <nav class="flex flex-col gap-2 px-4 flex-1">
            <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->is('/') ? 'bg-[#1a295c] text-white font-semibold' : 'text-slate-300 hover:bg-[#1a295c]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="/products" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->is('products*') ? 'bg-[#1a295c] text-white font-semibold' : 'text-slate-300 hover:bg-[#1a295c]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="text-sm">Produk</span>
            </a>

            <a href="/reports" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->is('reports') ? 'bg-[#1a295c] text-white font-semibold' : 'text-slate-300 hover:bg-[#1a295c]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span class="text-sm">Laporan</span>
            </a>

            <a href="/notifications" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->is('notifications') ? 'bg-[#1a295c] text-white font-semibold' : 'text-slate-300 hover:bg-[#1a295c]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="text-sm">Notifikasi</span>
            </a>

            <a href="/exports" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->is('exports') ? 'bg-[#1a295c] text-white font-semibold' : 'text-slate-300 hover:bg-[#1a295c]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-sm">Export</span>
            </a>

            <div class="relative mt-4 pt-4 border-t border-slate-700/50">
                <button onclick="document.getElementById('logoutDropdown').classList.toggle('hidden')" class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-colors text-slate-300 hover:bg-[#1a295c] focus:outline-none">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm uppercase">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <span class="text-sm font-medium truncate max-w-[100px] text-left">{{ auth()->user()->name ?? 'User' }}</span>
                    </div>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div id="logoutDropdown" class="hidden absolute left-4 right-4 bottom-full mb-2 bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-rose-500 hover:bg-rose-50 transition-colors text-left">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="text-sm font-semibold">Logout Keluar</span>
                        </button>
                    </form>
                </div>
            </div>

        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto relative">
        <div class="flex justify-between items-center mb-8">
            <div>
                @yield('header_title')
            </div>
            
            @if(!request()->is('notifications'))
                <a href="/notifications" class="relative p-2 text-slate-400 hover:text-slate-600 transition-colors group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-[#f8f9fc]"></span>
                </a>
            @else
                <div></div> @endif
        </div>

        @yield('content')
    </main>

</div>

    <script>
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('logoutDropdown');
            const button = dropdown.previousElementSibling;
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>