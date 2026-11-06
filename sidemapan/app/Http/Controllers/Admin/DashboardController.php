<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Total data
        $totalUmkm = Umkm::count();

        $totalProduk = Product::count();

        $totalPesanan = Order::count();

        // Pendapatan bulan ini dari pesanan selesai
$pendapatanBulanIni = Order::where('status', 'completed')
    ->whereMonth('created_at', $now->month)
    ->whereYear('created_at', $now->year)
    ->sum('total');

        // Total UMKM yang menunggu verifikasi
        $umkmPending = Umkm::where('status', 'pending')->count();

        // Total produk
        $produkAktif = Product::where('status', 'active')->count();

        // Pesanan bulan ini
        $pesananBulanIni = Order::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Produk terjual bulan ini
        $produkTerjual = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->whereMonth('orders.created_at', $now->month)
            ->whereYear('orders.created_at', $now->year)
            ->sum('order_items.quantity');

        // Rata-rata pesanan bulan ini
        $rataRataPesanan = $pesananBulanIni > 0
            ? $pendapatanBulanIni / $pesananBulanIni
            : 0;

        // Pendapatan bulan lalu
$pendapatanBulanLalu = Order::where('status', 'completed')
    ->whereMonth('created_at', $now->copy()->subMonth()->month)
    ->whereYear('created_at', $now->copy()->subMonth()->year)
    ->sum('total');

        // Persentase perubahan pendapatan
        $persentasePendapatan = $pendapatanBulanLalu > 0
            ? (($pendapatanBulanIni - $pendapatanBulanLalu)
                / $pendapatanBulanLalu) * 100
            : 0;

        // Ringkasan kategori produk
        $kategori = Category::withCount('products')
            ->get();

        $categoryLabels = $kategori->pluck('nama_kategori');
        $categoryValues = $kategori->pluck('products_count');

        // Grafik pendapatan 12 bulan terakhir
        $revenueLabels = [];
        $revenueValues = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);

            $revenueLabels[] = $date->translatedFormat('M');

            $revenueValues[] = (float) Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total');
        }

        // Lima UMKM dengan pendapatan terbesar bulan ini
        $topUmkm = Umkm::with('products')
            ->where('status', 'approved')
            ->get()
            ->map(function ($umkm) use ($now) {
                $productIds = $umkm->products->pluck('id');

                $revenue = DB::table('order_items')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->whereIn('order_items.product_id', $productIds)
                    ->where('orders.status', 'completed')
                    ->whereMonth('orders.created_at', $now->month)
                    ->whereYear('orders.created_at', $now->year)
                    ->sum('order_items.subtotal');

                return [
                    'name' => $umkm->name,
                    'revenue' => $revenue,
                ];
            })
            ->sortByDesc('revenue')
            ->take(5)
            ->values();

        // Jumlah aspirasi dan pengaduan yang belum ditangani
        $aspirasiPending = Aspirasi::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUmkm',
            'totalProduk',
            'totalPesanan',
            'pendapatanBulanIni',
            'umkmPending',
            'produkAktif',
            'pesananBulanIni',
            'produkTerjual',
            'rataRataPesanan',
            'persentasePendapatan',
            'kategori',
            'categoryLabels',
            'categoryValues',
            'revenueLabels',
            'revenueValues',
            'topUmkm',
            'aspirasiPending'
        ));
    }
}