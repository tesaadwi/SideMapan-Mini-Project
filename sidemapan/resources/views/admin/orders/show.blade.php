@extends('layouts.admin')

@section('content')

<style>
    .order-detail-page {
        padding-bottom: 30px;
    }

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
        margin-bottom: 4px;
    }

    .page-header p {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 9px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .info-card,
    .product-card,
    .summary-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .card-section-header {
        padding: 17px 20px;
        border-bottom: 1px solid #eef2f7;
        background: #ffffff;
    }

    .card-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #1e293b;
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    .section-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .info-card .card-body {
        padding: 20px;
    }

    .order-number {
        color: #2563eb;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 11px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        color: #64748b;
        font-size: 13px;
    }

    .info-value {
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        text-align: right;
    }

    .address-value {
        max-width: 55%;
        line-height: 1.5;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
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

    .product-card .card-body {
        padding: 0;
    }

    .product-item {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-name {
        color: #1e293b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .product-detail {
        color: #64748b;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .umkm-name {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #94a3b8;
        font-size: 11px;
    }

    .product-subtotal {
        color: #0f172a;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }

    .summary-card {
        margin-top: 20px;
    }

    .summary-card .card-body {
        padding: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 9px 0;
        color: #64748b;
        font-size: 13px;
    }

    .summary-row strong {
        color: #334155;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #e5e7eb;
        margin-top: 8px;
        padding-top: 16px;
    }

    .summary-total span {
        color: #1e293b;
        font-size: 15px;
        font-weight: 700;
    }

    .summary-total strong {
        color: #2563eb;
        font-size: 20px;
        font-weight: 800;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }

        .page-header h2 {
            font-size: 21px;
        }

        .info-row {
            flex-direction: column;
            gap: 5px;
        }

        .info-value {
            text-align: left;
        }

        .address-value {
            max-width: 100%;
        }
    }
</style>


<div class="container-fluid order-detail-page">

    {{-- KEMBALI --}}
    <a href="{{ route('admin.orders.index') }}"
       class="btn btn-outline-secondary back-button">

        <i class="fas fa-arrow-left"></i>
        Kembali ke Pesanan

    </a>


    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon">
                <i class="fas fa-receipt"></i>
            </div>

            <div>

                <h2 class="fw-bold">
                    Detail Pesanan
                </h2>

                <p>
                    Informasi lengkap mengenai pesanan pelanggan DesaHub.
                </p>

            </div>

        </div>

    </div>


    <div class="row g-4">

        {{-- INFORMASI PESANAN --}}
        <div class="col-lg-5">

            <div class="card info-card border-0 shadow-sm">

                <div class="card-section-header">

                    <h5 class="card-section-title">

                        <span class="section-icon">
                            <i class="fas fa-user"></i>
                        </span>

                        Informasi Pesanan

                    </h5>

                </div>


                <div class="card-body">

                    <div class="order-number">
                        {{ $order->order_number }}
                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Pembeli
                        </span>

                        <span class="info-value">
                            {{ $order->user->name ?? '-' }}
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Email
                        </span>

                        <span class="info-value">
                            {{ $order->user->email ?? '-' }}
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Alamat Pengiriman
                        </span>

                        <span class="info-value address-value">
                            {{ $order->shipping_address }}
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Status
                        </span>

                        <span class="info-value">

                            <span class="status-badge status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>

                        </span>

                    </div>

                </div>

            </div>


            {{-- RINGKASAN PEMBAYARAN --}}
            <div class="card summary-card border-0 shadow-sm">

                <div class="card-section-header">

                    <h5 class="card-section-title">

                        <span class="section-icon">
                            <i class="fas fa-wallet"></i>
                        </span>

                        Ringkasan Pembayaran

                    </h5>

                </div>


                <div class="card-body">

                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            Rp{{ number_format($order->subtotal, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Biaya Pengiriman
                        </span>

                        <strong>
                            Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="summary-total">

                        <span>
                            Total
                        </span>

                        <strong>
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- DETAIL PRODUK --}}
        <div class="col-lg-7">

            <div class="card product-card border-0 shadow-sm">

                <div class="card-section-header">

                    <h5 class="card-section-title">

                        <span class="section-icon">
                            <i class="fas fa-box"></i>
                        </span>

                        Detail Produk

                    </h5>

                </div>


                <div class="card-body">

                    @foreach($order->items as $item)

                        <div class="product-item">

                            <div class="d-flex justify-content-between gap-3">

                                <div>

                                    <div class="product-name">
                                        {{ $item->product_name }}
                                    </div>

                                    <div class="product-detail">

                                        {{ $item->quantity }} ×
                                        Rp{{ number_format($item->price, 0, ',', '.') }}

                                    </div>

                                    <div class="umkm-name">

                                        <i class="fas fa-store"></i>

                                        UMKM:
                                        {{ $item->product->umkm->name ?? '-' }}

                                    </div>

                                </div>


                                <div class="product-subtotal">

                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@endsection