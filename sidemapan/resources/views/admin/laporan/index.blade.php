@extends('layouts.admin') 
 
@section('content') 

<style>
    .laporan-page {
        padding-bottom: 30px;
    }

    .laporan-header {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 75%);
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 24px 26px;
        margin-bottom: 22px;
    }

    .laporan-header h2 {
        color: #111827;
        font-size: 25px;
        margin-bottom: 6px;
    }

    .laporan-header p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 14px;
    }

    .header-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: #dbeafe;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .filter-card {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        background: #ffffff;
        overflow: hidden;
    }

    .filter-card .card-body {
        padding: 20px;
    }

    .filter-label {
        color: #475569;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .filter-card .form-control {
        border: 1px solid #dbe1ea;
        border-radius: 9px;
        min-height: 42px;
        font-size: 14px;
        box-shadow: none;
    }

    .filter-card .form-control:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .btn-filter {
        background: #2563eb;
        border-color: #2563eb;
        border-radius: 9px;
        min-height: 42px;
        padding: 0 18px;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-filter:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
    }

    .btn-reset {
        border-radius: 9px;
        min-height: 42px;
        padding: 0 18px;
        font-size: 14px;
        font-weight: 600;
    }

    .stat-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
        transition: .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(15, 23, 42, .07) !important;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .stat-icon.green {
        background: #dcfce7;
        color: #16a34a;
    }

    .stat-icon.blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .stat-icon.purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .stat-value {
        color: #0f172a;
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 0;
    }

    .stat-value.green-text {
        color: #16a34a;
    }

    .section-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
        background: #fff;
    }

    .section-card .card-body {
        padding: 22px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .section-title-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .section-title h5 {
        margin: 0;
        color: #1e293b;
        font-size: 16px;
        font-weight: 700;
    }

    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead {
        background: #f8fafc;
    }

    .custom-table thead th {
        border-bottom: 1px solid #e5e7eb;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 13px 14px;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 14px;
        border-color: #f1f5f9;
        color: #475569;
        font-size: 14px;
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: .15s ease;
    }

    .custom-table tbody tr:hover {
        background: #f8fbff;
    }

    .table-number {
        color: #94a3b8 !important;
        font-weight: 600;
    }

    .order-number {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #2563eb;
        font-weight: 600;
    }

    .buyer-name {
        color: #334155;
        font-weight: 500;
    }

    .price-text {
        color: #059669;
        font-weight: 700;
    }

    .date-text {
        color: #64748b;
        font-size: 13px;
    }

    .empty-state {
        padding: 40px 20px !important;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 18px;
    }

    .pagination-wrapper {
        margin-top: 18px;
    }

    @media (max-width: 768px) {
        .laporan-header {
            padding: 20px;
        }

        .laporan-header h2 {
            font-size: 22px;
        }

        .filter-card .btn {
            width: 100%;
            margin-bottom: 7px;
        }

        .section-card .card-body {
            padding: 16px;
        }
    }
</style>

<div class="container-fluid laporan-page"> 
 
    {{-- HEADER --}}
    <div class="laporan-header"> 

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon">
                <i class="fas fa-chart-line"></i>
            </div>

            <div>
                <h2 class="fw-bold">Laporan Penjualan</h2> 

                <p> 
                    Ringkasan transaksi dan penjualan seluruh UMKM. 
                </p>
            </div>

        </div>

    </div> 
 
    {{-- Filter Tanggal --}} 
    <div class="card filter-card mb-4"> 

        <div class="card-body"> 

            <form method="GET" action="{{ route('admin.laporan.index') }}"> 

                <div class="row g-3 align-items-end"> 

                    <div class="col-md-4"> 

                        <label class="form-label filter-label">
                            <i class="fas fa-calendar-alt me-1 text-primary"></i>
                            Tanggal Mulai
                        </label> 

                        <input 
                            type="date" 
                            name="tanggal_mulai" 
                            class="form-control" 
                            value="{{ $tanggalMulai }}" 
                        > 

                    </div> 
 
                    <div class="col-md-4"> 

                        <label class="form-label filter-label">
                            <i class="fas fa-calendar-alt me-1 text-primary"></i>
                            Tanggal Akhir
                        </label> 

                        <input 
                            type="date" 
                            name="tanggal_akhir" 
                            class="form-control" 
                            value="{{ $tanggalAkhir }}" 
                        > 

                    </div> 
 
                    <div class="col-md-4"> 

                        <button class="btn btn-primary btn-filter me-1">
                            <i class="fas fa-filter me-1"></i>
                            Filter
                        </button> 
 
                        <a href="{{ route('admin.laporan.index') }}" 
                           class="btn btn-secondary btn-reset"> 
                            <i class="fas fa-rotate-left me-1"></i>
                            Reset
                        </a> 

                    </div> 

                </div> 

            </form> 

        </div> 

    </div> 
 
    {{-- Statistik --}} 
    <div class="row g-3 mb-4"> 

        <div class="col-md-4"> 

            <div class="card stat-card shadow-sm h-100"> 

                <div class="card-body p-4"> 

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon green">
                            <i class="fas fa-wallet"></i>
                        </div>

                        <div>

                            <p class="stat-label">
                                Total Pendapatan
                            </p> 

                            <h3 class="stat-value green-text"> 
                                Rp{{ number_format($totalPendapatan, 0, ',', '.') }} 
                            </h3>

                        </div>

                    </div>

                </div> 

            </div> 

        </div> 
 
        <div class="col-md-4"> 

            <div class="card stat-card shadow-sm h-100"> 

                <div class="card-body p-4"> 

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon blue">
                            <i class="fas fa-box"></i>
                        </div>

                        <div>

                            <p class="stat-label">
                                Produk Terjual
                            </p> 

                            <h3 class="stat-value"> 
                                {{ number_format($totalProdukTerjual) }} 
                            </h3>

                        </div>

                    </div>

                </div> 

            </div> 

        </div> 
 
        <div class="col-md-4"> 

            <div class="card stat-card shadow-sm h-100"> 

                <div class="card-body p-4"> 

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon purple">
                            <i class="fas fa-receipt"></i>
                        </div>

                        <div>

                            <p class="stat-label">
                                Transaksi Selesai
                            </p> 

                            <h3 class="stat-value"> 
                                {{ number_format($totalTransaksi) }} 
                            </h3>

                        </div>

                    </div>

                </div> 

            </div> 

        </div> 

    </div> 
 
    {{-- Produk Terlaris --}} 
    <div class="card section-card shadow-sm mb-4"> 

        <div class="card-body"> 

            <div class="section-title">

                <div class="section-title-icon">
                    <i class="fas fa-fire"></i>
                </div>

                <h5>Produk Terlaris</h5>

            </div>
 
            <div class="table-responsive"> 

                <table class="table table-hover custom-table"> 

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

                                <td class="table-number">
                                    {{ $loop->iteration }}
                                </td> 

                                <td class="fw-semibold text-slate-700">
                                    {{ $produk->product_name }}
                                </td> 

                                <td>

                                    <span class="badge rounded-pill bg-blue-50 text-primary px-3 py-2">
                                        {{ $produk->total_terjual }} terjual
                                    </span>

                                </td> 

                            </tr> 

                        @empty 

                            <tr> 

                                <td colspan="3"
                                    class="text-center empty-state"> 

                                    <div class="empty-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>

                                    <div class="fw-semibold text-secondary">
                                        Belum ada penjualan.
                                    </div>

                                </td> 

                            </tr> 

                        @endforelse 

                    </tbody> 

                </table> 

            </div> 

        </div> 

    </div> 
 
    {{-- Semua Transaksi --}} 
    <div class="card section-card shadow-sm"> 

        <div class="card-body"> 

            <div class="section-title">

                <div class="section-title-icon">
                    <i class="fas fa-receipt"></i>
                </div>

                <h5>Riwayat Transaksi</h5>

            </div>
 
            <div class="table-responsive"> 

                <table class="table table-hover align-middle custom-table"> 

                    <thead> 

                        <tr> 
                            <th>No.</th> 
                            <th>Nomor Pesanan</th> 
                            <th>Pembeli</th> 
                            <th>Total</th> 
                            <th>Tanggal</th> 
                        </tr> 

                    </thead> 
 
                    <tbody> 

                        @forelse($orders as $order) 

                            <tr> 

                                <td class="table-number">
                                    {{ $orders->firstItem() + $loop->index }}
                                </td> 

                                <td>

                                    <span class="order-number">
                                        <i class="fas fa-hashtag text-xs"></i>
                                        {{ $order->order_number }}
                                    </span>

                                </td> 

                                <td>

                                    <span class="buyer-name">
                                        <i class="fas fa-user text-muted me-1"></i>
                                        {{ $order->user->name ?? '-' }}
                                    </span>

                                </td> 

                                <td> 

                                    <span class="price-text">
                                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>

                                </td> 

                                <td>

                                    <span class="date-text">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $order->created_at->format('d-m-Y') }}
                                    </span>

                                </td> 

                            </tr> 

                        @empty 

                            <tr> 

                                <td colspan="5"
                                    class="text-center empty-state"> 

                                    <div class="empty-icon">
                                        <i class="fas fa-receipt"></i>
                                    </div>

                                    <div class="fw-semibold text-secondary">
                                        Belum ada transaksi.
                                    </div>

                                </td> 

                            </tr> 

                        @endforelse 

                    </tbody> 

                </table> 

            </div> 
 
            <div class="pagination-wrapper">
                {{ $orders->links() }}
            </div>

        </div> 

    </div> 

</div> 

@endsection