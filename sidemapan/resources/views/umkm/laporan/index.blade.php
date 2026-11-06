@extends('layouts.umkm')

@section('content')

<style>
    .sales-report-page {
        background: #f8fafc;
        min-height: calc(100vh - 80px);
        margin: -24px;
        padding: 28px;
    }

    /* =========================
       HEADER
    ========================= */
    .page-header {
        background: linear-gradient(
            135deg,
            #ecfdf5 0%,
            #ffffff 55%,
            #f0fdf4 100%
        );
        border: 1px solid #d1fae5;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .05);
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #d1fae5;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .page-title {
        color: #0f172a;
        font-size: 25px;
        font-weight: 800;
        margin: 0;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 13px;
        margin: 5px 0 0;
    }

    /* =========================
       GENERAL CARD
    ========================= */
    .report-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .06);
        overflow: hidden;
    }

    .report-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .card-title-custom {
        color: #1e293b;
        font-size: 15px;
        font-weight: 800;
        margin: 0;
    }

    .card-subtitle-custom {
        color: #94a3b8;
        font-size: 11px;
        margin: 4px 0 0;
    }

    .report-card-body {
        padding: 22px;
    }

    /* =========================
       FILTER
    ========================= */
    .filter-card {
        margin-bottom: 24px;
    }

    .filter-label {
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .filter-input {
        min-height: 44px;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        color: #334155;
        font-size: 12px;
        box-shadow: none;
        transition: all .2s ease;
    }

    .filter-input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, .10);
    }

    .filter-actions {
        display: flex;
        gap: 8px;
    }

    .btn-filter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 44px;
        border: none;
        border-radius: 10px;
        background: #059669;
        color: #ffffff;
        padding: 9px 16px;
        font-size: 12px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-filter:hover {
        background: #047857;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 44px;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        background: #ffffff;
        color: #64748b;
        padding: 9px 16px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
    }

    .btn-reset:hover {
        background: #f8fafc;
        color: #334155;
        border-color: #cbd5e1;
    }

    /* =========================
       STATISTICS
    ========================= */
    .stat-card {
        position: relative;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 7px 25px rgba(15, 23, 42, .05);
        transition: all .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #10b981;
    }

    .stat-body {
        padding: 20px;
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .stat-label {
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin: 0;
    }

    .stat-icon {
        width: 39px;
        height: 39px;
        border-radius: 11px;
        background: #ecfdf5;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .stat-value {
        color: #0f172a;
        font-size: 24px;
        font-weight: 800;
        margin: 13px 0 0;
    }

    .stat-value.revenue {
        color: #047857;
    }

    .stat-description {
        color: #94a3b8;
        font-size: 10px;
        margin: 5px 0 0;
    }

    /* =========================
       TABLE
    ========================= */
    .report-table {
        margin: 0;
    }

    .report-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .report-table tbody td {
        padding: 15px 16px;
        color: #475569;
        font-size: 12px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .report-table tbody tr {
        transition: all .2s ease;
    }

    .report-table tbody tr:hover {
        background: #f0fdf4;
    }

    .number-badge {
        width: 29px;
        height: 29px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 10px;
        font-weight: 700;
    }

    .order-number {
        color: #334155;
        font-weight: 700;
    }

    .buyer-name {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #475569;
        font-weight: 600;
    }

    .buyer-icon {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: #ecfdf5;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
    }

    .product-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        border-radius: 8px;
        padding: 6px 9px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .product-count i {
        color: #059669;
    }

    .revenue-value {
        color: #047857;
        font-weight: 800;
        white-space: nowrap;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 6px 9px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .date-badge i {
        color: #94a3b8;
    }

    /* =========================
       EMPTY STATE
    ========================= */
    .empty-state {
        padding: 50px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        border-radius: 17px;
        background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
        border: 1px solid #d1fae5;
        color: #34d399;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        margin-bottom: 13px;
    }

    .empty-title {
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .empty-description {
        color: #94a3b8;
        font-size: 11px;
        margin: 0;
    }

    /* =========================
       PAGINATION
    ========================= */
    .pagination-wrapper {
        padding: 18px 22px;
        border-top: 1px solid #e2e8f0;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 768px) {

        .sales-report-page {
            margin: -16px;
            padding: 18px;
        }

        .page-header {
            padding: 18px;
        }

        .page-title {
            font-size: 21px;
        }

        .report-card-body {
            padding: 18px;
        }

        .filter-actions {
            width: 100%;
        }

        .btn-filter,
        .btn-reset {
            flex: 1;
        }

        .stat-value {
            font-size: 21px;
        }
    }
</style>


<div class="sales-report-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="header-content">

            <div class="header-icon">
                <i class="fa-solid fa-chart-line"></i>
            </div>

            <div>
                <h2 class="page-title">
                    Laporan Penjualan
                </h2>

                <p class="page-subtitle">
                    Pantau transaksi dan penjualan produk UMKM kamu.
                </p>
            </div>

        </div>

    </div>


    {{-- Filter Tanggal --}}
    <div class="report-card filter-card">

        <div class="report-card-header">

            <p class="card-title-custom">
                <i class="fa-solid fa-filter text-success me-1"></i>
                Filter Laporan
            </p>

            <p class="card-subtitle-custom">
                Pilih periode untuk melihat data penjualan.
            </p>

        </div>

        <div class="report-card-body">

            <form method="GET" action="{{ route('umkm.laporan.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-4">

                        <label class="filter-label">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="tanggal_mulai"
                            class="form-control filter-input"
                            value="{{ $tanggalMulai }}"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="filter-label">
                            Tanggal Akhir
                        </label>

                        <input
                            type="date"
                            name="tanggal_akhir"
                            class="form-control filter-input"
                            value="{{ $tanggalAkhir }}"
                        >

                    </div>


                    <div class="col-md-4">

                        <div class="filter-actions">

                            <button
                                type="submit"
                                class="btn-filter"
                            >

                                <i class="fa-solid fa-filter"></i>

                                Filter

                            </button>


                            <a
                                href="{{ route('umkm.laporan.index') }}"
                                class="btn-reset"
                            >

                                <i class="fa-solid fa-rotate-left"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Statistik --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL PENDAPATAN --}}
        <div class="col-md-4">

            <div class="stat-card h-100">

                <div class="stat-body">

                    <div class="stat-top">

                        <p class="stat-label">
                            Total Pendapatan
                        </p>

                        <div class="stat-icon">
                            <i class="fa-solid fa-wallet"></i>
                        </div>

                    </div>

                    <h3 class="stat-value revenue">

                        Rp{{ number_format($totalPendapatan, 0, ',', '.') }}

                    </h3>

                    <p class="stat-description">
                        Pendapatan berdasarkan periode yang dipilih
                    </p>

                </div>

            </div>

        </div>


        {{-- PRODUK TERJUAL --}}
        <div class="col-md-4">

            <div class="stat-card h-100">

                <div class="stat-body">

                    <div class="stat-top">

                        <p class="stat-label">
                            Produk Terjual
                        </p>

                        <div class="stat-icon">
                            <i class="fa-solid fa-box-open"></i>
                        </div>

                    </div>

                    <h3 class="stat-value">

                        {{ number_format($totalProdukTerjual) }}

                    </h3>

                    <p class="stat-description">
                        Total produk yang berhasil terjual
                    </p>

                </div>

            </div>

        </div>


        {{-- TRANSAKSI SELESAI --}}
        <div class="col-md-4">

            <div class="stat-card h-100">

                <div class="stat-body">

                    <div class="stat-top">

                        <p class="stat-label">
                            Transaksi Selesai
                        </p>

                        <div class="stat-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                    </div>

                    <h3 class="stat-value">

                        {{ number_format($totalTransaksi) }}

                    </h3>

                    <p class="stat-description">
                        Jumlah transaksi yang telah selesai
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Produk Terlaris --}}
    <div class="report-card mb-4">

        <div class="report-card-header">

            <p class="card-title-custom">

                <i class="fa-solid fa-ranking-star text-success me-1"></i>

                Produk Terlaris

            </p>

            <p class="card-subtitle-custom">
                Produk dengan jumlah penjualan terbanyak.
            </p>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover report-table">

                    <thead>

                        <tr>

                            <th>No.</th>

                            <th>Nama Produk</th>

                            <th>Jumlah Terjual</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($produkTerlaris as $produk)

                            <tr>

                                <td>

                                    <span class="number-badge">
                                        {{ $loop->iteration }}
                                    </span>

                                </td>


                                <td>

                                    <strong class="order-number">
                                        {{ $produk->product_name }}
                                    </strong>

                                </td>


                                <td>

                                    <span class="product-count">

                                        <i class="fa-solid fa-box"></i>

                                        {{ $produk->total_terjual }}

                                        terjual

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">

                                        <i class="fa-solid fa-chart-column"></i>

                                    </div>

                                    <div class="empty-title">
                                        Belum ada penjualan
                                    </div>

                                    <p class="empty-description">
                                        Data produk terlaris akan muncul setelah ada transaksi.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Riwayat Transaksi --}}
    <div class="report-card">

        <div class="report-card-header">

            <p class="card-title-custom">

                <i class="fa-solid fa-clock-rotate-left text-success me-1"></i>

                Riwayat Transaksi

            </p>

            <p class="card-subtitle-custom">
                Daftar transaksi yang berkaitan dengan produk toko kamu.
            </p>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle report-table">

                    <thead>

                        <tr>

                            <th>No.</th>

                            <th>Nomor Pesanan</th>

                            <th>Pembeli</th>

                            <th>Produk Toko</th>

                            <th>Pendapatan</th>

                            <th>Tanggal</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($orders as $order)

                            @php

                                $itemsToko = $order->items->filter(
                                    fn($item) => $item->product?->umkm_id === auth()->user()->umkm?->id
                                );

                                $pendapatanToko = $itemsToko->sum('subtotal');

                            @endphp


                            <tr>

                                <td>

                                    <span class="number-badge">

                                        {{ $orders->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                <td>

                                    <span class="order-number">

                                        {{ $order->order_number }}

                                    </span>

                                </td>


                                <td>

                                    <span class="buyer-name">

                                        <span class="buyer-icon">

                                            <i class="fa-solid fa-user"></i>

                                        </span>

                                        {{ $order->user->name ?? '-' }}

                                    </span>

                                </td>


                                <td>

                                    <span class="product-count">

                                        <i class="fa-solid fa-box"></i>

                                        {{ $itemsToko->sum('quantity') }}

                                        barang

                                    </span>

                                </td>


                                <td>

                                    <span class="revenue-value">

                                        Rp{{ number_format($pendapatanToko, 0, ',', '.') }}

                                    </span>

                                </td>


                                <td>

                                    <span class="date-badge">

                                        <i class="fa-regular fa-calendar"></i>

                                        {{ $order->created_at->format('d-m-Y') }}

                                    </span>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">

                                        <i class="fa-solid fa-receipt"></i>

                                    </div>

                                    <div class="empty-title">
                                        Belum ada transaksi
                                    </div>

                                    <p class="empty-description">
                                        Riwayat transaksi toko kamu akan muncul di sini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}

            <div class="pagination-wrapper">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

</div>

@endsection