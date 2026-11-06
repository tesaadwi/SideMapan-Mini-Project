<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VerifikasiUmkmController extends Controller
{
    /**
     * Menampilkan daftar UMKM.
     */
    public function index(Request $request)
    {
        $query = Umkm::with('user');

        // Filter berdasarkan status.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama UMKM.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('name', 'like', "%{$search}%");
        }

        $umkms = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.verifikasi.index',
            compact('umkms')
        );
    }

    /**
     * Menampilkan detail UMKM.
     */
    public function show(Umkm $umkm)
    {
        $umkm->load('user');

        return view(
            'admin.verifikasi.show',
            compact('umkm')
        );
    }

    /**
     * Menyetujui pendaftaran UMKM.
     */
    public function setujui(Umkm $umkm)
    {
        // Perbarui status di MySQL.
        $umkm->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);

        // Sinkronkan status ke PostgreSQL melalui API.
        $syncBerhasil = $this->sinkronkanStatus(
            $umkm,
            'disetujui'
        );

        if ($syncBerhasil) {
            return redirect()
                ->route('admin.verifikasi.index')
                ->with(
                    'success',
                    'UMKM berhasil disetujui dan status PostgreSQL berhasil disinkronkan.'
                );
        }

        return redirect()
            ->route('admin.verifikasi.index')
            ->with(
                'warning',
                'UMKM berhasil disetujui di MySQL, tetapi sinkronisasi PostgreSQL gagal. Periksa log aplikasi.'
            );
    }

    /**
     * Menolak pendaftaran UMKM.
     */
    public function tolak(
        Request $request,
        Umkm $umkm
    ) {
        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        // Perbarui status di MySQL.
        $umkm->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Sinkronkan status ke PostgreSQL melalui API.
        $syncBerhasil = $this->sinkronkanStatus(
            $umkm,
            'ditolak'
        );

        if ($syncBerhasil) {
            return redirect()
                ->route('admin.verifikasi.index')
                ->with(
                    'success',
                    'UMKM berhasil ditolak dan status PostgreSQL berhasil disinkronkan.'
                );
        }

        return redirect()
            ->route('admin.verifikasi.index')
            ->with(
                'warning',
                'UMKM berhasil ditolak di MySQL, tetapi sinkronisasi PostgreSQL gagal. Periksa log aplikasi.'
            );
    }

    /**
     * Menyinkronkan status UMKM ke PostgreSQL melalui Express API.
     *
     * Status MySQL:
     * approved
     * rejected
     * pending
     *
     * Status PostgreSQL:
     * disetujui
     * ditolak
     * menunggu
     */
    private function sinkronkanStatus(
        Umkm $umkm,
        string $status
    ): bool {
        try {
            $apiUrl = rtrim(
                (string) config(
                    'services.sidemapan_api.url',
                    'http://127.0.0.1:3000'
                ),
                '/'
            );

            /*
             * Ambil daftar UMKM dari PostgreSQL.
             * Pencocokan sementara dilakukan berdasarkan nama usaha.
             */
            $response = Http::timeout(10)
                ->get($apiUrl . '/api/umkm');

            if (! $response->successful()) {
                Log::warning(
                    'Gagal mengambil data UMKM dari API PostgreSQL.',
                    [
                        'mysql_umkm_id' => $umkm->id,
                        'nama_usaha' => $umkm->name,
                        'http_status' => $response->status(),
                        'response' => $response->body(),
                    ]
                );

                return false;
            }

            $data = $response->json('data', []);

            if (! is_array($data)) {
                Log::warning(
                    'Format data UMKM dari API tidak valid.',
                    [
                        'mysql_umkm_id' => $umkm->id,
                    ]
                );

                return false;
            }

            // Cocokkan nama usaha tanpa membedakan huruf besar/kecil.
            $namaUmkm = mb_strtolower(trim($umkm->name));

            $kandidat = collect($data)->filter(
                function ($item) use ($namaUmkm) {
                    return mb_strtolower(
                        trim($item['nama_usaha'] ?? '')
                    ) === $namaUmkm;
                }
            )->values();

            // Jangan memperbarui jika tidak ditemukan
            // atau terdapat nama usaha yang sama.
            if ($kandidat->count() !== 1) {
                Log::warning(
                    'UMKM PostgreSQL tidak ditemukan atau memiliki nama duplikat.',
                    [
                        'mysql_umkm_id' => $umkm->id,
                        'nama_usaha' => $umkm->name,
                        'jumlah_cocok' => $kandidat->count(),
                    ]
                );

                return false;
            }

            $postgresUmkm = $kandidat->first();

            if (empty($postgresUmkm['id'])) {
                Log::warning(
                    'ID UMKM PostgreSQL tidak tersedia.',
                    [
                        'mysql_umkm_id' => $umkm->id,
                        'nama_usaha' => $umkm->name,
                    ]
                );

                return false;
            }

            // Perbarui status UMKM di PostgreSQL melalui API.
            $updateResponse = Http::timeout(10)
                ->put(
                    $apiUrl . '/api/umkm/' . $postgresUmkm['id'],
                    [
                        'status_verifikasi' => $status,
                    ]
                );

            if (! $updateResponse->successful()) {
                Log::warning(
                    'Gagal memperbarui status UMKM PostgreSQL.',
                    [
                        'mysql_umkm_id' => $umkm->id,
                        'postgres_umkm_id' => $postgresUmkm['id'],
                        'status_verifikasi' => $status,
                        'http_status' => $updateResponse->status(),
                        'response' => $updateResponse->body(),
                    ]
                );

                return false;
            }

            Log::info(
                'Status UMKM berhasil disinkronkan ke PostgreSQL.',
                [
                    'mysql_umkm_id' => $umkm->id,
                    'postgres_umkm_id' => $postgresUmkm['id'],
                    'status_verifikasi' => $status,
                ]
            );

            return true;

        } catch (\Throwable $e) {
            Log::error(
                'Terjadi kesalahan saat sinkronisasi status UMKM.',
                [
                    'mysql_umkm_id' => $umkm->id,
                    'nama_usaha' => $umkm->name,
                    'status_verifikasi' => $status,
                    'error' => $e->getMessage(),
                ]
            );

            return false;
        }
    }
}
