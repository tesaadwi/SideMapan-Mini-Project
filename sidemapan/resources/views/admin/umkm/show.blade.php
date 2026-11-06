@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-4">Detail UMKM</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if($umkm->logo)
                <img src="{{ asset('storage/' . $umkm->logo) }}"
                     alt="Logo UMKM"
                     width="120"
                     class="mb-3 rounded">
            @endif

            <h4>{{ $umkm->nama_umkm }}</h4>

            <p class="text-muted">
                {{ $umkm->deskripsi ?? 'Tidak ada deskripsi.' }}
            </p>

            <hr>

            <p>
                <strong>Pemilik:</strong>
                {{ $umkm->user?->name ?? 'Belum terhubung' }}
            </p>

            <p>
                <strong>Alamat:</strong>
                {{ $umkm->alamat }}
            </p>

            <p>
                <strong>Telepon:</strong>
                {{ $umkm->no_telepon }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($umkm->status_verifikasi) }}
            </p>

            <hr>

            <h5>Produk UMKM</h5>

            @forelse($umkm->products as $product)
                <div class="border-bottom py-2">
                    {{ $product->nama_produk }}
                </div>
            @empty
                <p class="text-muted">Belum ada produk.</p>
            @endforelse

            <a href="{{ route('admin.umkm.index') }}"
               class="btn btn-secondary mt-3">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection