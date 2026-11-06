<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan profil UMKM milik pengguna
    public function edit()
    {
        $umkm = auth()->user()->umkm;

        abort_if(!$umkm, 404, 'Profil UMKM belum tersedia.');

        return view('umkm.profile.edit', compact('umkm'));
    }

    // Memperbarui profil UMKM
    public function update(Request $request)
    {
        $umkm = auth()->user()->umkm;

        abort_if(!$umkm, 404, 'Profil UMKM belum tersedia.');

        $validated = $request->validate([
            'nama_umkm' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('umkm', 'public');
        }

        $umkm->update($validated);

        return back()->with('success', 'Profil UMKM berhasil diperbarui.');
    }
}