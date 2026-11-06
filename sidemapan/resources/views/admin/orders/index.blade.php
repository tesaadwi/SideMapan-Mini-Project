@extends('layouts.admin')

@section('content')

<style>
    .orders-page {
        padding-bottom: 30px;
    }

    /* HEADER */
    .page-header {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 75%);
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 24px 26px;
        margin-bottom: 22px;
    }

    .header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #dbeafe;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .page-header h2 {
        color: #111827;
        font-size: 24px;
        margin-bottom: 5px;
    }

    .page-header p {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
    }

    /* FILTER CARD */
    .filter-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 15px !important;
        margin-bottom: 20px;
    }

    .filter-card .card-body {
        padding: 20px;
    }

    .filter-label {
        display: block;
        color: #475569;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .filter-control {
        min-height: 43px;
        border: 1px solid #dbe1ea;
        border-radius: 9px;
        font-size: 14px;
        color: #334155;
        box-shadow: none !important;
        transition: .2s ease;
    }

    .filter-control:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10) !important;
    }

    .filter-buttons {
        display: flex;
        gap: 7px;
        align-items: end;
        height: 100%;
    }

    .btn-filter {
        min-height: 43px;
        padding: 9px 16px;
        border-radius: 9px;
        background: #2563eb;
        border: none;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-filter:hover {
        background: #1d4ed8;
    }

    .btn-reset {
        min-height: 43px;
        padding: 9px 16px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
    }

    /* TABLE CARD */
    .table-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .table-card .card-body {
        padding: 0;
    }

    .table-header {
        padding: 18px 20px;
        border-bottom: 1px solid #eef2f7;
        background: #ffffff;
    }

    .table-header-title {
        color: #1e293b;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .table-header-subtitle {
        color: #94a3b8;
        font-size: 12px;
        margin: 3px 0 0;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .orders-table {
        margin-bottom: 0;
        min-width: 850px;
    }

    .orders-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        padding: 13px 16px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .orders-table tbody td {
        padding: 15px 16px;
        color: #475569;
        font-size: 13px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .orders-table tbody tr {
        transition: .2s ease;
    }

    .orders-table tbody tr:hover {
        background: #f8fbff;
    }

    .orders-table tbody tr:last-child td {
        border-bottom: none;
    }

    .number-cell {
        color: #94a3b8;
        font-weight: 600;
    }

    .order-number {
        color: #2563eb;
        font-weight: 700;
    }

    .buyer-name {
        color: #334155;
        font-weight: 600;
    }

    .total-price {
        color: #0f172a;
        font-weight: 700;
        white-space: nowrap;
    }

    .date-cell {
        color: #64748b;
        white-space: nowrap;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .status-processing {
        background: #dbeafe;
        color: #2563eb;
    }

    .status-shipped {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    /* DETAIL BUTTON */
    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-detail:hover {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        margin: 0 auto 14px;
        border-radius: 16px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .empty-state-title {
        color: #334155;
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 4px;
    }

    .empty-state-text {
        color: #94a3b8;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* PAGINATION */
    .pagination-wrapper {
        padding: 16px 20px;
        border-top: 1px solid #eef2f7;
        background: #ffffff;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: flex-end;
    }

    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {

        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 21px;
        }

        .filter-buttons {
            align-items: stretch;
        }

        .filter-buttons .btn {
            flex: 1;
        }

        .table-header {
            padding: 16px;
        }

    }

    @media (max-width: 576px) {

        .filter-card .card-body {
            padding: 16px;
        }

        .filter-buttons {
            margin-top: 5px;
        }

        .page-header {
            border-radius: 14px;
        }

        .table-card {
            border-radius: 14px !important;
        }

    }
</style>


<div class="container-fluid orders-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>

            <div>

                <h2 class="fw-bold">
                    Semua Pesanan
                </h2>

                <p>
                    Kelola dan pantau seluruh pesanan marketplace DesaHub.
                </p>

            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="card filter-card border-0 shadow-sm">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.orders.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-5">

                        <label class="filter-label">
                            Cari Pesanan
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control filter-control"
                            placeholder="Cari nomor pesanan atau pembeli"
                            value="{{ request('search') }}"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="filter-label">
                            Status Pesanan
                        </label>

                        <select name="status"
                                class="form-select filter-control">

                            <option value="">
                                Semua Status
                            </option>

                            @foreach(['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $status)

                                <option value="{{ $status }}"
                                    @selected(request('status') === $status)>

                                    {{ ucfirst($status) }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-3">

                        <div class="filter-buttons">

                            <button class="btn btn-primary btn-filter"
                                    type="submit">

                                <i class="fas fa-filter me-1"></i>
                                Filter

                            </button>

                            <a href="{{ route('admin.orders.index') }}"
                               class="btn btn-secondary btn-reset">

                                <i class="fas fa-rotate-left me-1"></i>
                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="card table-card border-0 shadow-sm">

        <div class="table-header">

            <p class="table-header-title">
                Daftar Pesanan
            </p>

            <p class="table-header-subtitle">
                Menampilkan seluruh transaksi yang masuk ke DesaHub.
            </p>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle orders-table">

                <thead>

                    <tr>

                        <th>No.</th>
                        <th>Nomor Pesanan</th>
                        <th>Pembeli</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td class="number-cell">
                                {{ $orders->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <span class="order-number">
                                    {{ $order->order_number }}
                                </span>
                            </td>

                            <td>
                                <span class="buyer-name">
                                    {{ $order->user->name ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="total-price">
                                    Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>

                                <span class="status-badge status-{{ $order->status }}">

                                    {{ ucfirst($order->status) }}

                                </span>

                            </td>

                            <td class="date-cell">
                                {{ $order->created_at->format('d-m-Y') }}
                            </td>

                            <td>

                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn-detail">

                                    <i class="fas fa-eye"></i>
                                    Detail

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="empty-state">

                                <div class="empty-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>

                                <div class="empty-state-title">
                                    Belum Ada Pesanan
                                </div>

                                <p class="empty-state-text">
                                    Belum ada pesanan yang masuk ke sistem.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            <div class="pagination-wrapper">
                {{ $orders->links() }}
            </div>

        </div>

    </div>

</div>

@endsection