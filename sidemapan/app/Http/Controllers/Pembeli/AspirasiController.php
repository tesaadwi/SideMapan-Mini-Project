<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasis = Aspirasi::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pembeli.aspirasi.index', compact('aspirasis'));
    }

    public function create()
    {
        return view('pembeli.aspirasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:aspirasi,pengaduan',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|max:5000',
        ]);

        Aspirasi::create([
            'user_id' => auth()->id(),
            'jenis' => $validated['jenis'],
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
        ]);

        return redirect()
            ->route('pembeli.aspirasi.index')
            ->with('success', 'Aspirasi atau pengaduan berhasil dikirim.');
    }

    public function show(Aspirasi $aspirasi)
    {
        abort_unless($aspirasi->user_id === auth()->id(), 403);

        return view('pembeli.aspirasi.show', compact('aspirasi'));
    }
}
