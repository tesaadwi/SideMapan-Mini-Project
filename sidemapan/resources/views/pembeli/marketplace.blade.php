@extends('layouts.pembeli')

@section('content')

<div class="container mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">
            Marketplace DesaHub
        </h1>

        <p class="text-gray-600">
            Temukan berbagai produk UMKM Desa Gilang.
        </p>
    </div>

    {{-- PENCARIAN DAN FILTER --}}
    <form
        action="{{ route('pembeli.marketplace.index') }}"
        method="GET"
        class="flex flex-wrap gap-3 mb-8"
    >

        {{-- SEARCH --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="border border-gray-300 rounded-lg px-4 py-2 flex-1 min-w-[200px] focus:ring-2 focus:ring-green-500 focus:outline-none"
        >

        {{-- KATEGORI --}}
        <select
            name="category_id"
            class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
        >
            <option value="">
                Semua Kategori
            </option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- SORTING --}}
        <select
            name="sort"
            class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
        >
            <option value="">
                Terbaru
            </option>

            <option
                value="termurah"
                {{ request('sort') === 'termurah' ? 'selected' : '' }}
            >
                Termurah
            </option>

            <option
                value="termahal"
                {{ request('sort') === 'termahal' ? 'selected' : '' }}
            >
                Termahal
            </option>
        </select>

        {{-- BUTTON --}}
        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition"
        >
            <i class="fas fa-search mr-1"></i>
            Cari
        </button>

    </form>


    {{-- DAFTAR PRODUK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @forelse ($products as $product)

            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition bg-white">

                {{-- GAMBAR PRODUK --}}
                @if ($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-48 object-cover"
                    >

                @else

                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <div class="text-center text-gray-500">

                            <i class="fas fa-image text-3xl mb-2"></i>

                            <p>
                                Tidak ada gambar
                            </p>

                        </div>
                    </div>

                @endif


                {{-- INFORMASI PRODUK --}}
                <div class="p-4">

                    {{-- NAMA PRODUK --}}
                    <h2 class="font-semibold text-lg">
                        {{ $product->name }}
                    </h2>

                    {{-- NAMA UMKM --}}
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-store mr-1"></i>
                        {{ $product->umkm->name ?? 'UMKM' }}
                    </p>

                    {{-- KATEGORI --}}
                    @if ($product->category)

                        <p class="text-xs text-gray-400 mt-1">
                            {{ $product->category->name }}
                        </p>

                    @endif

                    {{-- HARGA --}}
                    <p class="text-green-600 font-bold mt-3">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    {{-- STOK --}}
                    <p class="text-sm text-gray-500 mt-1">
                        Stok: {{ $product->stock }}
                    </p>

                    {{-- DETAIL --}}
                    <a
                        href="{{ route('pembeli.marketplace.show', $product->slug) }}"
                        class="block text-center bg-green-600 hover:bg-green-700 text-white rounded-lg py-2 mt-4 transition"
                    >
                        <i class="fas fa-eye mr-1"></i>
                        Lihat Produk
                    </a>

                </div>

            </div>

        @empty

            {{-- JIKA PRODUK KOSONG --}}
            <div class="col-span-full text-center py-10">

                <div class="text-gray-400">

                    <i class="fas fa-box-open text-5xl mb-4"></i>

                    <p class="text-lg font-medium">
                        Produk tidak ditemukan.
                    </p>

                    <p class="text-sm mt-1">
                        Belum ada produk UMKM yang tersedia.
                    </p>

                </div>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}
    @if ($products->hasPages())

        <div class="mt-8">
            {{ $products->links() }}
        </div>

    @endif

</div>

@endsection