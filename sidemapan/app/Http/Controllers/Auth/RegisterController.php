<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman pendaftaran.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Memproses pendaftaran akun.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Informasi akun
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                'in:pembeli,umkm',
            ],

            // Nomor telepon pemilik UMKM
            'phone' => [
                'required_if:role,umkm',
                'nullable',
                'string',
                'max:20',
            ],

            // Nama toko
            'umkm_name' => [
                'required_if:role,umkm',
                'nullable',
                'string',
                'max:255',
            ],

            // Alamat usaha
            'umkm_address' => [
                'required_if:role,umkm',
                'nullable',
                'string',
                'max:1000',
            ],

            // Deskripsi usaha
            'umkm_description' => [
                'required_if:role,umkm',
                'nullable',
                'string',
                'max:2000',
            ],

            // Password
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        /*
         * Simpan akun dan data UMKM ke MySQL.
         * Transaksi ini tetap terpisah dari API PostgreSQL.
         */
        $user = DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => $validated['role'],
                'is_active' => true,

                'phone' => $validated['role'] === 'umkm'
                    ? $validated['phone']
                    : null,
            ]);

            if ($validated['role'] === 'umkm') {

                $name = $validated['umkm_name'];

                $slug = Str::slug($name);

                if (Umkm::where('slug', $slug)->exists()) {
                    $slug .= '-' . Str::lower(Str::random(6));
                }

                $user->umkm()->create([
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $validated['umkm_description'],
                    'address' => $validated['umkm_address'],
                    'status' => 'pending',
                ]);
            }

            return $user;
        });

        /*
         * Sinkronkan data usaha ke PostgreSQL melalui API.
         * Jika API gagal, data MySQL tetap tersimpan dan
         * pendaftaran tidak dibatalkan.
         */
        $syncWarning = false;

        if ($user->role === 'umkm') {
            try {
                $apiUrl = rtrim(
                    config('services.sidemapan_api.url'),
                    '/'
                );

                $response = Http::timeout(5)
                    ->post($apiUrl . '/api/umkm', [
                        'nama_usaha' => $validated['umkm_name'],
                        'nama_pemilik' => $validated['name'],
                        'deskripsi' => $validated['umkm_description'],
                        'alamat' => $validated['umkm_address'],
                        'no_telepon' => $validated['phone'],
                    ]);

                if (! $response->successful()) {
                    $syncWarning = true;

                    Log::warning(
                        'Sinkronisasi UMKM ke PostgreSQL gagal.',
                        [
                            'user_id' => $user->id,
                            'http_status' => $response->status(),
                            'response' => $response->body(),
                        ]
                    );
                }
            } catch (\Throwable $e) {
                $syncWarning = true;

                Log::error(
                    'Tidak dapat menghubungi API PostgreSQL SideMapan.',
                    [
                        'user_id' => $user->id,
                        'error' => $e->getMessage(),
                    ]
                );
            }
        }

        // Login otomatis setelah pendaftaran berhasil
        Auth::login($user);

        $request->session()->regenerate();

        // Arahkan pengguna sesuai jenis akun
        if ($user->role === 'umkm') {
            $redirect = redirect()
                ->route('umkm.dashboard')
                ->with(
                    'success',
                    'Pendaftaran berhasil. Akun UMKM menunggu verifikasi admin.'
                );

            if ($syncWarning) {
                $redirect->with(
                    'warning',
                    'Akun berhasil dibuat, tetapi data UMKM belum berhasil dikirim ke sistem PostgreSQL. Silakan hubungi admin untuk sinkronisasi.'
                );
            }

            return $redirect;
        }

        return redirect()
            ->route('pembeli.dashboard')
            ->with(
                'success',
                'Pendaftaran berhasil. Selamat datang di SideMapan!'
            );
    }
}
