<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM
    public function index(Request $request)
    {
        $query = Umkm::with('user');

        // Pencarian UMKM
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('nama_umkm', 'like', "%{$search}%");
        }

        // Filter status verifikasi
        if ($request->filled('status')) {
            $query->where(
                'status_verifikasi',
                $request->status
            );
        }

        $umkms = $query->latest()->paginate(10);

        return view('admin.umkm.index', compact('umkms'));
    }

    // Menampilkan form tambah UMKM
    public function create()
    {
        return view('admin.umkm.create');
    }

    // Menyimpan UMKM baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_umkm' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['nama_umkm'])
            . '-' . Str::lower(Str::random(6));

        $validated['status_verifikasi'] = 'menunggu';

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('umkm', 'public');
        }

        // Admin membuat data UMKM tanpa akun pemilik.
        // Akun pemilik dapat dihubungkan kemudian.
        $validated['user_id'] = null;

        Umkm::create($validated);

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil ditambahkan.');
    }

    // Menampilkan detail UMKM
    public function show(Umkm $umkm)
    {
        $umkm->load(['user', 'products']);

        return view('admin.umkm.show', compact('umkm'));
    }

    // Menampilkan form edit
    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    // Memperbarui data UMKM
    public function update(Request $request, Umkm $umkm)
    {
        $validated = $request->validate([
            'nama_umkm' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')
                    ->delete($umkm->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('umkm', 'public');
        }

        $validated['slug'] = Str::slug($validated['nama_umkm'])
            . '-' . Str::lower(Str::random(6));

        $umkm->update($validated);

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    // Menghapus UMKM
    public function destroy(Umkm $umkm)
    {
        if ($umkm->logo) {
            \Illuminate\Support\Facades\Storage::disk('public')
                ->delete($umkm->logo);
        }

        $umkm->delete();

        return redirect()
            ->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil dihapus.');
    }
}