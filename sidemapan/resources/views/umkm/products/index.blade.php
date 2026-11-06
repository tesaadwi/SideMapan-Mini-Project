@extends('layouts.umkm')

@section('content')

<style>
    .products-page {
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

    .btn-add-product {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 11px;
        background: #059669;
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        border: none;
        box-shadow: 0 5px 14px rgba(5, 150, 105, 0.20);
        transition: all .2s ease;
    }

    .btn-add-product:hover {
        background: #047857;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(5, 150, 105, 0.25);
    }

    .alert-custom {
        border: none;
        border-radius: 13px;
        padding: 13px 16px;
        font-size: 13px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
    }

    .products-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
    }

    .table-header {
        padding: 19px 22px;
        border-bottom: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .table-header-title {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .table-header-subtitle {
        font-size: 12px;
        color: #94a3b8;
        margin: 4px 0 0;
    }

    .products-table {
        margin-bottom: 0;
    }

    .products-table thead th {
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

    .products-table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
        font-size: 13px;
        vertical-align: middle;
    }

    .products-table tbody tr {
        transition: all .2s ease;
    }

    .products-table tbody tr:hover {
        background: #f0fdf4;
    }

    .number-cell {
        width: 45px;
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

    .product-image {
        width: 58px;
        height: 58px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 3px 8px rgba(15, 23, 42, 0.08);
    }

    .product-placeholder {
        width: 58px;
        height: 58px;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px dashed #cbd5e1;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .product-name {
        color: #1e293b;
        font-weight: 700;
        font-size: 13px;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 8px;
        background: #f0fdf4;
        color: #047857;
        font-size: 11px;
        font-weight: 700;
    }

    .price-text {
        color: #047857;
        font-weight: 800;
        white-space: nowrap;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 35px;
        padding: 6px 9px;
        border-radius: 8px;
        background: #f8fafc;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        border: 1px solid #e2e8f0;
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

    .status-active {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .status-inactive {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .action-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all .2s ease;
    }

    .btn-edit {
        background: #fff7ed;
        color: #ea580c;
    }

    .btn-edit:hover {
        background: #ffedd5;
        color: #c2410c;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #fee2e2;
        color: #b91c1c;
        transform: translateY(-2px);
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
        background: #ffffff;
    }

    @media (max-width: 768px) {
        .products-page {
            margin: -16px;
            padding: 18px;
        }

        .page-header {
            padding: 18px;
        }

        .page-title {
            font-size: 21px;
        }

        .page-header .d-flex {
            align-items: flex-start !important;
            gap: 15px;
        }

        .btn-add-product {
            padding: 9px 12px;
            font-size: 12px;
        }

        .products-card {
            border-radius: 14px;
        }
    }
</style>


<div class="products-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-3">

                <div class="page-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <div>
                    <h3 class="page-title">
                        Produk Saya
                    </h3>

                    <p class="page-subtitle">
                        Kelola produk usaha kamu dengan mudah.
                    </p>
                </div>

            </div>

            <a href="{{ route('umkm.products.create') }}"
               class="btn-add-product">

                <i class="fa-solid fa-plus"></i>

                Tambah Produk

            </a>

        </div>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-custom d-flex align-items-center gap-2">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-custom d-flex align-items-center gap-2">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger alert-custom">

            <div class="fw-bold mb-2">
                <i class="fa-solid fa-triangle-exclamation me-1"></i>
                Terdapat kesalahan:
            </div>

            <ul class="mb-0 ps-3">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- TABLE --}}
    <div class="products-card">

        <div class="table-header">

            <p class="table-header-title">
                Daftar Produk
            </p>

            <p class="table-header-subtitle">
                Daftar produk yang kamu kelola di DesaHub.
            </p>

        </div>


        <div class="card-body p-0 table-responsive">

            <table class="table products-table align-middle">

                <thead>

                    <tr>

                        <th>No.</th>

                        <th>Gambar</th>

                        <th>Nama Produk</th>

                        <th>Kategori</th>

                        <th>Harga</th>

                        <th>Stok</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($products as $product)

                        <tr>

                            {{-- NO --}}
                            <td>
                                <span class="number-cell">
                                    {{ $products->firstItem() + $loop->index }}
                                </span>
                            </td>


                            {{-- GAMBAR --}}
                            <td>

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="product-image"
                                    >

                                @else

                                    <span class="product-placeholder">

                                        <i class="fa-solid fa-image"></i>

                                    </span>

                                @endif

                            </td>


                            {{-- NAMA --}}
                            <td>

                                <span class="product-name">
                                    {{ $product->name }}
                                </span>

                            </td>


                            {{-- KATEGORI --}}
                            <td>

                                <span class="category-badge">

                                    <i class="fa-solid fa-tag"></i>

                                    {{ $product->category?->name ?? '-' }}

                                </span>

                            </td>


                            {{-- HARGA --}}
                            <td>

                                <span class="price-text">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- STOK --}}
                            <td>

                                <span class="stock-badge">
                                    {{ $product->stock }}
                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($product->status === 'active')

                                    <span class="status-badge status-active">

                                        <i class="fa-solid fa-circle-check"></i>

                                        Aktif

                                    </span>

                                @else

                                    <span class="status-badge status-inactive">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        Nonaktif

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-wrapper">

                                    <a href="{{ route('umkm.products.edit', $product) }}"
                                       class="btn-action btn-edit"
                                       title="Edit Produk">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>


                                    <form
                                        action="{{ route('umkm.products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')"
                                        class="d-inline"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action btn-delete"
                                            title="Hapus Produk"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="8"
                                class="empty-state">

                                <div class="empty-icon">

                                    <i class="fa-solid fa-box-open"></i>

                                </div>

                                <div class="empty-title">
                                    Belum ada produk
                                </div>

                                <p class="empty-text">
                                    Tambahkan produk pertama kamu untuk mulai berjualan di DesaHub.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="pagination-wrapper">

            {{ $products->links() }}

        </div>

    </div>

</div>

@endsection