<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::with('user')->latest();

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasis = $query->paginate(10)->withQueryString();

        return view('admin.aspirasi.index', compact('aspirasis'));
    }

    public function show(Aspirasi $aspirasi)
    {
        $aspirasi->load('user');

        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['pending', 'processing', 'resolved', 'rejected']),
            ],
            'tanggapan' => 'nullable|string|max:5000',
        ]);

        $aspirasi->update($validated);

        return redirect()
            ->route('admin.aspirasi.show', $aspirasi)
            ->with('success', 'Aspirasi atau pengaduan berhasil diperbarui.');
    }
}
