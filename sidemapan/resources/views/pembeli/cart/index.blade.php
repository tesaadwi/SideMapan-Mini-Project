@extends('layouts.pembeli')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-800
                            flex items-center justify-center">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-slate-800">
                    Keranjang Belanja
                </h1>
            </div>

            <p class="text-sm text-slate-500">
                Periksa produk yang ingin kamu beli sebelum checkout.
            </p>
        </div>

        <a href="{{ route('pembeli.dashboard') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  border border-green-200
                  text-green-800
                  bg-white
                  hover:bg-green-50
                  hover:border-green-300
                  text-sm font-semibold
                  transition duration-200">

            <i class="fa-solid fa-arrow-left"></i>

            Belanja Lagi

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200
                    bg-green-50 px-4 py-3.5
                    text-sm text-green-700
                    flex items-center gap-2">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 px-4 py-3.5
                    text-sm text-red-700
                    flex items-center gap-2">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- KERANJANG KOSONG --}}
    @if($carts->isEmpty())

        <div class="bg-white border border-slate-200
                    rounded-2xl shadow-sm">

            <div class="flex flex-col items-center justify-center
                        text-center py-24 px-6">

                <div class="w-24 h-24 rounded-full
                            bg-green-100
                            text-green-700
                            flex items-center justify-center
                            mb-6">

                    <i class="fa-solid fa-cart-shopping text-4xl"></i>

                </div>

                <h2 class="text-xl md:text-2xl font-bold text-slate-800 mb-2">
                    Keranjang Kamu Masih Kosong
                </h2>

                <p class="text-sm text-slate-500 max-w-md mb-7 leading-relaxed">
                    Yuk, temukan berbagai produk UMKM Desa Gilang
                    dan mulai berbelanja.
                </p>

                <a href="{{ route('pembeli.dashboard') }}"
                   class="inline-flex items-center gap-2
                          bg-green-800 hover:bg-green-900
                          text-white
                          px-6 py-3
                          rounded-xl
                          text-sm font-semibold
                          shadow-sm
                          hover:shadow
                          transition duration-200">

                    <i class="fa-solid fa-store"></i>

                    Belanja Sekarang

                </a>

            </div>

        </div>


    {{-- ADA PRODUK --}}
    @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

            {{-- DAFTAR PRODUK --}}
            <div class="lg:col-span-2 space-y-4">

                @foreach($carts as $cart)

                    <div class="bg-white border border-slate-200
                                rounded-2xl shadow-sm
                                hover:shadow-md
                                transition duration-200
                                p-5">

                        <div class="flex flex-col sm:flex-row gap-5">

                            {{-- GAMBAR --}}
                            <div class="flex-shrink-0">

                                @if($cart->product->image)

                                    <img
                                        src="{{ asset('storage/' . $cart->product->image) }}"
                                        alt="{{ $cart->product->name }}"
                                        class="w-28 h-28 sm:w-32 sm:h-32
                                               object-cover
                                               rounded-xl
                                               border border-slate-100
                                               bg-slate-50"
                                    >

                                @else

                                    <div class="w-28 h-28 sm:w-32 sm:h-32
                                                bg-slate-100
                                                rounded-xl
                                                flex items-center
                                                justify-center">

                                        <i class="fa-solid fa-image
                                                  text-slate-400 text-2xl"></i>

                                    </div>

                                @endif

                            </div>


                            {{-- DETAIL PRODUK --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex justify-between gap-4">

                                    <div class="min-w-0">

                                        <h3 class="font-bold text-slate-800 text-base md:text-lg
                                                   truncate">
                                            {{ $cart->product->name }}
                                        </h3>

                                        @if($cart->product->category)

                                            <p class="text-xs text-slate-400 mt-1">
                                                <i class="fa-solid fa-tag mr-1"></i>
                                                {{ $cart->product->category->name }}
                                            </p>

                                        @endif

                                    </div>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('pembeli.cart.destroy', $cart) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus produk dari keranjang?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-9 h-9
                                                   flex items-center justify-center
                                                   rounded-lg
                                                   text-red-400
                                                   hover:text-red-600
                                                   hover:bg-red-50
                                                   transition duration-200"
                                            title="Hapus produk"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>


                                {{-- HARGA --}}
                                <p class="text-green-800 font-bold text-lg mt-3">

                                    Rp{{ number_format($cart->product->price, 0, ',', '.') }}

                                </p>


                                {{-- QUANTITY --}}
                                <div class="flex flex-col sm:flex-row
                                            sm:items-center
                                            sm:justify-between
                                            gap-4 mt-5">

                                    <form
                                        action="{{ route('pembeli.cart.update', $cart) }}"
                                        method="POST"
                                        class="flex items-center gap-2"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <div class="flex items-center
                                                    border border-slate-300
                                                    rounded-lg overflow-hidden
                                                    bg-white">

                                            <input
                                                type="number"
                                                name="quantity"
                                                min="1"
                                                max="{{ $cart->product->stock }}"
                                                value="{{ $cart->quantity }}"
                                                class="w-16 px-2 py-2
                                                       text-center
                                                       text-sm
                                                       text-slate-700
                                                       border-0
                                                       focus:outline-none
                                                       focus:ring-0"
                                            >

                                        </div>

                                        <button
                                            type="submit"
                                            class="px-3.5 py-2
                                                   bg-green-50
                                                   border border-green-200
                                                   text-green-800
                                                   rounded-lg
                                                   text-xs font-semibold
                                                   hover:bg-green-100
                                                   transition duration-200"
                                        >
                                            Ubah
                                        </button>

                                    </form>


                                    <div class="text-left sm:text-right">

                                        <p class="text-xs text-slate-400 mb-1">
                                            Subtotal
                                        </p>

                                        <p class="font-bold text-slate-800 text-base">
                                            Rp{{ number_format($cart->subtotal, 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>


                                <p class="text-xs text-slate-400 mt-3">

                                    <i class="fa-solid fa-box mr-1"></i>

                                    Stok tersedia:
                                    <span class="font-medium text-slate-500">
                                        {{ $cart->product->stock }}
                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- RINGKASAN --}}
            <div>

                <div class="bg-white border border-slate-200
                            rounded-2xl shadow-sm p-6
                            sticky top-6">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-10 h-10 rounded-xl
                                    bg-green-100 text-green-800
                                    flex items-center justify-center">

                            <i class="fa-solid fa-receipt"></i>

                        </div>

                        <h2 class="font-bold text-lg text-slate-800">
                            Ringkasan Belanja
                        </h2>

                    </div>


                    <div class="flex justify-between
                                text-sm text-slate-500 mb-3">

                        <span>
                            Total Produk
                        </span>

                        <span class="font-medium text-slate-700">
                            {{ $carts->count() }} item
                        </span>

                    </div>


                    <div class="border-t border-slate-100 pt-4 mt-4">

                        <div class="flex justify-between items-center gap-4">

                            <span class="font-semibold text-slate-700">
                                Total Belanja
                            </span>

                            <span class="text-xl font-bold text-green-800 text-right">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>

                    </div>


                    <a href="{{ route('pembeli.checkout.index') }}"
                       class="mt-6 w-full
                              inline-flex items-center justify-center gap-2
                              bg-green-800 hover:bg-green-900
                              text-white
                              py-3.5
                              rounded-xl
                              text-sm font-semibold
                              shadow-sm
                              hover:shadow
                              transition duration-200">

                        <i class="fa-solid fa-credit-card"></i>

                        Lanjut Checkout

                    </a>

                    <p class="text-xs text-center text-slate-400 mt-3">
                        Pastikan jumlah dan produk sudah sesuai.
                    </p>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection
