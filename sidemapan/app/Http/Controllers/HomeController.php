<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        // Data lama dari MySQL sebagai cadangan
        $umkmsMySql = Umkm::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        // Data awal memakai MySQL agar halaman tetap bisa ditampilkan
        $umkms = $umkmsMySql->map(function ($umkm) {
            return [
                'nama_usaha' => $umkm->nama_usaha,
                'deskripsi' => $umkm->deskripsi,
                'alamat' => $umkm->alamat,
                'foto' => $umkm->foto,
                'sumber' => 'mysql',
            ];
        });

        try {
            $response = Http::timeout(3)
                ->get(rtrim(config('services.sidemapan_api.url'), '/')
                    . '/api/umkm');

            if ($response->successful()) {
                $dataApi = collect($response->json('data', []))
                    ->filter(function ($item) {
                        return ($item['status_verifikasi'] ?? '') === 'disetujui';
                    })
                    ->take(6)
                    ->map(function ($item) {
                        return [
                            'nama_usaha' => $item['nama_usaha'] ?? 'UMKM Desa Gilang',
                            'deskripsi' => $item['deskripsi'] ?? null,
                            'alamat' => $item['alamat'] ?? null,
                            'foto' => null,
                            'sumber' => 'postgresql',
                        ];
                    })
                    ->values();

                // Gunakan PostgreSQL hanya jika respons API valid.
                $umkms = $dataApi;
            }
        } catch (\Throwable $e) {
            // Jika API mati atau gagal diakses, data MySQL tetap digunakan.
            report($e);
        }

        return view('home', compact('umkms'));
    }
}
