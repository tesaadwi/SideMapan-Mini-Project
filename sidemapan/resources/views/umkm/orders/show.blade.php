@extends('layouts.umkm')

@section('content')

<style>
    .order-detail-page {
        background: #f8fafc;
        min-height: calc(100vh - 80px);
        margin: -24px;
        padding: 28px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 9px 14px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
        margin-bottom: 18px;
    }

    .back-btn:hover {
        color: #059669;
        border-color: #a7f3d0;
        background: #ecfdf5;
        transform: translateX(-2px);
    }

    .page-header {
        background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 55%, #f0fdf4 100%);
        border: 1px solid #d1fae5;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 22px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .05);
    }

    .page-header-content {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .page-icon {
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

    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, .04);
        margin-bottom: 18px;
    }

    .detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .06);
        overflow: hidden;
    }

    .card-section {
        padding: 23px;
    }

    .card-section + .card-section {
        border-top: 1px solid #e2e8f0;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .section-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #ecfdf5;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .section-title {
        color: #1e293b;
        font-size: 15px;
        font-weight: 800;
        margin: 0;
    }

    .section-subtitle {
        color: #94a3b8;
        font-size: 11px;
        margin: 2px 0 0;
    }

    .order-number-box {
        background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
        border: 1px solid #d1fae5;
        border-radius: 13px;
        padding: 15px 17px;
        margin-bottom: 18px;
    }

    .order-label {
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 5px;
    }

    .order-number {
        color: #047857;
        font-size: 17px;
        font-weight: 800;
        word-break: break-word;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .info-box {
        border: 1px solid #e2e8f0;
        background: #ffffff;
        border-radius: 12px;
        padding: 14px;
    }

    .info-label {
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 6px;
    }

    .info-value {
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .address-box {
        margin-top: 12px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 12px;
        padding: 14px;
    }

    .address-text {
        color: #475569;
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
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

    .product-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-info {
        min-width: 0;
    }

    .product-name {
        color: #334155;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .product-detail {
        color: #94a3b8;
        font-size: 11px;
        margin: 0;
    }

    .product-price {
        color: #047857;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .summary-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        padding: 16px;
    }

    .summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .summary-row:last-child {
        margin-bottom: 0;
    }

    .summary-row strong {
        color: #334155;
    }

    .summary-total {
        padding-top: 12px;
        margin-top: 12px;
        border-top: 1px dashed #cbd5e1;
        color: #1e293b;
        font-size: 14px;
        font-weight: 800;
    }

    .summary-total strong {
        color: #047857;
        font-size: 16px;
    }

    .status-form {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px;
    }

    .form-label-custom {
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-select-custom {
        min-height: 44px;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        font-size: 12px;
        color: #334155;
        box-shadow: none;
    }

    .form-select-custom:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, .10);
    }

    .update-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        border: none;
        border-radius: 10px;
        background: #059669;
        color: #ffffff;
        padding: 11px 16px;
        font-size: 12px;
        font-weight: 700;
        margin-top: 5px;
        box-shadow: 0 5px 14px rgba(5, 150, 105, .18);
        transition: all .2s ease;
    }

    .update-btn:hover {
        background: #047857;
        transform: translateY(-1px);
    }

    .locked-alert {
        border-radius: 13px;
        padding: 15px;
        margin: 0;
        border: none;
        font-size: 12px;
    }

    .locked-alert strong {
        display: block;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .empty-products {
        background: #fffbeb;
        border: 1px solid #fde68a;
        color: #92400e;
        border-radius: 12px;
        padding: 14px;
        font-size: 12px;
    }

    @media (max-width: 768px) {

        .order-detail-page {
            margin: -16px;
            padding: 18px;
        }

        .page-title {
            font-size: 21px;
        }

        .card-section {
            padding: 18px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .product-item {
            align-items: flex-start;
            flex-direction: column;
            gap: 7px;
        }

        .product-price {
            align-self: flex-end;
        }
    }
</style>


<div class="order-detail-page">

    {{-- TOMBOL KEMBALI --}}
    <a href="{{ route('umkm.orders.index') }}"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Kembali ke Pesanan

    </a>


    {{-- HEADER --}}
    <div class="page-header">

        <div class="page-header-content">

            <div class="page-icon">
                <i class="fa-solid fa-file-invoice"></i>
            </div>

            <div>
                <h2 class="page-title">
                    Detail Pesanan
                </h2>

                <p class="page-subtitle">
                    Lihat informasi pesanan dan perbarui status pesanan pelanggan.
                </p>
            </div>

        </div>

    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))

        <div class="alert alert-success alert-custom d-flex align-items-center gap-2">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-custom d-flex align-items-center gap-2">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- ERROR VALIDASI --}}
    @if($errors->any())

        <div class="alert alert-danger alert-custom">

            <div class="fw-bold mb-2">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                Pesanan belum dapat diperbarui.
            </div>

            <ul class="mb-0 ps-3">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- DETAIL CARD --}}
    <div class="detail-card">


        {{-- INFORMASI PESANAN --}}
        <div class="card-section">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>

                <div>

                    <h5 class="section-title">
                        Informasi Pesanan
                    </h5>

                    <p class="section-subtitle">
                        Informasi dasar pesanan pelanggan
                    </p>

                </div>

            </div>


            <div class="order-number-box">

                <div class="order-label">
                    Nomor Pesanan
                </div>

                <div class="order-number">
                    {{ $order->order_number }}
                </div>

            </div>


            <div class="info-grid">

                <div class="info-box">

                    <div class="info-label">
                        Pembeli
                    </div>

                    <div class="info-value">

                        <i class="fa-solid fa-user me-1 text-success"></i>

                        {{ $order->user->name ?? '-' }}

                    </div>

                </div>


                <div class="info-box">

                    <div class="info-label">
                        Status Pesanan
                    </div>

                    @php
                        $badges = [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'shipped' => 'primary',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                        ];
                    @endphp

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

                </div>

            </div>


            <div class="address-box">

                <div class="info-label">
                    <i class="fa-solid fa-location-dot me-1"></i>
                    Alamat Pengiriman
                </div>

                <p class="address-text">
                    {{ $order->shipping_address }}
                </p>

            </div>

        </div>


        {{-- PRODUK --}}
        <div class="card-section">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <div>

                    <h5 class="section-title">
                        Produk dari Toko Kamu
                    </h5>

                    <p class="section-subtitle">
                        Produk yang berasal dari UMKM kamu
                    </p>

                </div>

            </div>


            @forelse($items as $item)

                <div class="product-item">

                    <div class="product-info">

                        <div class="product-name">
                            {{ $item->product_name }}
                        </div>

                        <p class="product-detail">

                            {{ $item->quantity }}

                            ×

                            Rp{{ number_format($item->price, 0, ',', '.') }}

                        </p>

                    </div>

                    <div class="product-price">

                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}

                    </div>

                </div>

            @empty

                <div class="empty-products">

                    <i class="fa-solid fa-triangle-exclamation me-1"></i>

                    Tidak ada produk dari toko kamu pada pesanan ini.

                </div>

            @endforelse

        </div>


        {{-- RINGKASAN HARGA --}}
        <div class="card-section">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-calculator"></i>
                </div>

                <div>

                    <h5 class="section-title">
                        Ringkasan Harga
                    </h5>

                    <p class="section-subtitle">
                        Total nilai produk dari toko kamu
                    </p>

                </div>

            </div>


            <div class="summary-box">

                <div class="summary-row">

                    <span>
                        Subtotal Produk Kamu
                    </span>

                    <strong>
                        Rp{{ number_format($items->sum('subtotal'), 0, ',', '.') }}
                    </strong>

                </div>


                <div class="summary-row summary-total">

                    <span>
                        Total Produk
                    </span>

                    <strong>
                        Rp{{ number_format($items->sum('subtotal'), 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- PERBARUI STATUS --}}
        <div class="card-section">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </div>

                <div>

                    <h5 class="section-title">
                        Perbarui Status Pesanan
                    </h5>

                    <p class="section-subtitle">
                        Kelola proses pesanan pelanggan
                    </p>

                </div>

            </div>


            @if(in_array($order->status, ['pending', 'processing', 'shipped']))

                <div class="status-form">

                    <form
                        action="{{ route('umkm.orders.updateStatus', $order) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="mb-3">

                            <label for="status"
                                   class="form-label-custom">

                                Pilih Status Baru

                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select form-select-custom"
                                required
                            >

                                <option value="">
                                    -- Pilih Status --
                                </option>


                                @if($order->status === 'pending')

                                    <option value="processing">
                                        Sedang Diproses
                                    </option>

                                @elseif($order->status === 'processing')

                                    <option value="shipped">
                                        Dikirim
                                    </option>

                                @elseif($order->status === 'shipped')

                                    <option value="completed">
                                        Selesai
                                    </option>

                                @endif

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="update-btn"
                        >

                            <i class="fa-solid fa-check"></i>

                            Perbarui Status

                        </button>

                    </form>

                </div>


            @elseif($order->status === 'completed')

                <div class="alert alert-success locked-alert">

                    <strong>
                        <i class="fa-solid fa-circle-check me-1"></i>
                        Pesanan selesai
                    </strong>

                    Status pesanan sudah tidak dapat diubah lagi.

                </div>


            @elseif($order->status === 'cancelled')

                <div class="alert alert-danger locked-alert">

                    <strong>
                        <i class="fa-solid fa-circle-xmark me-1"></i>
                        Pesanan dibatalkan
                    </strong>

                    Status pesanan sudah tidak dapat diubah lagi.

                </div>


            @else

                <div class="alert alert-secondary locked-alert">

                    <strong>
                        <i class="fa-solid fa-lock me-1"></i>
                        Status tidak dapat diubah
                    </strong>

                    Status pesanan tidak dapat diubah.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection