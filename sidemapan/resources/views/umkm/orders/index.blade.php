@extends('layouts.umkm')

@section('content')

<style>
    .orders-page {
        background: #f8fafc;
        min-height: calc(100vh - 80px);
        margin: -24px;
        padding: 28px;
    }

    .page-header {
        background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 55%, #f0fdf4 100%);
        border: 1px solid #d1fae5;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.05);
    }

    .page-icon {
        width: 48px;
        height: 48px;
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
        font-size: 25px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 14px;
        margin: 5px 0 0;
    }

    .alert-custom {
        border: none;
        border-radius: 13px;
        padding: 13px 16px;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        margin-bottom: 20px;
    }

    .orders-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
    }

    .card-header-custom {
        padding: 19px 22px;
        border-bottom: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .card-header-title {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .card-header-subtitle {
        color: #94a3b8;
        font-size: 12px;
        margin: 4px 0 0;
    }

    .orders-table {
        margin-bottom: 0;
    }

    .orders-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .orders-table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
        font-size: 13px;
        vertical-align: middle;
    }

    .orders-table tbody tr {
        transition: all .2s ease;
    }

    .orders-table tbody tr:hover {
        background: #f0fdf4;
    }

    .number-cell {
        width: 32px;
        height: 30px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .order-number {
        color: #1e293b;
        font-weight: 700;
        font-size: 13px;
    }

    .order-number small {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 500;
        margin-top: 3px;
    }

    .buyer-wrapper {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .buyer-avatar {
        width: 35px;
        height: 35px;
        border-radius: 10px;
        background: #ecfdf5;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #d1fae5;
    }

    .buyer-name {
        color: #334155;
        font-weight: 600;
        font-size: 13px;
    }

    .product-count {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 10px;
        border-radius: 9px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
    }

    .product-count i {
        color: #059669;
    }

    .total-price {
        color: #047857;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pending {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .status-processing {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .status-shipped {
        background: #f5f3ff;
        color: #7c3aed;
        border: 1px solid #ddd6fe;
    }

    .status-completed {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .status-cancelled {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .status-default {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .detail-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        border-radius: 9px;
        background: #059669;
        color: white;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 3px 8px rgba(5, 150, 105, .15);
        transition: all .2s ease;
    }

    .detail-btn:hover {
        background: #047857;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(5, 150, 105, .20);
    }

    .empty-state {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
        border: 1px solid #d1fae5;
        color: #34d399;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin-bottom: 15px;
    }

    .empty-title {
        font-size: 14px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 4px;
    }

    .empty-text {
        color: #94a3b8;
        font-size: 12px;
        margin: 0;
    }

    .pagination-wrapper {
        padding: 18px 22px;
        border-top: 1px solid #e2e8f0;
    }

    @media (max-width: 768px) {
        .orders-page {
            margin: -16px;
            padding: 18px;
        }

        .page-header {
            padding: 18px;
        }

        .page-title {
            font-size: 21px;
        }

        .orders-card {
            border-radius: 14px;
        }
    }
</style>


<div class="orders-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex align-items-center gap-3">

            <div class="page-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <div>
                <h2 class="page-title">
                    Pesanan Masuk
                </h2>

                <p class="page-subtitle">
                    Kelola pesanan pelanggan dari produk usaha kamu.
                </p>
            </div>

        </div>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-custom d-flex align-items-center gap-2">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-custom d-flex align-items-center gap-2">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- TABLE --}}
    <div class="orders-card">

        <div class="card-header-custom">

            <p class="card-header-title">
                Daftar Pesanan
            </p>

            <p class="card-header-subtitle">
                Pesanan yang memiliki produk dari toko kamu.
            </p>

        </div>


        <div class="card-body p-0 table-responsive">

            <table class="table orders-table align-middle">

                <thead>

                    <tr>

                        <th>No.</th>
                        <th>Nomor Pesanan</th>
                        <th>Pembeli</th>
                        <th>Produk Toko</th>
                        <th>Total Pesanan</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            {{-- NO --}}
                            <td>

                                <span class="number-cell">
                                    {{ $orders->firstItem() + $loop->index }}
                                </span>

                            </td>


                            {{-- NOMOR PESANAN --}}
                            <td>

                                <div class="order-number">

                                    {{ $order->order_number }}

                                    <small>
                                        Pesanan DesaHub
                                    </small>

                                </div>

                            </td>


                            {{-- PEMBELI --}}
                            <td>

                                <div class="buyer-wrapper">

                                    <div class="buyer-avatar">
                                        <i class="fa-solid fa-user"></i>
                                    </div>

                                    <span class="buyer-name">
                                        {{ $order->user->name ?? '-' }}
                                    </span>

                                </div>

                            </td>


                            {{-- PRODUK TOKO --}}
                            <td>

                                <span class="product-count">

                                    <i class="fa-solid fa-box"></i>

                                    {{ $order->items->filter(fn($item) => $item->product?->umkm_id === auth()->user()->umkm?->id)->sum('quantity') }}

                                    barang

                                </span>

                            </td>


                            {{-- TOTAL PESANAN --}}
                            <td>
    <span class="total-price">
        Rp{{ number_format($order->total, 0, ',', '.') }}
    </span>
</td>


                            {{-- STATUS --}}
                            <td>

                                @if($order->status === 'pending')

                                    <span class="status-badge status-pending">
                                        <i class="fa-solid fa-clock"></i>
                                        Menunggu
                                    </span>

                                @elseif($order->status === 'processing')

                                    <span class="status-badge status-processing">
                                        <i class="fa-solid fa-spinner"></i>
                                        Diproses
                                    </span>

                                @elseif($order->status === 'shipped')

                                    <span class="status-badge status-shipped">
                                        <i class="fa-solid fa-truck"></i>
                                        Dikirim
                                    </span>

                                @elseif($order->status === 'completed')

                                    <span class="status-badge status-completed">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Selesai
                                    </span>

                                @elseif($order->status === 'cancelled')

                                    <span class="status-badge status-cancelled">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Dibatalkan
                                    </span>

                                @else

                                    <span class="status-badge status-default">
                                        {{ ucfirst($order->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <a href="{{ route('umkm.orders.show', $order) }}"
                                   class="detail-btn">

                                    <i class="fa-solid fa-eye"></i>

                                    Detail

                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="7"
                                class="empty-state">

                                <div class="empty-icon">

                                    <i class="fa-solid fa-cart-shopping"></i>

                                </div>

                                <div class="empty-title">
                                    Belum ada pesanan masuk
                                </div>

                                <p class="empty-text">
                                    Pesanan pelanggan akan muncul di halaman ini.
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

@endsection