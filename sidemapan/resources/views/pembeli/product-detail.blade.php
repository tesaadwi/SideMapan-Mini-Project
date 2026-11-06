@extends('layouts.pembeli')

@section('content')
<div class="container py-5">

    <div class="row g-4">
        <div class="col-md-5">
            @if($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}"
                     class="img-fluid rounded shadow-sm w-100"
                     alt="{{ $product->nama_produk }}">
            @else
                <div class="bg-light rounded d-flex justify-content-center align-items-center"
                     style="height:350px">
                    <span class="text-muted">Tidak ada gambar</span>
                </div>
            @endif
        </div>

        <div class="col-md-7">
            <small class="text-muted">
                {{ $product->category->nama_kategori }}
            </small>

            <h2 class="fw-bold mt-2">
                {{ $product->nama_produk }}
            </h2>

            <h3 class="text-success fw-bold">
                Rp{{ number_format($product->harga, 0, ',', '.') }}
            </h3>

            <p class="text-muted">
                Stok tersedia: {{ $product->stok }}
            </p>

            <hr>

            <h5>Deskripsi Produk</h5>
            <p>{{ $product->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

            <hr>

            <h5>Informasi UMKM</h5>
            <p class="mb-1">
                <strong>{{ $product->umkm->nama_umkm }}</strong>
            </p>
            <p>{{ $product->umkm->alamat }}</p>

            {{-- Form Tambahkan ke Keranjang --}}
            @if($product->status === 'aktif' && $product->stok > 0)
                @auth
                    @if(auth()->user()->role === 'pembeli')
                        <form
                            action="{{ route('pembeli.cart.store', $product) }}"
                            method="POST"
                            class="mt-4"
                        >
                            @csrf

                            <div class="mb-3">
                                <label for="quantity" class="form-label">
                                    Jumlah
                                </label>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    min="1"
                                    max="{{ $product->stok }}"
                                    value="1"
                                    class="form-control"
                                    style="max-width: 150px"
                                    required
                                >

                                @error('quantity')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cart-plus"></i>
                                Tambahkan ke Keranjang
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">
                        Login untuk Membeli
                    </a>
                @endauth
            @else
                <button class="btn btn-secondary mt-3" disabled>
                    Produk Tidak Tersedia
                </button>
            @endif

            <hr>

            <a href="{{ route('marketplace.index') }}"
               class="btn btn-outline-secondary">
                Kembali ke Marketplace
            </a>
        </div>
    </div>
</div>
@endsection