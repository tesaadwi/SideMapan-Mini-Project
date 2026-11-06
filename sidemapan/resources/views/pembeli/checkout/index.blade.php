@extends('layouts.pembeli')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-7xl">

        {{-- HEADER --}}
        <div class="mb-8">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl
                            bg-gradient-to-br from-green-700 to-emerald-600
                            text-white shadow-lg shadow-green-200">
                    <i class="fa-solid fa-cart-shopping text-lg"></i>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                        Checkout
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Periksa pesanan dan lengkapi alamat pengiriman.
                    </p>
                </div>

            </div>
        </div>


        {{-- ERROR --}}
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">
                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center
                                rounded-xl bg-red-100 text-red-600">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>
                        <p class="font-semibold text-red-800">
                            Terdapat kesalahan
                        </p>

                        <ul class="mt-1 list-disc pl-5 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif


        {{-- CONTENT --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- ========================= --}}
            {{-- RINGKASAN PRODUK --}}
            {{-- ========================= --}}
            <div class="lg:col-span-2">

                <div class="overflow-hidden rounded-3xl border border-slate-200
                            bg-white shadow-sm">

                    {{-- CARD HEADER --}}
                    <div class="border-b border-slate-100 px-6 py-5">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                                            rounded-xl bg-green-50 text-green-700">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>

                                <div>
                                    <h2 class="font-bold text-slate-900">
                                        Ringkasan Produk
                                    </h2>

                                    <p class="text-xs text-slate-500">
                                        Produk yang akan kamu beli
                                    </p>
                                </div>

                            </div>

                            <span class="rounded-full bg-green-50 px-3 py-1.5
                                         text-xs font-semibold text-green-800">
                                {{ $carts->sum('quantity') }} produk
                            </span>

                        </div>

                    </div>


                    {{-- PRODUCT LIST --}}
                    <div class="divide-y divide-slate-100">

                        @foreach($carts as $cart)

                            <div class="flex items-center gap-4 px-6 py-5
                                        transition hover:bg-green-50/40">

                                {{-- IMAGE --}}
                                <div class="relative shrink-0">

                                    @if($cart->product->image)

                                        <img
                                            src="{{ asset('storage/' . $cart->product->image) }}"
                                            alt="{{ $cart->product->name }}"
                                            class="h-20 w-20 rounded-2xl border border-slate-200
                                                   object-cover shadow-sm"
                                        >

                                    @else

                                        <div class="flex h-20 w-20 items-center
                                                    justify-center rounded-2xl
                                                    bg-slate-100 text-slate-400">
                                            <i class="fa-solid fa-image text-xl"></i>
                                        </div>

                                    @endif

                                    {{-- QUANTITY BADGE --}}
                                    <span class="absolute -right-2 -top-2 flex h-6 min-w-6
                                                 items-center justify-center rounded-full
                                                 bg-green-700 px-1.5 text-xs font-bold
                                                 text-white shadow">
                                        {{ $cart->quantity }}
                                    </span>

                                </div>


                                {{-- PRODUCT INFO --}}
                                <div class="min-w-0 flex-1">

                                    <h3 class="truncate font-semibold text-slate-900">
                                        {{ $cart->product->name }}
                                    </h3>

                                    <div class="mt-1 flex flex-wrap items-center gap-2">

                                        <span class="text-xs text-slate-500">
                                            {{ $cart->product->umkm->name ?? 'UMKM Desa Gilang' }}
                                        </span>

                                        @if($cart->product->category)
                                            <span class="rounded-full bg-slate-100 px-2 py-1
                                                         text-[11px] font-medium text-slate-600">
                                                {{ $cart->product->category->name }}
                                            </span>
                                        @endif

                                    </div>

                                    <p class="mt-2 text-sm text-slate-500">
                                        {{ $cart->quantity }} ×
                                        <span class="font-medium text-slate-700">
                                            Rp{{ number_format($cart->product->price, 0, ',', '.') }}
                                        </span>
                                    </p>

                                </div>


                                {{-- SUBTOTAL --}}
                                <div class="text-right">

                                    <p class="text-sm font-bold text-slate-900">
                                        Rp{{ number_format($cart->subtotal, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Subtotal
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    {{-- TOTAL --}}
                    <div class="border-t border-slate-100 bg-green-50/50 px-6 py-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm font-medium text-slate-500">
                                    Total Pembayaran
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Sudah termasuk seluruh produk
                                </p>

                            </div>

                            <p class="text-2xl font-extrabold text-green-800">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- INFORMASI PENGIRIMAN --}}
            {{-- ========================= --}}
            <div>

                <div class="sticky top-6 overflow-hidden rounded-3xl
                            border border-slate-200 bg-white shadow-sm">

                    {{-- HEADER --}}
                    <div class="border-b border-slate-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-green-50 text-green-700">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div>

                                <h2 class="font-bold text-slate-900">
                                    Informasi Pengiriman
                                </h2>

                                <p class="text-xs text-slate-500">
                                    Alamat tujuan pesanan
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- FORM --}}
                    <div class="p-6">

                        <form
                            action="{{ route('pembeli.checkout.store') }}"
                            method="POST"
                        >

                            @csrf


                            {{-- ADDRESS --}}
                            <div class="mb-5">

                                <label
                                    for="shipping_address"
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Alamat Pengiriman
                                </label>

                                <div class="relative">

                                    <textarea
                                        id="shipping_address"
                                        name="shipping_address"
                                        rows="6"
                                        required
                                        placeholder="Masukkan alamat lengkap untuk pengiriman..."
                                        class="w-full resize-none rounded-2xl border border-slate-200
                                               bg-slate-50 px-4 py-3 text-sm text-slate-800
                                               outline-none transition
                                               placeholder:text-slate-400
                                               focus:border-green-600
                                               focus:bg-white
                                               focus:ring-4
                                               focus:ring-green-100"
                                    >{{ old('shipping_address') }}</textarea>

                                </div>

                                <p class="mt-2 flex items-center gap-1.5 text-xs text-slate-400">

                                    <i class="fa-solid fa-circle-info"></i>

                                    Pastikan alamat yang kamu masukkan sudah benar.

                                </p>

                            </div>


                            {{-- ORDER SUMMARY --}}
                            <div class="mb-5 rounded-2xl border border-green-100
                                        bg-gradient-to-br from-green-50 to-emerald-50
                                        p-4">

                                <div class="mb-3 flex items-center gap-2">

                                    <i class="fa-solid fa-receipt text-green-700"></i>

                                    <span class="text-sm font-semibold text-slate-700">
                                        Ringkasan Pembayaran
                                    </span>

                                </div>


                                <div class="space-y-3">

                                    <div class="flex justify-between text-sm">

                                        <span class="text-slate-500">
                                            Jumlah produk
                                        </span>

                                        <span class="font-medium text-slate-700">
                                            {{ $carts->sum('quantity') }} produk
                                        </span>

                                    </div>


                                    <div class="flex justify-between text-sm">

                                        <span class="text-slate-500">
                                            Subtotal
                                        </span>

                                        <span class="font-medium text-slate-700">
                                            Rp{{ number_format($total, 0, ',', '.') }}
                                        </span>

                                    </div>


                                    <div class="border-t border-green-200 pt-3">

                                        <div class="flex items-center justify-between">

                                            <span class="font-semibold text-slate-700">
                                                Total
                                            </span>

                                            <span class="text-xl font-extrabold text-green-800">
                                                Rp{{ number_format($total, 0, ',', '.') }}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- CHECKOUT BUTTON --}}
                            <button
                                type="submit"
                                class="group flex w-full items-center justify-center
                                       gap-2 rounded-2xl
                                       bg-gradient-to-r from-green-700 to-emerald-600
                                       px-5 py-3.5
                                       text-sm font-bold text-white
                                       shadow-lg shadow-green-200
                                       transition duration-200
                                       hover:-translate-y-0.5
                                       hover:from-green-800
                                       hover:to-emerald-700
                                       hover:shadow-xl
                                       active:translate-y-0"
                            >

                                <i class="fa-solid fa-check transition
                                          group-hover:scale-110"></i>

                                Buat Pesanan

                            </button>


                            {{-- BACK --}}
                            <a
                                href="{{ route('pembeli.cart.index') }}"
                                class="mt-3 flex w-full items-center justify-center
                                       gap-2 rounded-2xl border border-slate-200
                                       bg-white px-5 py-3
                                       text-sm font-semibold text-slate-600
                                       transition
                                       hover:border-green-200
                                       hover:bg-green-50
                                       hover:text-green-800"
                            >

                                <i class="fa-solid fa-arrow-left"></i>

                                Kembali ke Keranjang

                            </a>


                            {{-- SECURITY INFO --}}
                            <div class="mt-5 flex items-center justify-center
                                        gap-2 text-xs text-slate-400">

                                <i class="fa-solid fa-shield-halved"></i>

                                <span>Pesanan diproses dengan aman</span>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection