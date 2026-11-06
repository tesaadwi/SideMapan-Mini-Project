@extends('layouts.admin')

@section('content')

<style>
    .products-page {
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

    .page-header h3 {
        color: #111827;
        font-size: 24px;
        margin-bottom: 5px;
    }

    .page-header p {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 9px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 5px 14px rgba(37, 99, 235, .18);
        transition: .2s ease;
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        transform: translateY(-1px);
    }

    /* ALERT */
    .custom-alert {
        border-radius: 11px;
        padding: 12px 15px;
        font-size: 13px;
        margin-bottom: 18px;
    }

    /* MAIN CARD */
    .products-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .products-card .card-body {
        padding: 0;
    }

    /* FILTER */
    .filter-section {
        padding: 20px;
        border-bottom: 1px solid #eef2f7;
        background: #ffffff;
    }

    .filter-label {
        display: block;
        color: #475569;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .filter-control {
        min-height: 42px;
        border: 1px solid #dbe1ea;
        border-radius: 9px;
        color: #334155;
        font-size: 13px;
        box-shadow: none !important;
        transition: .2s ease;
    }

    .filter-control:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10) !important;
    }

    .btn-search {
        min-height: 42px;
        border-radius: 9px;
        background: #2563eb;
        border: none;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-search:hover {
        background: #1d4ed8;
    }

    /* TABLE */
    .table-section {
        overflow-x: auto;
    }

    .products-table {
        min-width: 1050px;
        margin-bottom: 0;
    }

    .products-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        padding: 13px 15px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .products-table tbody td {
        padding: 13px 15px;
        color: #475569;
        font-size: 13px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .products-table tbody tr {
        transition: .2s ease;
    }

    .products-table tbody tr:hover {
        background: #f8fbff;
    }

    .products-table tbody tr:last-child td {
        border-bottom: none;
    }

    .number-cell {
        color: #94a3b8;
        font-weight: 600;
    }

    /* PRODUCT IMAGE */
    .product-image {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .image-placeholder {
        width: 55px;
        height: 55px;
        border-radius: 10px;
        background: #f1f5f9;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 17px;
    }

    /* PRODUCT NAME */
    .product-name {
        color: #1e293b;
        font-weight: 700;
        font-size: 13px;
        max-width: 180px;
    }

    .umkm-name {
        color: #475569;
        font-weight: 600;
    }

    .category-name {
        display: inline-flex;
        align-items: center;
        background: #f1f5f9;
        color: #475569;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .price {
        color: #0f172a;
        font-weight: 700;
        white-space: nowrap;
    }

    .stock {
        color: #334155;
        font-weight: 600;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-active {
        background: #dcfce7;
        color: #15803d;
    }

    .status-inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    /* ACTION */
    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        font-size: 12px;
        transition: .2s ease;
    }

    .btn-edit {
        background: #fef3c7;
        color: #b45309;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: #ffffff;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
    }

    /* EMPTY */
    .empty-state {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 14px;
        border-radius: 16px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .empty-title {
        color: #334155;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .empty-text {
        color: #94a3b8;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* PAGINATION */
    .pagination-section {
        padding: 16px 20px;
        border-top: 1px solid #eef2f7;
    }

    .pagination-section nav {
        display: flex;
        justify-content: flex-end;
    }

    .pagination-section .pagination {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }

        .page-header h3 {
            font-size: 21px;
        }

        .btn-add {
            padding: 9px 12px;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            border-radius: 14px;
        }

        .page-header .d-flex {
            align-items: flex-start !important;
            flex-direction: column;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .filter-section {
            padding: 16px;
        }
    }
</style>


<div class="container-fluid products-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center gap-3">

            <div class="d-flex align-items-center gap-3">

                <div class="header-icon">
                    <i class="fa-solid fa-box"></i>
                </div>

                <div>

                    <h3 class="fw-bold">
                        Data Produk
                    </h3>

                    <p>
                        Kelola produk UMKM DesaHub.
                    </p>

                </div>

            </div>


            <a href="{{ route('admin.products.create') }}"
               class="btn btn-primary btn-add">

                <i class="fa-solid fa-plus"></i>
                Tambah Produk

            </a>

        </div>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success custom-alert border-0 shadow-sm">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger custom-alert border-0 shadow-sm">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- MAIN CARD --}}
    <div class="card products-card border-0 shadow-sm">

        {{-- FILTER --}}
        <div class="filter-section">

            <form
                method="GET"
                action="{{ route('admin.products.index') }}"
                class="row g-3 align-items-end"
            >

                {{-- SEARCH --}}
                <div class="col-md-5">

                    <label class="filter-label">
                        Cari Produk
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control filter-control"
                        placeholder="Cari nama produk..."
                        value="{{ request('search') }}"
                    >

                </div>


                {{-- CATEGORY --}}
                <div class="col-md-3">

                    <label class="filter-label">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        class="form-select filter-control"
                    >

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(request('category_id') == $category->id)
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- STATUS --}}
                <div class="col-md-2">

                    <label class="filter-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select filter-control"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="aktif"
                            @selected(request('status') == 'aktif')
                        >
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            @selected(request('status') == 'nonaktif')
                        >
                            Nonaktif
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary btn-search w-100"
                    >

                        <i class="fa-solid fa-magnifying-glass me-2"></i>
                        Cari

                    </button>

                </div>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="table-section">

            <table class="table table-hover align-middle products-table">

                <thead>

                    <tr>

                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>UMKM</th>
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

                            {{-- NOMOR --}}
                            <td class="number-cell">
                                {{ $products->firstItem() + $loop->index }}
                            </td>


                            {{-- GAMBAR --}}
                            <td>

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        class="product-image"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <div class="image-placeholder">
                                        <i class="fa-solid fa-image"></i>
                                    </div>

                                @endif

                            </td>


                            {{-- NAMA PRODUK --}}
                            <td>

                                <div class="product-name">
                                    {{ $product->name }}
                                </div>

                            </td>


                            {{-- UMKM --}}
                            <td>

                                <span class="umkm-name">
                                    {{ $product->umkm->name ?? '-' }}
                                </span>

                            </td>


                            {{-- KATEGORI --}}
                            <td>

                                <span class="category-name">

                                    <i class="fa-solid fa-tag me-1"></i>

                                    {{ $product->category->name ?? '-' }}

                                </span>

                            </td>


                            {{-- HARGA --}}
                            <td>

                                <span class="price">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- STOK --}}
                            <td>

                                <span class="stock">
                                    {{ $product->stock }}
                                </span>

                            </td>


                            {{-- STATUS --}}
<td>

    @if($product->status === 'active')

        <span class="status-badge status-active">

            <i class="fa-solid fa-check"></i>
            Aktif

        </span>

    @else

        <span class="status-badge status-inactive">

            <i class="fa-solid fa-ban"></i>
            Nonaktif

        </span>

    @endif

</td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-buttons">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="btn-action btn-edit"
                                        title="Edit Produk"
                                    >

                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')"
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

                            <td
                                colspan="9"
                                class="empty-state"
                            >

                                <div class="empty-icon">

                                    <i class="fa-solid fa-box-open"></i>

                                </div>

                                <div class="empty-title">
                                    Belum Ada Produk
                                </div>

                                <p class="empty-text">
                                    Belum ada produk yang tersedia di DesaHub.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="pagination-section">

            {{ $products->links() }}

        </div>

    </div>

</div>

@endsection