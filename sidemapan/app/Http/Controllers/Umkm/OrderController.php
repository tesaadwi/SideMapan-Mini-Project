<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Pastikan UMKM sudah diverifikasi.
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

    /**
     * Daftar pesanan yang memiliki produk UMKM.
     */
    public function index()
    {
        $umkm = $this->getUmkm();

        $orders = Order::whereHas(
            'items.product',
            function ($query) use ($umkm) {
                $query->where(
                    'umkm_id',
                    $umkm->id
                );
            }
        )
            ->with([
                'user',
                'items.product',
            ])
            ->latest()
            ->paginate(10);

        return view(
            'umkm.orders.index',
            compact('orders')
        );
    }

    /**
     * Detail pesanan.
     */
    public function show(Order $order)
    {
        $umkm = $this->getUmkm();

        $order->load([
            'user',
            'items.product',
        ]);

        $items = $order->items->filter(
            function ($item) use ($umkm) {
                return $item->product?->umkm_id
                    === $umkm->id;
            }
        );

        abort_if(
            $items->isEmpty(),
            404,
            'Pesanan tidak ditemukan.'
        );

        return view(
            'umkm.orders.show',
            compact('order', 'items')
        );
    }

    /**
     * Update status pesanan.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $umkm = $this->getUmkm();

        $order->load('items.product');

        $items = $order->items->filter(
            function ($item) use ($umkm) {
                return $item->product?->umkm_id
                    === $umkm->id;
            }
        );

        abort_if(
            $items->isEmpty(),
            404,
            'Pesanan tidak ditemukan.'
        );

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'processing',
                    'shipped',
                    'completed',
                ]),
            ],
        ]);

        $currentStatus = $order->status;
        $newStatus = $validated['status'];

        if (
            $newStatus === 'processing'
            && $currentStatus !== 'pending'
        ) {
            return back()->with(
                'error',
                'Pesanan tidak dapat diproses dari status saat ini.'
            );
        }

        if (
            $newStatus === 'shipped'
            && $currentStatus !== 'processing'
        ) {
            return back()->with(
                'error',
                'Pesanan harus diproses terlebih dahulu.'
            );
        }

        if (
            $newStatus === 'completed'
            && $currentStatus !== 'shipped'
        ) {
            return back()->with(
                'error',
                'Pesanan harus dikirim terlebih dahulu.'
            );
        }

        $order->update([
            'status' => $newStatus,
        ]);

        if ($newStatus === 'completed') {
            $order->update([
                'completed_at' => now(),
            ]);
        }

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}