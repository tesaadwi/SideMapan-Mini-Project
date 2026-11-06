<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - DesaHub</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .detail-card {
            transition: all 0.25s ease;
        }

        .detail-card:hover {
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <nav class="bg-white shadow-sm sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-5 lg:px-8">

            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a
                    href="{{ route('pembeli.dashboard') }}"
                    class="flex items-center gap-2"
                >

                    <div
                        class="w-10 h-10 rounded-xl bg-green-600 text-white flex items-center justify-center"
                    >
                        <i class="fas fa-store text-lg"></i>
                    </div>

                    <span class="text-xl font-bold text-green-700">
                        DesaHub
                    </span>

                </a>


                {{-- Navigation --}}
                <div class="hidden md:flex items-center gap-7">

                    <a
                        href="{{ route('pembeli.cart.index') }}"
                        class="text-gray-600 hover:text-green-600 font-medium transition"
                    >
                        <i class="fas fa-shopping-cart mr-1"></i>
                        Keranjang
                    </a>

                    <a
                        href="{{ route('pembeli.orders.index') }}"
                        class="text-gray-600 hover:text-green-600 font-medium transition"
                    >
                        <i class="fas fa-box mr-1"></i>
                        Pesanan
                    </a>

                    <a
                        href="{{ route('pembeli.aspirasi.index') }}"
                        class="text-gray-600 hover:text-green-600 font-medium transition"
                    >
                        <i class="fas fa-comment-dots mr-1"></i>
                        Aspirasi
                    </a>

                </div>


                {{-- User --}}
                <div class="flex items-center gap-3">

                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-semibold">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Pembeli
                        </p>

                    </div>

                    <div
                        class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="text-red-500 hover:bg-red-50 px-3 py-2 rounded-lg transition"
                            title="Logout"
                        >
                            <i class="fas fa-sign-out-alt"></i>

                            <span class="hidden lg:inline ml-1">
                                Keluar
                            </span>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <main class="max-w-7xl mx-auto px-5 lg:px-8 py-8">

        {{-- Back --}}
        <div class="mb-6">

            <a
                href="{{ route('pembeli.dashboard') }}#produk-umkm"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 font-medium transition"
            >
                <i class="fas fa-arrow-left"></i>
                Kembali ke Produk UMKM
            </a>

        </div>


        {{-- ===================================================== --}}
        {{-- DETAIL PRODUK --}}
        {{-- ===================================================== --}}

        <div
            class="detail-card bg-white rounded-3xl border border-gray-100 overflow-hidden"
        >

            <div class="grid grid-cols-1 lg:grid-cols-2">


                {{-- ================================================= --}}
                {{-- GAMBAR PRODUK --}}
                {{-- ================================================= --}}

                <div class="bg-gray-100 min-h-[420px]">

                    @if ($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full min-h-[420px] object-cover"
                        >

                    @else

                        <div
                            class="w-full min-h-[420px] flex items-center justify-center"
                        >

                            <div class="text-center text-gray-400">

                                <i class="fas fa-image text-6xl mb-4"></i>

                                <p class="text-sm">
                                    Tidak ada gambar produk
                                </p>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- INFORMASI PRODUK --}}
                {{-- ================================================= --}}

                <div class="p-7 md:p-10">

                    {{-- Category --}}
                    @if ($product->category)

                        <span
                            class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium mb-4"
                        >
                            <i class="fas fa-tag mr-2"></i>
                            {{ $product->category->name }}
                        </span>

                    @endif


                    {{-- Product Name --}}
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $product->name }}
                    </h1>


                    {{-- UMKM --}}
                    <div class="flex items-center gap-2 mt-4 text-gray-500">

                        <i class="fas fa-store text-green-600"></i>

                        <span>
                            Dijual oleh
                        </span>

                        <span class="font-semibold text-gray-700">
                            {{ $product->umkm->name ?? 'UMKM Desa Gilang' }}
                        </span>

                    </div>


                    {{-- Price --}}
                    <div class="mt-6">

                        <p class="text-sm text-gray-500 mb-1">
                            Harga
                        </p>

                        <p class="text-3xl font-bold text-green-600">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>

                    </div>


                    {{-- Stock --}}
                    <div class="mt-5">

                        <div class="flex items-center gap-2 text-gray-600">

                            <i class="fas fa-box-open text-green-600"></i>

                            <span>
                                Stok tersedia:
                            </span>

                            <span class="font-semibold">
                                {{ $product->stock }}
                            </span>

                        </div>

                    </div>


                    {{-- Divider --}}
                    <div class="border-t border-gray-100 my-6"></div>


                    {{-- Description --}}
                    <div>

                        <h2 class="font-bold text-lg mb-2">
                            Deskripsi Produk
                        </h2>

                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?: 'Tidak ada deskripsi produk.' }}
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ADD TO CART --}}
                    {{-- ================================================= --}}

                    <form
                        action="{{ route('pembeli.cart.store') }}"
                        method="POST"
                        class="mt-8"
                    >

                        @csrf

                        <div class="flex flex-col sm:flex-row gap-3">

                            {{-- Quantity --}}
                            <div
                                class="flex items-center border border-gray-300 rounded-xl overflow-hidden"
                            >

                                <button
                                    type="button"
                                    onclick="decreaseQuantity()"
                                    class="w-11 h-11 text-gray-500 hover:bg-gray-100"
                                >
                                    <i class="fas fa-minus"></i>
                                </button>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    class="w-16 h-11 text-center border-x border-gray-300 focus:outline-none"
                                >

                                <button
                                    type="button"
                                    onclick="increaseQuantity()"
                                    class="w-11 h-11 text-gray-500 hover:bg-gray-100"
                                >
                                    <i class="fas fa-plus"></i>
                                </button>

                            </div>


                            {{-- Product ID --}}
                            <input
                                type="hidden"
                                name="product_id"
                                value="{{ $product->id }}"
                            >


                            {{-- Add Cart --}}
                            <button
                                type="submit"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl px-6 py-3 transition"
                            >

                                <i class="fas fa-shopping-cart mr-2"></i>

                                Tambah ke Keranjang

                            </button>

                        </div>

                    </form>


                    {{-- Success message --}}
                    @if (session('success'))

                        <div
                            class="mt-5 bg-green-100 border border-green-200 text-green-700 rounded-xl px-4 py-3"
                        >

                            <i class="fas fa-check-circle mr-2"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- Error --}}
                    @if ($errors->any())

                        <div
                            class="mt-5 bg-red-100 border border-red-200 text-red-700 rounded-xl px-4 py-3"
                        >

                            <ul class="list-disc list-inside text-sm">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="mt-10 border-t border-gray-200 bg-white">

        <div
            class="max-w-7xl mx-auto px-5 lg:px-8 py-5 text-center text-sm text-gray-500"
        >

            &copy; {{ date('Y') }} DesaHub.
            Mendukung UMKM lokal desa.

        </div>

    </footer>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>

        function decreaseQuantity() {

            const input = document.getElementById('quantity');

            let value = parseInt(input.value);

            if (value > 1) {
                input.value = value - 1;
            }

        }


        function increaseQuantity() {

            const input = document.getElementById('quantity');

            let value = parseInt(input.value);

            const max = parseInt(input.max);

            if (value < max) {
                input.value = value + 1;
            }

        }

    </script>

</body>

</html>