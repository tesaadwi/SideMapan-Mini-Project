<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Pembeli - SideMapan</title>

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

        .menu-card {
            transition: all 0.25s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }

        .product-card {
            transition: all 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
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

                {{-- LOGO --}}
                <a
                    href="{{ route('pembeli.dashboard') }}"
                    class="flex items-center gap-2"
                >

                    <div class="w-10 h-10 rounded-xl bg-green-600 text-white flex items-center justify-center">

                        <i class="fas fa-store text-lg"></i>

                    </div>

                    <span class="text-xl font-bold text-green-700">
                        SideMapan
                    </span>

                </a>


                {{-- NAVIGASI --}}
                <div class="hidden md:flex items-center gap-7">

                    {{-- KERANJANG --}}
                    <a
                        href="{{ route('pembeli.cart.index') }}"
                        class="text-gray-600 hover:text-green-600 font-medium transition"
                    >

                        <i class="fas fa-shopping-cart mr-1"></i>

                        Keranjang

                    </a>


                    {{-- PESANAN --}}
                    <a
                        href="{{ route('pembeli.orders.index') }}"
                        class="text-gray-600 hover:text-green-600 font-medium transition"
                    >

                        <i class="fas fa-box mr-1"></i>

                        Pesanan

                    </a>


                    {{-- ASPIRASI --}}
                    <a
                        href="{{ route('pembeli.aspirasi.index') }}"
                        class="text-gray-600 hover:text-green-600 font-medium transition"
                    >

                        <i class="fas fa-comment-dots mr-1"></i>

                        Aspirasi

                    </a>

                </div>


                {{-- PROFIL + LOGOUT --}}
                <div class="flex items-center gap-3">

                    {{-- NAMA --}}
                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-semibold">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Pembeli
                        </p>

                    </div>


                    {{-- AVATAR --}}
                    <div
                        class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold"
                    >

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>


                    {{-- LOGOUT --}}
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
    {{-- KONTEN UTAMA --}}
    {{-- ========================================================= --}}

    <main class="max-w-7xl mx-auto px-5 lg:px-8 py-8">


        {{-- ===================================================== --}}
        {{-- PESAN SUKSES --}}
        {{-- ===================================================== --}}

        @if (session('success'))

            <div
                class="mb-6 rounded-xl bg-green-100 border border-green-200 text-green-800 px-5 py-3"
            >

                <i class="fas fa-check-circle mr-2"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- HERO --}}
        {{-- ===================================================== --}}

        <section
            class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-700 to-emerald-500 text-white p-8 md:p-12 mb-8"
        >

            <div class="relative z-10 max-w-2xl">

                <p class="text-green-100 text-sm font-medium mb-2">
                    DASHBOARD PEMBELI
                </p>


                <h1 class="text-3xl md:text-4xl font-bold mb-3">
                    Halo, {{ auth()->user()->name }}!
                </h1>


                <p class="text-green-50 text-base md:text-lg mb-6">

                    Selamat datang di SideMapan.

                    Temukan produk UMKM lokal
                    dan dukung perkembangan usaha di desa.

                </p>


                {{-- SCROLL KE PRODUK --}}
                <a
                    href="#produk-umkm"
                    class="inline-flex items-center gap-2 bg-white text-green-700 font-semibold px-5 py-3 rounded-xl hover:bg-green-50 transition"
                >

                    Mulai Belanja

                    <i class="fas fa-arrow-down"></i>

                </a>

            </div>


            {{-- ICON HERO --}}
            <div
                class="absolute right-8 bottom-0 opacity-20 hidden md:block"
            >

                <i class="fas fa-shopping-basket text-[180px]"></i>

            </div>

        </section>


        {{-- ===================================================== --}}
        {{-- MENU UTAMA --}}
        {{-- ===================================================== --}}

        <section class="mb-10">

            <div class="flex justify-between items-center mb-5">

                <div>

                    <h2 class="text-xl md:text-2xl font-bold">
                        Menu Pembeli
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Akses fitur yang kamu butuhkan.
                    </p>

                </div>

            </div>


            {{-- 3 MENU --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


                {{-- ================================================= --}}
                {{-- KERANJANG --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('pembeli.cart.index') }}"
                    class="menu-card bg-white rounded-2xl p-6 border border-gray-100"
                >

                    <div
                        class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl mb-4"
                    >

                        <i class="fas fa-shopping-cart"></i>

                    </div>


                    <h3 class="font-bold text-lg mb-2">
                        Keranjang Belanja
                    </h3>


                    <p class="text-sm text-gray-500 mb-4">
                        Periksa produk yang ingin kamu beli.
                    </p>


                    <span class="text-orange-600 text-sm font-semibold">

                        Buka keranjang

                        <i class="fas fa-arrow-right ml-1"></i>

                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- PESANAN --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('pembeli.orders.index') }}"
                    class="menu-card bg-white rounded-2xl p-6 border border-gray-100"
                >

                    <div
                        class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mb-4"
                    >

                        <i class="fas fa-box"></i>

                    </div>


                    <h3 class="font-bold text-lg mb-2">
                        Pesanan Saya
                    </h3>


                    <p class="text-sm text-gray-500 mb-4">
                        Lihat riwayat dan status pesananmu.
                    </p>


                    <span class="text-blue-600 text-sm font-semibold">

                        Lihat pesanan

                        <i class="fas fa-arrow-right ml-1"></i>

                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- ASPIRASI --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('pembeli.aspirasi.index') }}"
                    class="menu-card bg-white rounded-2xl p-6 border border-gray-100"
                >

                    <div
                        class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl mb-4"
                    >

                        <i class="fas fa-comment-dots"></i>

                    </div>


                    <h3 class="font-bold text-lg mb-2">
                        Aspirasi & Pengaduan
                    </h3>


                    <p class="text-sm text-gray-500 mb-4">
                        Sampaikan aspirasi dan pengaduanmu.
                    </p>


                    <span class="text-purple-600 text-sm font-semibold">

                        Buka aspirasi

                        <i class="fas fa-arrow-right ml-1"></i>

                    </span>

                </a>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- PRODUK UMKM --}}
        {{-- ===================================================== --}}

        <section
            id="produk-umkm"
            class="mb-10"
        >

            {{-- HEADER PRODUK --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-5">

                <div>

                    <h2 class="text-xl md:text-2xl font-bold">
                        Produk UMKM Desa Gilang
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Temukan dan dukung produk usaha lokal desa.
                    </p>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- GRID PRODUK --}}
            {{-- ================================================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                @forelse ($products as $product)

                    {{-- ========================================= --}}
                    {{-- CARD PRODUK --}}
                    {{-- ========================================= --}}

                    <div
                        class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden"
                    >

                        
{{-- GAMBAR PRODUK --}}
@php
    $gambarProduk = $product->image
        ? asset('storage/' . ltrim($product->image, '/'))
        : null;
@endphp

@if ($gambarProduk)
    <img
        src="{{ $gambarProduk }}"
        alt="{{ $product->name }}"
        class="w-full h-48 object-cover"
        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';"
    >

    <div
        class="w-full h-48 bg-gray-100 items-center justify-center"
        style="display: none;"
    >
        <div class="text-center text-gray-400">
            <i class="fas fa-image text-4xl mb-2"></i>
            <p class="text-sm">Gambar tidak ditemukan</p>
        </div>
    </div>
@else
    <div
        class="w-full h-48 bg-gray-100 flex items-center justify-center"
    >
        <div class="text-center text-gray-400">
            <i class="fas fa-image text-4xl mb-2"></i>
            <p class="text-sm">Tidak ada gambar</p>
        </div>
    </div>
@endif



                        {{-- INFORMASI PRODUK --}}
                        <div class="p-5">


                            {{-- KATEGORI --}}
                            @if ($product->category)

                                <p class="text-xs text-green-600 font-medium mb-1">

                                    {{ $product->category->name }}

                                </p>

                            @endif


                            {{-- NAMA PRODUK --}}
                            <h3 class="font-bold text-lg text-gray-800">

                                {{ $product->name }}

                            </h3>


                            {{-- NAMA UMKM --}}
                            <p class="text-sm text-gray-500 mt-1">

                                <i class="fas fa-store mr-1"></i>

                                {{ $product->umkm->name ?? 'UMKM Desa Gilang' }}

                            </p>


                            {{-- HARGA --}}
                            <p class="text-green-600 font-bold text-lg mt-3">

                                Rp{{ number_format($product->price, 0, ',', '.') }}

                            </p>


                            {{-- STOK --}}
                            <p class="text-sm text-gray-500 mt-1">

                                <i class="fas fa-box-open mr-1"></i>

                                Stok tersedia: {{ $product->stock }}

                            </p>


                            {{-- DETAIL PRODUK --}}
                            <a
                                href="{{ route('pembeli.marketplace.show', $product->slug) }}"
                                class="block text-center bg-green-600 hover:bg-green-700 text-white rounded-xl py-2.5 mt-4 font-medium transition"
                            >

                                <i class="fas fa-eye mr-1"></i>

                                Lihat Produk

                            </a>

                        </div>

                    </div>

                @empty

                    {{-- ========================================= --}}
                    {{-- JIKA PRODUK KOSONG --}}
                    {{-- ========================================= --}}

                    <div
                        class="col-span-full bg-white rounded-2xl border border-gray-100 p-10 text-center"
                    >

                        <div class="text-gray-400">

                            <i class="fas fa-box-open text-5xl mb-4"></i>

                            <p class="text-lg font-semibold text-gray-500">

                                Belum ada produk UMKM

                            </p>

                            <p class="text-sm text-gray-400 mt-1">

                                Produk UMKM yang tersedia akan muncul di sini.

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- INFORMASI AKUN --}}
        {{-- ===================================================== --}}

        <section
            class="bg-white rounded-2xl border border-gray-100 p-6"
        >

            {{-- HEADER --}}
            <div class="flex items-center gap-3 mb-5">

                <div
                    class="w-11 h-11 rounded-xl bg-green-100 text-green-700 flex items-center justify-center"
                >

                    <i class="fas fa-user"></i>

                </div>


                <div>

                    <h2 class="text-xl font-bold">
                        Informasi Akun
                    </h2>

                    <p class="text-sm text-gray-500">
                        Informasi akun yang sedang digunakan.
                    </p>

                </div>

            </div>


            {{-- INFORMASI --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- NAMA --}}
                <div class="bg-gray-50 rounded-xl p-4">

                    <p class="text-sm text-gray-500 mb-1">
                        Nama Lengkap
                    </p>

                    <p class="font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                </div>


                {{-- EMAIL --}}
                <div class="bg-gray-50 rounded-xl p-4">

                    <p class="text-sm text-gray-500 mb-1">
                        Alamat Email
                    </p>

                    <p class="font-semibold break-all">
                        {{ auth()->user()->email }}
                    </p>

                </div>

            </div>

        </section>

    </main>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="mt-10 border-t border-gray-200 bg-white">

        <div
            class="max-w-7xl mx-auto px-5 lg:px-8 py-5 text-center text-sm text-gray-500"
        >

            &copy; {{ date('Y') }} SideMapan.
            Mendukung UMKM lokal desa.

        </div>

    </footer>

</body>

</html>