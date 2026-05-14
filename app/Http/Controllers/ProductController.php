<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');

        // Mengambil produk HANYA milik user yang sedang login
        $userProducts = auth()->user()->products();

        $products = $userProducts->when($search, function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%");
        })->latest()->get();

        $totalProducts = auth()->user()->products()->count();
        $totalStock = auth()->user()->products()->sum('stock');
        $totalSold = auth()->user()->products()->sum('sold');
        $lowStock = auth()->user()->products()->whereIn('status', ['Rendah', 'Habis'])->count();
        
        return view('products.index', compact(
            'products',
            'totalProducts',
            'totalStock',
            'totalSold',
            'lowStock'
        ));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'category' => 'required|string',
            'stock' => 'required|integer',
            'sold' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Menyimpan produk dan otomatis mengisi user_id
        auth()->user()->products()->create($request->all());

        return redirect('/products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        // Proteksi: cegah user A mengedit barang user B
        if ($product->user_id !== auth()->id()) { abort(403); }
        
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Proteksi
        if ($product->user_id !== auth()->id()) { abort(403); }

        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'category' => 'required|string',
            'stock' => 'required|integer',
            'sold' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $product->update($request->all());

        return redirect('/products')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        // Proteksi
        if ($product->user_id !== auth()->id()) { abort(403); }
        
        $product->delete();

        return redirect('/products')->with('success', 'Produk berhasil dihapus');
    }

    public function exportCSV()
    {
        // Export hanya produk milik user
        $products = auth()->user()->products()->get();

        $filename = 'products.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nama', 'SKU', 'Kategori', 'Stok', 'Terjual', 'Harga', 'Status'], ';');

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->sku,
                    $product->category,
                    $product->stock,
                    $product->sold,
                    $product->price,
                    $product->status
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dashboard()
    {
        $userProducts = auth()->user()->products();
        
        $products = $userProducts->latest()->get();
        $totalProducts = $userProducts->count();
        $totalSold = $userProducts->sum('sold');
        $lowStock = $userProducts->whereIn('status', ['Rendah', 'Habis'])->count();
        $chartLabels = $userProducts->pluck('name');
        $chartStocks = $userProducts->pluck('stock');

        $totalValue = $userProducts->sum(DB::raw('stock * price'));

        $lowStockProducts = $userProducts->whereIn('status', ['Rendah', 'Habis'])->pluck('name');
        $lowStockValues = $userProducts->whereIn('status', ['Rendah', 'Habis'])->pluck('stock');

        $lowStockColors = $userProducts->whereIn('status', ['Rendah', 'Habis'])->get()->map(function($item) {
            return $item->status == 'Habis' ? '#EF4444' : '#FACC15';
        });

        return view('dashboard', compact(
            'products',
            'totalProducts',
            'totalSold',
            'lowStock',
            'totalValue',
            'chartLabels',
            'chartStocks',
            'lowStockProducts',
            'lowStockValues',
            'lowStockColors'
        ));
    }

    public function reports()
    {
        $userProducts = auth()->user()->products();

        $products = $userProducts->orderByDesc('sold')->get();
        $totalProducts = $userProducts->count();
        $totalSold = $userProducts->sum('sold');
        $reportLabels = $userProducts->pluck('name');
        $reportStocks = $userProducts->pluck('stock');

        $revenueData = $products->map(function($item) {
            return $item->sold * $item->price;
        });

        $totalValue = $userProducts->sum(DB::raw('stock * price'));
        $averagePrice = $userProducts->avg('price') ?? 0;

        return view('reports', compact(
            'products',
            'totalProducts',
            'totalSold',
            'totalValue',
            'averagePrice',
            'reportLabels',
            'reportStocks',
            'revenueData'
        ));
    }
    
    public function notifications()
    {
        // Hanya notifikasi dari produk user sendiri
        $notifications = auth()->user()->products()->whereIn('status', ['Rendah', 'Habis'])->get();
        return view('notifications', compact('notifications'));
    }

    public function exports()
    {
        return view('exports');
    }

    public function exportProducts()
    {
        $products = auth()->user()->products()->get();
        return $this->generateCSV($products, 'laporan_produk.csv');
    }

    public function exportLowStock()
    {
        $products = auth()->user()->products()->whereIn('status', ['Rendah', 'Habis'])->get();
        return $this->generateCSV($products, 'stok_rendah.csv');
    }

    public function exportTransactions()
    {
        $products = auth()->user()->products()->get();

        $filename = 'riwayat_transaksi.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Produk', 'SKU', 'Jumlah Terjual', 'Harga', 'Total Pendapatan'], ';');

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->sku,
                    $product->sold,
                    $product->price,
                    $product->sold * $product->price
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function generateCSV($products, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nama', 'SKU', 'Kategori', 'Stok', 'Terjual', 'Harga', 'Status'], ';');

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->sku,
                    $product->category,
                    $product->stock,
                    $product->sold,
                    $product->price,
                    $product->status
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}