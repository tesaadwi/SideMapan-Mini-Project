@extends('layouts.pembeli')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-6xl">

        {{-- HEADER --}}
        <div class="mb-6">

            <a href="{{ route('pembeli.orders.index') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold
                      text-slate-500 transition hover:text-green-700">

                <i class="fa-solid fa-arrow-left text-xs"></i>

                Kembali ke Pesanan

            </a>

        </div>


        {{-- FLASH MESSAGE --}}
        @if(session('success'))

            <div class="mb-5 flex items-start gap-3 rounded-2xl
                        border border-emerald-200 bg-emerald-50 p-4">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div>
                    <p class="font-semibold text-emerald-800">
                        Berhasil
                    </p>

                    <p class="text-sm text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="mb-5 flex items-start gap-3 rounded-2xl
                        border border-red-200 bg-red-50 p-4">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center
                            rounded-xl bg-red-100 text-red-600">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>

                <div>
                    <p class="font-semibold text-red-800">
                        Terjadi Kesalahan
                    </p>

                    <p class="text-sm text-red-700">
                        {{ session('error') }}
                    </p>
                </div>

            </div>

        @endif


        {{-- TITLE --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row
                    sm:items-center sm:justify-between">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-2xl bg-gradient-to-br from-green-700
                            to-emerald-600 text-white shadow-lg
                            shadow-green-200">

                    <i class="fa-solid fa-receipt text-lg"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                        Detail Pesanan
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $order->order_number }}
                    </p>

                </div>

            </div>


            {{-- STATUS --}}
            @php
                $statuses = [
                    'pending' => [
                        'bg' => 'bg-amber-50',
                        'text' => 'text-amber-700',
                        'icon' => 'fa-clock',
                        'label' => 'Menunggu'
                    ],
                    'processing' => [
                        'bg' => 'bg-blue-50',
                        'text' => 'text-blue-700',
                        'icon' => 'fa-spinner',
                        'label' => 'Diproses'
                    ],
                    'shipped' => [
                        'bg' => 'bg-indigo-50',
                        'text' => 'text-indigo-700',
                        'icon' => 'fa-truck',
                        'label' => 'Dikirim'
                    ],
                    'completed' => [
                        'bg' => 'bg-emerald-50',
                        'text' => 'text-emerald-700',
                        'icon' => 'fa-circle-check',
                        'label' => 'Selesai'
                    ],
                    'cancelled' => [
                        'bg' => 'bg-red-50',
                        'text' => 'text-red-700',
                        'icon' => 'fa-circle-xmark',
                        'label' => 'Dibatalkan'
                    ],
                ];

                $status = $statuses[$order->status] ?? [
                    'bg' => 'bg-slate-100',
                    'text' => 'text-slate-600',
                    'icon' => 'fa-circle-info',
                    'label' => ucfirst($order->status)
                ];
            @endphp

            <span class="inline-flex w-fit items-center gap-2 rounded-full
                         px-4 py-2 text-sm font-semibold
                         {{ $status['bg'] }} {{ $status['text'] }}">

                <i class="fa-solid {{ $status['icon'] }}"></i>

                {{ $status['label'] }}

            </span>

        </div>


        {{-- MAIN CONTENT --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- =============================== --}}
            {{-- PRODUK --}}
            {{-- =============================== --}}
            <div class="lg:col-span-2">

                <div class="overflow-hidden rounded-3xl border border-slate-200
                            bg-white shadow-sm">

                    {{-- CARD HEADER --}}
                    <div class="border-b border-slate-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-green-50 text-green-700">

                                <i class="fa-solid fa-box-open"></i>

                            </div>

                            <div>

                                <h2 class="font-bold text-slate-900">
                                    Produk
                                </h2>

                                <p class="text-xs text-slate-500">
                                    Produk yang terdapat dalam pesanan ini
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- PRODUCT LIST --}}
                    <div class="divide-y divide-slate-100">

                        @foreach($order->items as $item)

                            <div class="flex items-center gap-4 px-6 py-5
                                        transition hover:bg-slate-50">

                                {{-- PRODUCT IMAGE --}}
                                <div class="flex h-16 w-16 shrink-0 items-center
                                            justify-center overflow-hidden rounded-2xl
                                            bg-slate-100">

                                    @if($item->product && $item->product->image)

                                        <img
                                            src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product_name }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        <i class="fa-solid fa-image text-slate-400"></i>

                                    @endif

                                </div>


                                {{-- PRODUCT INFO --}}
                                <div class="min-w-0 flex-1">

                                    <h3 class="font-semibold text-slate-900">
                                        {{ $item->product_name }}
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">

                                        {{ $item->quantity }} ×

                                        Rp{{ number_format($item->price, 0, ',', '.') }}

                                    </p>

                                </div>


                                {{-- SUBTOTAL --}}
                                <div class="text-right">

                                    <p class="text-sm font-bold text-slate-900">
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Subtotal
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =============================== --}}
            {{-- INFORMASI PESANAN --}}
            {{-- =============================== --}}
            <div class="space-y-6">

                {{-- SHIPPING --}}
                <div class="rounded-3xl border border-slate-200
                            bg-white p-6 shadow-sm">

                    <div class="mb-4 flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl bg-green-50 text-green-700">

                            <i class="fa-solid fa-location-dot"></i>

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900">
                                Pengiriman
                            </h2>

                            <p class="text-xs text-slate-500">
                                Alamat tujuan pesanan
                            </p>

                        </div>

                    </div>


                    <div class="rounded-2xl bg-slate-50 p-4">

                        <p class="text-sm leading-6 text-slate-600">
                            {{ $order->shipping_address }}
                        </p>

                    </div>

                </div>


                {{-- PAYMENT SUMMARY --}}
                <div class="rounded-3xl border border-slate-200
                            bg-white p-6 shadow-sm">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl bg-green-50 text-green-700">

                            <i class="fa-solid fa-wallet"></i>

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900">
                                Ringkasan Pembayaran
                            </h2>

                            <p class="text-xs text-slate-500">
                                Rincian biaya pesanan
                            </p>

                        </div>

                    </div>


                    <div class="space-y-3">

                        {{-- SUBTOTAL --}}
                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Subtotal
                            </span>

                            <span class="font-medium text-slate-700">
                                Rp{{ number_format($order->subtotal, 0, ',', '.') }}
                            </span>

                        </div>


                        {{-- SHIPPING --}}
                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Ongkos Kirim
                            </span>

                            <span class="font-medium text-slate-700">
                                Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}
                            </span>

                        </div>


                        <div class="border-t border-slate-100 pt-4">

                            <div class="flex items-end justify-between">

                                <div>

                                    <p class="text-xs font-medium text-slate-400">
                                        Total Pembayaran
                                    </p>

                                    <p class="mt-1 text-2xl font-extrabold
                                              text-green-800">
                                        Rp{{ number_format($order->total, 0, ',', '.') }}
                                    </p>

                                </div>

                                <i class="fa-solid fa-circle-check mb-1
                                          text-emerald-500"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
