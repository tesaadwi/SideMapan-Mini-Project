@extends('layouts.pembeli')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-7xl">

        {{-- HEADER --}}
        <div class="mb-8">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-2xl bg-gradient-to-br from-green-700 to-emerald-600
                            text-white shadow-lg shadow-green-200">
                    <i class="fa-solid fa-box-open text-lg"></i>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                        Pesanan Saya
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Lihat dan pantau semua pesanan yang kamu buat.
                    </p>
                </div>

            </div>
        </div>


        {{-- ORDER LIST --}}
        @forelse($orders as $order)

            <div class="mb-5 overflow-hidden rounded-3xl border border-slate-200
                        bg-white shadow-sm transition duration-200
                        hover:-translate-y-0.5 hover:border-green-200 hover:shadow-md">

                {{-- ORDER HEADER --}}
                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex flex-col gap-4 sm:flex-row
                                sm:items-center sm:justify-between">

                        <div class="flex items-start gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center
                                        rounded-xl bg-green-50 text-green-700">
                                <i class="fa-solid fa-receipt"></i>
                            </div>

                            <div>

                                <h2 class="font-bold text-slate-900">
                                    {{ $order->order_number }}
                                </h2>

                                <p class="mt-1 flex items-center gap-1.5 text-xs text-slate-400">
                                    <i class="fa-regular fa-calendar"></i>

                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            @php
                                $badges = [
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

                                $status = $badges[$order->status] ?? [
                                    'bg' => 'bg-slate-100',
                                    'text' => 'text-slate-600',
                                    'icon' => 'fa-circle-info',
                                    'label' => ucfirst($order->status)
                                ];
                            @endphp

                            <span class="inline-flex items-center gap-2 rounded-full
                                         px-3 py-1.5 text-xs font-semibold
                                         {{ $status['bg'] }} {{ $status['text'] }}">

                                <i class="fa-solid {{ $status['icon'] }}"></i>

                                {{ $status['label'] }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ORDER CONTENT --}}
                <div class="px-6 py-5">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                        {{-- JUMLAH PRODUK --}}
                        <div class="rounded-2xl bg-slate-50 p-4">

                            <div class="mb-2 flex items-center gap-2">

                                <div class="flex h-8 w-8 items-center justify-center
                                            rounded-lg bg-white text-green-700 shadow-sm">
                                    <i class="fa-solid fa-box text-sm"></i>
                                </div>

                                <span class="text-xs font-medium text-slate-500">
                                    Jumlah Produk
                                </span>

                            </div>

                            <p class="text-lg font-bold text-slate-900">
                                {{ $order->items->sum('quantity') }}
                                <span class="text-sm font-medium text-slate-400">
                                    produk
                                </span>
                            </p>

                        </div>


                        {{-- SUBTOTAL --}}
                        <div class="rounded-2xl bg-slate-50 p-4">

                            <div class="mb-2 flex items-center gap-2">

                                <div class="flex h-8 w-8 items-center justify-center
                                            rounded-lg bg-white text-green-700 shadow-sm">
                                    <i class="fa-solid fa-receipt text-sm"></i>
                                </div>

                                <span class="text-xs font-medium text-slate-500">
                                    Subtotal
                                </span>

                            </div>

                            <p class="text-lg font-bold text-slate-900">
                                Rp{{ number_format($order->subtotal, 0, ',', '.') }}
                            </p>

                        </div>


                        {{-- ONGKIR --}}
                        <div class="rounded-2xl bg-slate-50 p-4">

                            <div class="mb-2 flex items-center gap-2">

                                <div class="flex h-8 w-8 items-center justify-center
                                            rounded-lg bg-white text-emerald-700 shadow-sm">
                                    <i class="fa-solid fa-truck text-sm"></i>
                                </div>

                                <span class="text-xs font-medium text-slate-500">
                                    Ongkos Kirim
                                </span>

                            </div>

                            <p class="text-lg font-bold text-slate-900">
                                Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>


                    {{-- TOTAL + DETAIL --}}
                    <div class="mt-5 flex flex-col gap-4 border-t border-slate-100
                                pt-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-xs font-medium text-slate-400">
                                Total Pembayaran
                            </p>

                            <p class="mt-1 text-2xl font-extrabold text-green-800">
                                Rp{{ number_format($order->total, 0, ',', '.') }}
                            </p>

                        </div>


                        <a
                            href="{{ route('pembeli.orders.show', $order) }}"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-green-700 px-5 py-3
                                   text-sm font-semibold text-white
                                   shadow-sm shadow-green-200
                                   transition duration-200
                                   hover:-translate-y-0.5
                                   hover:bg-green-800
                                   hover:shadow-md"
                        >

                            Lihat Detail

                            <i class="fa-solid fa-arrow-right text-xs
                                      transition-transform duration-200
                                      group-hover:translate-x-1"></i>

                        </a>

                    </div>

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="rounded-3xl border border-slate-200 bg-white
                        px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center
                            rounded-3xl bg-green-50 text-green-700">

                    <i class="fa-solid fa-box-open text-3xl"></i>

                </div>

                <h2 class="mt-5 text-lg font-bold text-slate-900">
                    Belum Ada Pesanan
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    Kamu belum memiliki pesanan.
                    Yuk, temukan produk menarik dari UMKM Desa Gilang.
                </p>

                <a
                    href="{{ route('pembeli.dashboard') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl
                           bg-green-700 px-5 py-3 text-sm font-semibold
                           text-white shadow-sm shadow-green-200
                           transition hover:bg-green-800"
                >
                    <i class="fa-solid fa-store"></i>
                    Mulai Belanja
                </a>

            </div>

        @endforelse


        {{-- PAGINATION --}}
        @if($orders->hasPages())

            <div class="mt-6 rounded-2xl border border-slate-200
                        bg-white px-5 py-4 shadow-sm">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
