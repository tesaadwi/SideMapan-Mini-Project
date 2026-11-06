
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<div class="max-w-[1600px] mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-green-950">
                Dashboard
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Ringkasan dan statistik SideMapan
            </p>
        </div>

        <div class="text-sm text-slate-600 bg-white border border-green-100 rounded-xl px-4 py-2.5 shadow-sm">
            <i class="fa-regular fa-calendar mr-2 text-green-700"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        {{-- TOTAL UMKM --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-green-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total UMKM</p>
                    <h2 class="text-3xl font-bold text-green-950 mt-2">
                        {{ number_format($totalUmkm, 0, ',', '.') }}
                    </h2>
                    <p class="text-xs text-slate-400 mt-2">
                        Seluruh UMKM terdaftar
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-800 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-store"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL PRODUK --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-green-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total Produk</p>
                    <h2 class="text-3xl font-bold text-green-950 mt-2">
                        {{ number_format($totalProduk, 0, ',', '.') }}
                    </h2>
                    <p class="text-xs text-slate-400 mt-2">
                        {{ number_format($produkAktif, 0, ',', '.') }} produk aktif
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-lime-100 text-green-800 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL PESANAN --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-green-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total Pesanan</p>
                    <h2 class="text-3xl font-bold text-green-950 mt-2">
                        {{ number_format($totalPesanan, 0, ',', '.') }}
                    </h2>
                    <p class="text-xs text-slate-400 mt-2">
                        {{ number_format($pesananBulanIni, 0, ',', '.') }} pesanan bulan ini
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
        </div>

        {{-- PENDAPATAN --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-green-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Pendapatan Bulan Ini</p>
                    <h2 class="text-2xl md:text-3xl font-bold text-green-950 mt-2">
                        Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                    </h2>

                    <p class="text-xs mt-2 {{ $persentasePendapatan >= 0 ? 'text-green-700' : 'text-red-600' }}">
                        <i class="fa-solid {{ $persentasePendapatan >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} mr-1"></i>

                        {{ number_format(abs($persentasePendapatan), 1, ',', '.') }}%
                        dari bulan lalu
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-900 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- GRAFIK DAN UMKM --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">

        {{-- KATEGORI PRODUK --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm xl:col-span-4">
            <div class="mb-5">
                <h3 class="font-bold text-base text-green-950">
                    Ringkasan Produk per Kategori
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Distribusi produk berdasarkan kategori
                </p>
            </div>

            <div class="flex flex-col sm:flex-row xl:flex-col 2xl:flex-row items-center gap-5">
                <div class="w-full sm:w-1/2 xl:w-full 2xl:w-1/2 h-56">
                    <canvas id="categoryChart"></canvas>
                </div>

                <div class="w-full sm:w-1/2 xl:w-full 2xl:w-1/2 space-y-3 text-sm">
                    @forelse($kategori as $item)
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-slate-600 truncate">
                                {{ $item->name }}
                            </span>

                            <span class="font-semibold text-green-950">
                                {{ number_format($item->products_count, 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 text-center py-4">
                            Belum ada kategori produk.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- GRAFIK PENDAPATAN --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm xl:col-span-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <div>
                    <h3 class="font-bold text-base text-green-950">
                        Pertumbuhan Pendapatan
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Grafik pendapatan berdasarkan periode
                    </p>
                </div>

                <select id="adminChartPeriod"
                    class="border border-green-200 rounded-lg text-sm px-3 py-2 bg-white text-green-950 focus:outline-none focus:ring-2 focus:ring-green-600">
                    <option value="6">6 Bulan Terakhir</option>
                    <option value="3">3 Bulan Terakhir</option>
                    <option value="12">12 Bulan Terakhir</option>
                </select>
            </div>

            <div class="h-64">
                <canvas id="adminRevenueChart"></canvas>
            </div>
        </div>

        {{-- TOP UMKM --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm xl:col-span-3">
            <div class="mb-5">
                <h3 class="font-bold text-base text-green-950">
                    UMKM dengan Penjualan Tertinggi
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Berdasarkan penjualan bulan ini
                </p>
            </div>

            <div class="space-y-4">
                @forelse($topUmkm as $index => $umkm)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center font-bold text-sm
                            {{ $index === 0 ? 'bg-green-200 text-green-900' : 'bg-green-50 text-green-800' }}">
                            {{ $index + 1 }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-700 truncate">
                                {{ $umkm['name'] }}
                            </p>

                            <p class="text-xs text-green-800 font-medium mt-1">
                                Rp {{ number_format($umkm['revenue'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-12 h-12 mx-auto rounded-full bg-green-50 text-green-700 flex items-center justify-center mb-3">
                            <i class="fa-solid fa-store text-lg"></i>
                        </div>
                        <p class="text-sm text-slate-500">
                            Belum ada penjualan bulan ini.
                        </p>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('admin.laporan.index') }}"
                class="block text-center text-sm font-semibold text-green-800 mt-6 pt-4 border-t border-green-100 hover:text-green-950 transition">
                Lihat Laporan
                <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

    </div>

    {{-- VERIFIKASI DAN LAPORAN --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

        {{-- VERIFIKASI --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm">
            <div class="mb-5">
                <h3 class="font-bold text-base text-green-950">
                    Verifikasi Menunggu
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Ringkasan data yang perlu diperhatikan
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- UMKM PENDING --}}
                <div class="border border-green-200 bg-green-50 rounded-2xl p-5">
                    <div class="w-11 h-11 bg-green-100 text-green-800 rounded-xl flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-store"></i>
                    </div>

                    <p class="text-sm text-slate-600">
                        UMKM Menunggu Verifikasi
                    </p>

                    <h2 class="text-3xl font-bold text-green-950 mt-2">
                        {{ number_format($umkmPending, 0, ',', '.') }}
                    </h2>

                    <a href="{{ route('admin.verifikasi.index') }}"
                        class="inline-flex items-center gap-2 mt-5 px-4 py-2 bg-white border border-green-200 text-green-800 text-xs font-semibold rounded-lg hover:bg-green-100 transition">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- PRODUK AKTIF --}}
                <div class="border border-emerald-200 bg-emerald-50 rounded-2xl p-5">
                    <div class="w-11 h-11 bg-emerald-100 text-emerald-800 rounded-xl flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-box"></i>
                    </div>

                    <p class="text-sm text-slate-600">
                        Total Produk Aktif
                    </p>

                    <h2 class="text-3xl font-bold text-green-950 mt-2">
                        {{ number_format($produkAktif, 0, ',', '.') }}
                    </h2>

                    <a href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center gap-2 mt-5 px-4 py-2 bg-white border border-emerald-200 text-green-800 text-xs font-semibold rounded-lg hover:bg-emerald-100 transition">
                        Lihat Produk
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>

        {{-- LAPORAN PENJUALAN --}}
        <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-5">
                <div>
                    <h3 class="font-bold text-base text-green-950">
                        Laporan Penjualan
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Ringkasan pendapatan DesaHub
                    </p>
                </div>

                <span class="text-xs font-medium text-green-900 bg-green-100 px-3 py-1.5 rounded-full">
                    Bulan ini
                </span>
            </div>

            <div class="bg-green-50 border border-green-100 rounded-xl p-4">
                <p class="text-sm text-slate-500">
                    Total Pendapatan
                </p>

                <h2 class="text-2xl md:text-3xl font-bold text-green-950 mt-2">
                    Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                </h2>

                <p class="text-xs mt-2 {{ $persentasePendapatan >= 0 ? 'text-green-800' : 'text-red-600' }}">
                    <i class="fa-solid {{ $persentasePendapatan >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} mr-1"></i>

                    {{ number_format(abs($persentasePendapatan), 1, ',', '.') }}%
                    dari bulan lalu
                </p>
            </div>

            <div class="grid grid-cols-3 gap-3 border-t border-green-100 mt-5 pt-5">

                <div class="min-w-0">
                    <p class="text-xs text-slate-500">
                        Total Pesanan
                    </p>
                    <p class="font-bold text-xl text-green-950 mt-2">
                        {{ number_format($pesananBulanIni, 0, ',', '.') }}
                    </p>
                </div>

                <div class="min-w-0">
                    <p class="text-xs text-slate-500">
                        Rata-rata Pesanan
                    </p>
                    <p class="font-bold text-sm md:text-base text-green-950 mt-2 break-words">
                        Rp {{ number_format($rataRataPesanan, 0, ',', '.') }}
                    </p>
                </div>

                <div class="min-w-0">
                    <p class="text-xs text-slate-500">
                        Produk Terjual
                    </p>
                    <p class="font-bold text-xl text-green-950 mt-2">
                        {{ number_format($produkTerjual, 0, ',', '.') }}
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.laporan.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-green-800 mt-6 hover:text-green-950 transition">
                Lihat Laporan Lengkap
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>

</div>

@endsection

{{-- CHART --}}
@push('scripts')

<script>
    /* GRAFIK KATEGORI PRODUK */
    const categoryLabels = @json($categoryLabels);
    const categoryValues = @json($categoryValues);

    const categoryColors = [
        '#105C3B',
        '#198754',
        '#52A878',
        '#A8D5B5',
        '#D8EDE0',
        '#7DBB91',
        '#347A50',
        '#B7DCC2'
    ];

    const categoryCanvas = document.getElementById('categoryChart');

    if (categoryCanvas) {
        new Chart(categoryCanvas, {
            type: 'doughnut',

            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryValues,
                    backgroundColor: categoryColors,
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' +
                                    new Intl.NumberFormat('id-ID').format(context.raw) +
                                    ' produk';
                            }
                        }
                    }
                },

                cutout: '65%'
            }
        });
    }

    /* GRAFIK PENDAPATAN */
    const allRevenueLabels = @json($revenueLabels);
    const allRevenueValues = @json($revenueValues);

    const revenueCanvas = document.getElementById('adminRevenueChart');

    if (revenueCanvas) {
        const revenueChart = new Chart(revenueCanvas, {
            type: 'line',

            data: {
                labels: allRevenueLabels.slice(-6),

                datasets: [{
                    label: 'Pendapatan',
                    data: allRevenueValues.slice(-6),

                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.12)',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#105C3B',
                    borderWidth: 2
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
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' +
                                    new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            color: '#64748b',
                            maxRotation: 0
                        }
                    },

                    y: {
                        beginAtZero: true,

                        grid: {
                            color: '#e5f1e8'
                        },

                        ticks: {
                            color: '#64748b',

                            callback: function(value) {
                                return new Intl.NumberFormat('id-ID', {
                                    notation: 'compact',
                                    maximumFractionDigits: 1
                                }).format(value);
                            }
                        }
                    }
                }
            }
        });

        /* FILTER PERIODE */
        const periodSelect = document.getElementById('adminChartPeriod');

        if (periodSelect) {
            periodSelect.addEventListener('change', function() {
                const period = Number(this.value);

                revenueChart.data.labels = allRevenueLabels.slice(-period);
                revenueChart.data.datasets[0].data = allRevenueValues.slice(-period);

                revenueChart.update();
            });
        }
    }
</script>

@endpush
