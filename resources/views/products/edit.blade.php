<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Produk - StokPintar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#f8f9fc] p-10 min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-sm border border-slate-100">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Produk</h1>
            <p class="text-sm text-slate-500 mt-1">Perbarui informasi produk {{ $product->name }}.</p>
        </div>
        <a href="/products" class="p-2 text-slate-400 hover:text-slate-600 bg-slate-50 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>
    </div>

    <form action="/products/{{ $product->id }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">SKU</label>
                <input type="text" name="sku" value="{{ $product->sku }}" required class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                <input type="text" name="category" value="{{ $product->category }}" required class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $product->price }}" required class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Stok Awal</label>
                <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Terjual</label>
                <input type="number" name="sold" value="{{ $product->sold }}" class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm bg-slate-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                <select name="status" class="w-full border border-slate-200 p-3 rounded-xl focus:outline-none focus:border-[#111c44] focus:ring-1 focus:ring-[#111c44] transition-colors text-sm bg-white">
                    <option value="Aman" {{ $product->status == 'Aman' ? 'selected' : '' }}>Aman</option>
                    <option value="Rendah" {{ $product->status == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="Habis" {{ $product->status == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
        </div>

        <div class="pt-4 mt-6 border-t border-slate-100 flex justify-end gap-3">
            <a href="/products" class="px-6 py-3 rounded-xl text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</a>
            <button type="submit" class="bg-[#111c44] hover:bg-[#1a295c] text-white px-6 py-3 rounded-xl text-sm font-medium transition-colors shadow-sm">
                Update Produk
            </button>
        </div>

    </form>
</div>

</body>
</html>