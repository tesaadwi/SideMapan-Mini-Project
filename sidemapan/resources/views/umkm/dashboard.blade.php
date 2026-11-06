@extends('layouts.umkm')

@section('title', 'Dashboard UMKM')

@section('content')

<div class="max-w-[1600px] mx-auto space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <div class="flex items-center gap-2 mb-2">
                    <span class="inline-flex items-center gap-1.5
                                 px-2.5 py-1 rounded-full
                                 bg-green-50 text-green-700
                                 text-xs font-semibold">

                        <i class="fa-solid fa-store text-[10px]"></i>

                        Panel UMKM
                    </span>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-slate-800">
                    Dashboard
                </h1>

                <p class="text-sm text-slate-500 mt-2">
                    Selamat datang kembali,
                    <span class="font-semibold text-slate-700">
                        {{ $umkm->name }}
                    </span>.
                    Kelola toko dan pantau penjualanmu di sini.
                </p>

            </div>


            {{-- QUICK ACTION --}}
            <div class="flex flex-wrap gap-2">

                <a href="{{ route('umkm.products.create') }}"
                   class="inline-flex items-center gap-2
                          px-4 py-2.5 rounded-xl
                          bg-green-600 text-white
                          text-sm font-semibold
                          hover:bg-green-700
                          transition shadow-sm">

                    <i class="fa-solid fa-plus"></i>

                    Tambah Produk

                </a>

                <a href="{{ route('umkm.orders.index') }}"
                   class="inline-flex items-center gap-2
                          px-4 py-2.5 rounded-xl
                          bg-white border border-slate-200
                          text-sm font-semibold
                          text-slate-700
                          hover:border-green-300
                          hover:text-green-600
                          hover:bg-green-50
                          transition">

                    <i class="fa-solid fa-receipt"></i>

                    Lihat Pesanan

                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
        STATISTIK UTAMA
    ========================================================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">


        {{-- TOTAL PENDAPATAN --}}
        <div class="bg-white rounded-2xl border border-slate-200
                    shadow-sm p-5
                    hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div class="min-w-0">

                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Total Pendapatan
                    </p>

                    <h2 class="text-xl md:text-2xl font-bold
                               text-slate-800 mt-2 truncate">

                        Rp {{ number_format(
                            $totalPendapatan,
                            0,
                            ',',
                            '.'
                        ) }}

                    </h2>

                    <p class="text-xs text-slate-400 mt-2">
                        Dari pesanan yang selesai
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl
                            bg-green-100
                            flex items-center justify-center
                            text-green-600">

                    <i class="fa-solid fa-wallet"></i>

                </div>

            </div>

        </div>


        {{-- TOTAL PESANAN --}}
        <div class="bg-white rounded-2xl border border-slate-200
                    shadow-sm p-5
                    hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Total Pesanan
                    </p>

                    <h2 class="text-2xl font-bold text-slate-800 mt-2">
                        {{ $totalPesanan }}
                    </h2>

                    <p class="text-xs text-slate-400 mt-2">
                        Seluruh pesanan toko
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl
                            bg-blue-100
                            flex items-center justify-center
                            text-blue-600">

                    <i class="fa-solid fa-receipt"></i>

                </div>

            </div>

        </div>


        {{-- PESANAN DIPROSES --}}
        <div class="bg-orange-50 rounded-2xl
                    border border-orange-100
                    shadow-sm p-5
                    hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <p class="text-xs font-semibold
                                  text-orange-700 uppercase tracking-wide">

                            Perlu Diproses

                        </p>

                        @if($pesananDiproses > 0)

                            <span class="w-2 h-2 rounded-full bg-orange-500"></span>

                        @endif

                    </div>

                    <h2 class="text-2xl font-bold text-orange-900 mt-2">
                        {{ $pesananDiproses }}
                    </h2>

                    <p class="text-xs text-orange-600 mt-2">
                        Pesanan yang perlu ditangani
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl
                            bg-orange-100
                            flex items-center justify-center
                            text-orange-600">

                    <i class="fa-solid fa-box-open"></i>

                </div>

            </div>

            @if($pesananDiproses > 0)

                <a href="{{ route('umkm.orders.index') }}"
                   class="inline-flex items-center gap-1
                          mt-4 text-xs font-semibold
                          text-orange-700 hover:text-orange-800">

                    Kelola sekarang

                    <i class="fa-solid fa-arrow-right text-[10px]"></i>

                </a>

            @endif

        </div>


        {{-- PRODUK AKTIF --}}
        <div class="bg-white rounded-2xl border border-slate-200
                    shadow-sm p-5
                    hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Produk Aktif
                    </p>

                    <h2 class="text-2xl font-bold text-slate-800 mt-2">
                        {{ $produkAktif }}
                    </h2>

                    <p class="text-xs text-slate-400 mt-2">
                        Dari {{ $totalProduk }} produk
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl
                            bg-purple-100
                            flex items-center justify-center
                            text-purple-600">

                    <i class="fa-solid fa-box"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


        {{-- =====================================================
            GRAFIK
        ====================================================== --}}
        <div class="xl:col-span-2
                    bg-white rounded-2xl
                    border border-slate-200
                    shadow-sm p-5">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between
                        gap-3 mb-6">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="w-8 h-8 rounded-lg
                                    bg-green-50
                                    text-green-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-chart-line text-sm"></i>

                        </div>

                        <h3 class="font-bold text-slate-800">
                            Penjualan
                        </h3>

                    </div>

                    <p class="text-xs text-slate-500 mt-2 ml-10">
                        Perkembangan pendapatan toko
                    </p>

                </div>


                <select id="umkmChartPeriod"
                        class="border border-slate-200
                               rounded-xl text-xs
                               px-3 py-2.5
                               bg-white
                               text-slate-600
                               font-medium
                               focus:ring-2
                               focus:ring-green-500
                               focus:border-green-500
                               outline-none">

                    <option value="3">
                        3 Bulan Terakhir
                    </option>

                    <option value="6" selected>
                        6 Bulan Terakhir
                    </option>

                    <option value="12">
                        12 Bulan Terakhir
                    </option>

                </select>

            </div>


            <div class="h-72">

                <canvas id="umkmSalesChart"></canvas>

            </div>

        </div>


        {{-- =====================================================
            RINGKASAN BULAN INI
        ====================================================== --}}
        <div class="bg-slate-900 rounded-2xl
                    shadow-sm p-5 text-white">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs text-slate-400 font-medium">
                        Ringkasan
                    </p>

                    <h3 class="font-bold text-lg mt-1">
                        Bulan Ini
                    </h3>

                </div>

                <div class="w-9 h-9 rounded-xl
                            bg-white/10
                            flex items-center justify-center">

                    <i class="fa-solid fa-chart-column text-sm"></i>

                </div>

            </div>


            {{-- PENDAPATAN --}}
            <div class="mt-6">

                <p class="text-xs text-slate-400">
                    Pendapatan
                </p>

                <p class="text-2xl font-bold mt-1">

                    Rp {{ number_format(
                        $pendapatanBulanIni,
                        0,
                        ',',
                        '.'
                    ) }}

                </p>

            </div>


            <div class="h-px bg-white/10 my-5"></div>


            {{-- STATISTIK KECIL --}}
            <div class="grid grid-cols-2 gap-4">

                <div>

                    <p class="text-xs text-slate-400">
                        Pesanan
                    </p>

                    <p class="text-xl font-bold mt-1">
                        {{ $totalPesananBulanIni }}
                    </p>

                </div>

                <div>

                    <p class="text-xs text-slate-400">
                        Produk Terjual
                    </p>

                    <p class="text-xl font-bold mt-1">
                        {{ $produkTerjualBulanIni }}
                    </p>

                </div>

            </div>


            <div class="mt-5 p-3 rounded-xl bg-white/5">

                <p class="text-xs text-slate-400">
                    Rata-rata nilai pesanan
                </p>

                <p class="text-sm font-semibold mt-1">
                    Rp {{ number_format(
                        $rataRataPesanan,
                        0,
                        ',',
                        '.'
                    ) }}
                </p>

            </div>


            <a href="{{ route('umkm.laporan.index') }}"
               class="mt-5 w-full
                      inline-flex items-center
                      justify-center gap-2
                      px-4 py-2.5
                      rounded-xl
                      bg-white text-slate-800
                      text-xs font-semibold
                      hover:bg-slate-100
                      transition">

                Lihat Laporan Lengkap

                <i class="fa-solid fa-arrow-right text-[10px]"></i>

            </a>

        </div>

    </div>


    {{-- =========================================================
        PESANAN TERBARU
    ========================================================== --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm">

        {{-- HEADER --}}
        <div class="p-5 border-b border-slate-100">

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between gap-3">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="w-8 h-8 rounded-lg
                                    bg-blue-50
                                    text-blue-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-receipt text-sm"></i>

                        </div>

                        <h3 class="font-bold text-slate-800">
                            Pesanan Terbaru
                        </h3>

                    </div>

                    <p class="text-xs text-slate-500 mt-2 ml-10">
                        Pesanan terbaru yang masuk ke toko
                    </p>

                </div>


                <a href="{{ route('umkm.orders.index') }}"
                   class="inline-flex items-center
                          justify-center gap-1
                          px-3 py-2 rounded-lg
                          bg-slate-50
                          text-xs font-semibold
                          text-slate-600
                          hover:bg-green-50
                          hover:text-green-600
                          transition">

                    Lihat Semua

                    <i class="fa-solid fa-arrow-right text-[10px]"></i>

                </a>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead>

                    <tr class="bg-slate-50
                               border-b border-slate-100
                               text-slate-500">

                        <th class="px-5 py-3 font-semibold text-xs">
                            Pesanan
                        </th>

                        <th class="px-5 py-3 font-semibold text-xs">
                            Produk
                        </th>

                        <th class="px-5 py-3 font-semibold text-xs">
                            Total
                        </th>

                        <th class="px-5 py-3 font-semibold text-xs">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($pesananTerbaru as $order)

                        @php

                            $produkPesanan = $order->items
                                ->filter(
                                    fn($item) =>
                                    $item->product &&
                                    $item->product->umkm_id == $umkm->id
                                );

                            $totalPesananUmkm =
                                $produkPesanan->sum('subtotal');

                            /*
                             * Ambil nama produk dari relasi product.
                             * Jika relasi tidak tersedia, gunakan
                             * product_name sebagai fallback.
                             */
                            $namaProduk = $produkPesanan
                                ->map(
                                    fn($item) =>
                                    $item->product?->name
                                    ?? $item->product_name
                                )
                                ->filter()
                                ->unique()
                                ->implode(', ');


                            $statusLabel = match($order->status) {

                                'pending' =>
                                    'Menunggu',

                                'processing',
                                'diproses' =>
                                    'Diproses',

                                'shipped',
                                'dikirim' =>
                                    'Dikirim',

                                'completed' =>
                                    'Selesai',

                                'cancelled',
                                'dibatalkan' =>
                                    'Dibatalkan',

                                default =>
                                    ucfirst($order->status),

                            };


                            $statusClass = match($order->status) {

                                'pending' =>
                                    'bg-orange-50 text-orange-700 border-orange-100',

                                'processing',
                                'diproses' =>
                                    'bg-blue-50 text-blue-700 border-blue-100',

                                'shipped',
                                'dikirim' =>
                                    'bg-indigo-50 text-indigo-700 border-indigo-100',

                                'completed' =>
                                    'bg-green-50 text-green-700 border-green-100',

                                'cancelled',
                                'dibatalkan' =>
                                    'bg-red-50 text-red-700 border-red-100',

                                default =>
                                    'bg-slate-50 text-slate-700 border-slate-100',

                            };

                        @endphp


                        <tr class="border-b border-slate-50
                                   hover:bg-slate-50 transition">


                            {{-- NOMOR PESANAN --}}
                            <td class="px-5 py-4">

                                <a href="{{ route('umkm.orders.show', $order) }}"
                                   class="font-semibold
                                          text-slate-700
                                          hover:text-green-600">

                                    #{{ $order->order_number }}

                                </a>

                                <p class="text-[11px] text-slate-400 mt-1">

                                    {{ optional($order->ordered_at ?? $order->created_at)->format('d M Y') }}

                                </p>

                            </td>


                            {{-- PRODUK --}}
                            <td class="px-5 py-4 max-w-[280px]">

                                <span class="block truncate
                                             text-slate-600"
                                      title="{{ $namaProduk }}">

                                    {{ $namaProduk ?: 'Produk' }}

                                </span>

                            </td>


                            {{-- TOTAL --}}
                            <td class="px-5 py-4 whitespace-nowrap">

                                <span class="font-semibold text-slate-700">

                                    Rp {{ number_format(
                                        $totalPesananUmkm,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

                                <span class="inline-flex items-center
                                             gap-1.5
                                             px-2.5 py-1
                                             rounded-full
                                             border
                                             text-[11px]
                                             font-semibold
                                             {{ $statusClass }}">

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-current">
                                    </span>

                                    {{ $statusLabel }}

                                </span>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-5 py-14 text-center">

                                <div class="flex flex-col
                                            items-center">

                                    <div class="w-14 h-14
                                                rounded-2xl
                                                bg-slate-100
                                                flex items-center
                                                justify-center
                                                text-slate-400 mb-4">

                                        <i class="fa-solid fa-receipt text-lg"></i>

                                    </div>

                                    <p class="text-sm
                                              font-semibold
                                              text-slate-700">

                                        Belum ada pesanan

                                    </p>

                                    <p class="text-xs
                                              text-slate-400
                                              mt-1">

                                        Pesanan pelanggan akan muncul di sini.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
        PRODUK TERLARIS
    ========================================================== --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm">

        <div class="p-5 border-b border-slate-100">

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between gap-3">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="w-8 h-8 rounded-lg
                                    bg-orange-50
                                    text-orange-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-fire text-sm"></i>

                        </div>

                        <h3 class="font-bold text-slate-800">
                            Produk Terlaris
                        </h3>

                    </div>

                    <p class="text-xs text-slate-500 mt-2 ml-10">
                        Produk dengan jumlah penjualan terbanyak
                    </p>

                </div>


                <a href="{{ route('umkm.products.index') }}"
                   class="inline-flex items-center
                          justify-center gap-1
                          px-3 py-2 rounded-lg
                          bg-slate-50
                          text-xs font-semibold
                          text-slate-600
                          hover:bg-green-50
                          hover:text-green-600
                          transition">

                    Semua Produk

                    <i class="fa-solid fa-arrow-right text-[10px]"></i>

                </a>

            </div>

        </div>


        <div class="p-4 md:p-5">

            @forelse($produkTerlaris as $index => $product)

                <div class="flex items-center gap-3
                            p-3 rounded-xl
                            hover:bg-slate-50
                            transition">

                    {{-- RANKING --}}
                    <div class="w-8 h-8 shrink-0
                                rounded-lg
                                bg-green-50
                                text-green-700
                                flex items-center
                                justify-center
                                text-xs font-bold">

                        {{ $index + 1 }}

                    </div>


                    {{-- ICON --}}
                    <div class="w-10 h-10 shrink-0
                                rounded-xl
                                bg-orange-50
                                flex items-center
                                justify-center
                                text-orange-600">

                        <i class="fa-solid fa-box"></i>

                    </div>


                    {{-- NAMA --}}
                    <div class="flex-1 min-w-0">

                        <p class="text-sm font-semibold
                                  text-slate-700 truncate">

                            {{ $product->name }}

                        </p>

                        <p class="text-xs text-slate-400 mt-1">

                            Produk terlaris

                        </p>

                    </div>


                    {{-- TERJUAL --}}
                    <div class="text-right">

                        <p class="text-sm font-bold text-slate-700">

                            {{ $product->total_terjual }}

                        </p>

                        <p class="text-[10px] text-slate-400">

                            Terjual

                        </p>

                    </div>

                </div>

            @empty

                <div class="py-12 text-center">

                    <div class="w-14 h-14
                                rounded-2xl
                                bg-slate-100
                                flex items-center
                                justify-center
                                text-slate-400
                                mx-auto mb-4">

                        <i class="fa-solid fa-box-open text-lg"></i>

                    </div>

                    <p class="text-sm font-semibold text-slate-700">

                        Belum ada produk terjual

                    </p>

                    <p class="text-xs text-slate-400 mt-1">

                        Produk terlaris akan muncul setelah ada transaksi.

                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- =========================================================
        PANDUAN SINGKAT
    ========================================================== --}}
    <div class="bg-green-50 border border-green-100
                rounded-2xl p-5">

        <div class="flex flex-col md:flex-row
                    md:items-center
                    md:justify-between gap-4">

            <div class="flex items-start gap-3">

                <div class="w-10 h-10 shrink-0
                            rounded-xl
                            bg-green-100
                            text-green-700
                            flex items-center
                            justify-center">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>

                <div>

                    <h3 class="text-sm font-bold text-green-900">
                        Kelola toko dengan mudah
                    </h3>

                    <p class="text-xs text-green-700 mt-1">
                        Tambahkan produk, cek pesanan, dan pantau
                        hasil penjualan toko kamu melalui menu di sebelah kiri.
                    </p>

                </div>

            </div>


            <div class="flex flex-wrap gap-2">

                <a href="{{ route('umkm.products.index') }}"
                   class="inline-flex items-center gap-2
                          px-3 py-2 rounded-lg
                          bg-white border border-green-200
                          text-xs font-semibold
                          text-green-700
                          hover:bg-green-100
                          transition">

                    <i class="fa-solid fa-box"></i>

                    Kelola Produk

                </a>

                <a href="{{ route('umkm.orders.index') }}"
                   class="inline-flex items-center gap-2
                          px-3 py-2 rounded-lg
                          bg-green-600
                          text-white
                          text-xs font-semibold
                          hover:bg-green-700
                          transition">

                    <i class="fa-solid fa-receipt"></i>

                    Cek Pesanan

                </a>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    CHART SCRIPT
============================================================= --}}
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const revenueData = @json($grafikPenjualan ?? []);

    const canvas = document.getElementById('umkmSalesChart');

    const periodSelect =
        document.getElementById('umkmChartPeriod');


    /*
    |--------------------------------------------------------------------------
    | Pastikan Chart.js tersedia
    |--------------------------------------------------------------------------
    */

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Format Rupiah
    |--------------------------------------------------------------------------
    */

    function formatRupiah(value) {

        return 'Rp ' +
            new Intl.NumberFormat('id-ID').format(value);

    }


    /*
    |--------------------------------------------------------------------------
    | Ambil data sesuai periode
    |--------------------------------------------------------------------------
    */

    function getChartData(months) {

        return revenueData.slice(-months);

    }


    /*
    |--------------------------------------------------------------------------
    | Data awal
    |--------------------------------------------------------------------------
    */

    const initialMonths =
        periodSelect
            ? parseInt(periodSelect.value)
            : 6;

    const initialData =
        getChartData(initialMonths);


    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    */

    const chart = new Chart(canvas, {

        type: 'line',

        data: {

            labels: initialData.map(
                item => item.label
            ),

            datasets: [{

                label: 'Pendapatan',

                data: initialData.map(
                    item => item.value
                ),

                borderColor: '#16a34a',

                backgroundColor:
                    'rgba(22, 163, 74, 0.08)',

                fill: true,

                tension: 0.4,

                borderWidth: 2,

                pointRadius: 3,

                pointHoverRadius: 5

            }]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {

                intersect: false,

                mode: 'index'

            },


            plugins: {

                legend: {

                    display: false

                },


                tooltip: {

                    backgroundColor: '#0f172a',

                    padding: 12,

                    displayColors: false,

                    callbacks: {

                        label: function (context) {

                            return formatRupiah(
                                context.raw
                            );

                        }

                    }

                }

            },


            scales: {

                y: {

                    beginAtZero: true,

                    border: {

                        display: false

                    },

                    grid: {

                        color:
                            'rgba(148, 163, 184, 0.12)'

                    },

                    ticks: {

                        color: '#94a3b8',

                        font: {

                            size: 10

                        },

                        callback: function (value) {

                            return formatRupiah(value);

                        }

                    }

                },


                x: {

                    border: {

                        display: false

                    },

                    grid: {

                        display: false

                    },

                    ticks: {

                        color: '#94a3b8',

                        font: {

                            size: 10

                        }

                    }

                }

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Ganti periode grafik
    |--------------------------------------------------------------------------
    */

    if (periodSelect) {

        periodSelect.addEventListener(
            'change',
            function () {

                const months =
                    parseInt(this.value);

                const selected =
                    getChartData(months);


                chart.data.labels =
                    selected.map(
                        item => item.label
                    );


                chart.data.datasets[0].data =
                    selected.map(
                        item => item.value
                    );


                chart.update();

            }
        );

    }

});

</script>

@endpush

@endsection