<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ==========================================================
        // DATA UMKM
        // ==========================================================

        $umkm = $user->umkm;

        if (!$umkm) {
            abort(404, 'Data UMKM tidak ditemukan.');
        }

        $umkmId = $umkm->id;


        // ==========================================================
        // PRODUK
        // ==========================================================

        $products = Product::where('umkm_id', $umkmId);

        $totalProduk = (clone $products)->count();

        /*
         * Mendukung status:
         * active
         * aktif
         */
        $produkAktif = (clone $products)
            ->whereIn('status', ['active', 'aktif'])
            ->count();


        // ==========================================================
        // PESANAN UMKM
        // ==========================================================

        $orders = Order::whereHas('items.product', function ($query) use ($umkmId) {
            $query->where('umkm_id', $umkmId);
        });

        $totalPesanan = (clone $orders)->count();


        /*
         * Pesanan yang masih berjalan
         */
        $pesananDiproses = (clone $orders)
            ->whereIn('status', [
                'pending',
                'processing',
                'diproses',
                'shipped',
                'dikirim',
            ])
            ->count();


        /*
         * Pesanan selesai
         */
        $pesananSelesai = (clone $orders)
            ->where('status', 'completed')
            ->count();


        // ==========================================================
        // TOTAL PENDAPATAN
        // ==========================================================

        $totalPendapatan = DB::table('order_items')
            ->join(
                'orders',
                'orders.id',
                '=',
                'order_items.order_id'
            )
            ->join(
                'products',
                'products.id',
                '=',
                'order_items.product_id'
            )
            ->where('products.umkm_id', $umkmId)
            ->where('orders.status', 'completed')
            ->sum('order_items.subtotal');


        // ==========================================================
        // PESANAN TERBARU
        // ==========================================================

        $pesananTerbaru = Order::with([
                'items.product',
                'user'
            ])
            ->whereHas('items.product', function ($query) use ($umkmId) {
                $query->where('umkm_id', $umkmId);
            })
            ->latest('created_at')
            ->take(5)
            ->get();


        // ==========================================================
        // PERIODE BULAN INI
        // ==========================================================

        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();


        // ==========================================================
        // PESANAN BULAN INI
        // ==========================================================

        $pesananBulanIni = Order::whereHas(
            'items.product',
            function ($query) use ($umkmId) {
                $query->where('umkm_id', $umkmId);
            }
        )
        ->whereBetween(
            'created_at',
            [$awalBulan, $akhirBulan]
        )
        ->where('status', 'completed');


        $totalPesananBulanIni = (clone $pesananBulanIni)
            ->count();


        // ==========================================================
        // PENDAPATAN BULAN INI
        // ==========================================================

        $pendapatanBulanIni = DB::table('order_items')
            ->join(
                'orders',
                'orders.id',
                '=',
                'order_items.order_id'
            )
            ->join(
                'products',
                'products.id',
                '=',
                'order_items.product_id'
            )
            ->where('products.umkm_id', $umkmId)
            ->where('orders.status', 'completed')
            ->whereBetween(
                'orders.created_at',
                [$awalBulan, $akhirBulan]
            )
            ->sum('order_items.subtotal');


        // ==========================================================
        // PRODUK TERJUAL BULAN INI
        // ==========================================================

        $produkTerjualBulanIni = DB::table('order_items')
            ->join(
                'orders',
                'orders.id',
                '=',
                'order_items.order_id'
            )
            ->join(
                'products',
                'products.id',
                '=',
                'order_items.product_id'
            )
            ->where('products.umkm_id', $umkmId)
            ->where('orders.status', 'completed')
            ->whereBetween(
                'orders.created_at',
                [$awalBulan, $akhirBulan]
            )
            ->sum('order_items.quantity');


        // ==========================================================
        // RATA-RATA PESANAN
        // ==========================================================

        $rataRataPesanan = $totalPesananBulanIni > 0
            ? $pendapatanBulanIni / $totalPesananBulanIni
            : 0;


        // ==========================================================
        // GRAFIK PENJUALAN 12 BULAN
        // ==========================================================

        $grafikPenjualan = [];

        for ($i = 11; $i >= 0; $i--) {

            $bulan = Carbon::now()
                ->copy()
                ->subMonths($i);

            $pendapatan = DB::table('order_items')
                ->join(
                    'orders',
                    'orders.id',
                    '=',
                    'order_items.order_id'
                )
                ->join(
                    'products',
                    'products.id',
                    '=',
                    'order_items.product_id'
                )
                ->where('products.umkm_id', $umkmId)
                ->where('orders.status', 'completed')
                ->whereYear(
                    'orders.created_at',
                    $bulan->year
                )
                ->whereMonth(
                    'orders.created_at',
                    $bulan->month
                )
                ->sum('order_items.subtotal');

            $grafikPenjualan[] = [
                'label' => $bulan->translatedFormat('M Y'),
                'value' => (float) $pendapatan,
            ];
        }


        // ==========================================================
        // PRODUK TERLARIS
        // ==========================================================

        $produkTerlaris = DB::table('order_items')
            ->join(
                'orders',
                'orders.id',
                '=',
                'order_items.order_id'
            )
            ->join(
                'products',
                'products.id',
                '=',
                'order_items.product_id'
            )
            ->where('products.umkm_id', $umkmId)
            ->where('orders.status', 'completed')
            ->select(
                'products.id',
                'products.name',
                DB::raw(
                    'SUM(order_items.quantity) as total_terjual'
                )
            )
            ->groupBy(
                'products.id',
                'products.name'
            )
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();


        // ==========================================================
        // KIRIM KE VIEW
        // ==========================================================

        return view('umkm.dashboard', compact(
            'umkm',
            'totalProduk',
            'produkAktif',
            'totalPesanan',
            'pesananDiproses',
            'pesananSelesai',
            'totalPendapatan',
            'pesananTerbaru',
            'pendapatanBulanIni',
            'totalPesananBulanIni',
            'produkTerjualBulanIni',
            'rataRataPesanan',
            'grafikPenjualan',
            'produkTerlaris'
        ));
    }
}