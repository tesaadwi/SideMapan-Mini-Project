<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    /**
     * Mendapatkan UMKM yang login.
     */
    private function getUmkm()
    {
        $umkm = auth()->user()->umkm;

        abort_if(
            !$umkm,
            404,
            'Profil UMKM belum tersedia.'
        );

        abort_if(
            $umkm->status !== 'approved',
            403,
            'UMKM belum diverifikasi.'
        );

        return $umkm;
    }

    public function index(Request $request)
    {
        $umkm = $this->getUmkm();

        $validated = $request->validate([
            'tanggal_mulai' => [
                'nullable',
                'date',
            ],

            'tanggal_akhir' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
        ]);

        $tanggalMulai = $validated['tanggal_mulai'] ?? null;
        $tanggalAkhir = $validated['tanggal_akhir'] ?? null;

        /**
         * Ambil order selesai yang memiliki
         * produk milik UMKM.
         */
        $query = Order::query()
            ->where('orders.status', 'completed')
            ->whereHas(
                'items.product',
                function ($query) use ($umkm) {
                    $query->where(
                        'umkm_id',
                        $umkm->id
                    );
                }
            )
            ->with([
                'items.product',
                'user',
            ]);

        if ($tanggalMulai) {
            $query->whereDate(
                'orders.created_at',
                '>=',
                $tanggalMulai
            );
        }

        if ($tanggalAkhir) {
            $query->whereDate(
                'orders.created_at',
                '<=',
                $tanggalAkhir
            );
        }

        $orders = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /**
         * ID order yang masuk ke laporan.
         */
        $orderIds = (clone $query)
            ->pluck('orders.id');

        /**
         * Hanya item produk milik UMKM.
         */
        $items = OrderItem::query()
            ->whereIn('order_id', $orderIds)
            ->whereHas(
                'product',
                function ($query) use ($umkm) {
                    $query->where(
                        'umkm_id',
                        $umkm->id
                    );
                }
            );

        $totalPendapatan = (clone $items)
            ->sum('subtotal');

        $totalProdukTerjual = (clone $items)
            ->sum('quantity');

        $totalTransaksi = $orderIds->count();

        $produkTerlaris = (clone $items)
            ->selectRaw(
                'product_id, product_name, SUM(quantity) as total_terjual'
            )
            ->groupBy(
                'product_id',
                'product_name'
            )
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view(
            'umkm.laporan.index',
            compact(
                'orders',
                'totalPendapatan',
                'totalProdukTerjual',
                'totalTransaksi',
                'produkTerlaris',
                'tanggalMulai',
                'tanggalAkhir'
            )
        );
    }
}