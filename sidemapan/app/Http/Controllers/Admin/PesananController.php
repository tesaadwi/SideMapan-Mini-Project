<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Menampilkan semua pesanan.
     */
    public function index()
    {
        $pesanans = Pesanan::latest()->paginate(10);

        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Menampilkan detail pesanan.
     */
    public function show(Pesanan $pesanan)
    {
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Mengubah status pesanan.
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => [
                'required',
                'in:menunggu,diproses,dikirim,selesai,dibatalkan',
            ],
        ]);

        $pesanan->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}