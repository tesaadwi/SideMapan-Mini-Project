<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_akhir' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
        ]);

        $tanggalMulai = $request->tanggal_mulai;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = Order::where('status', 'completed');

        if ($tanggalMulai) {
            $query->whereDate('created_at', '>=', $tanggalMulai);
        }

        if ($tanggalAkhir) {
            $query->whereDate('created_at', '<=', $tanggalAkhir);
        }

        $orders = (clone $query)
            ->with(['user', 'items'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $orderIds = (clone $query)->pluck('id');

        $items = OrderItem::whereIn('order_id', $orderIds);

        $totalPendapatan = (clone $items)->sum('subtotal');
        $totalProdukTerjual = (clone $items)->sum('quantity');
        $totalTransaksi = $orderIds->count();

        $produkTerlaris = (clone $items)
            ->selectRaw('product_id, product_name, SUM(quantity) as total_terjual')
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view('admin.laporan.index', compact(
            'orders',
            'totalPendapatan',
            'totalProdukTerjual',
            'totalTransaksi',
            'produkTerlaris',
            'tanggalMulai',
            'tanggalAkhir'
        ));
    }
}