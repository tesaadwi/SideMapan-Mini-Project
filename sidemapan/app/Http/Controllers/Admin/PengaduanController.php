<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Menampilkan seluruh pengaduan warga.
     */
    public function index()
    {
        $pengaduans = Pengaduan::latest()->paginate(10);

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Menampilkan detail pengaduan.
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Mengubah status pengaduan.
     */
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => [
                'required',
                'in:menunggu,diproses,selesai,ditolak',
            ],
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->id)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
