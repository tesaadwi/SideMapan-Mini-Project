@extends('layouts.admin')

@section('content')

<style>
    .kategori-page {
        padding-bottom: 30px;
    }

    .page-header {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 75%);
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 24px 26px;
        margin-bottom: 22px;
    }

    .page-header h3 {
        color: #111827;
        font-size: 24px;
        margin-bottom: 6px;
    }

    .page-header p {
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
        flex-shrink: 0;
    }

    .btn-add {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 600;
        box-shadow: 0 5px 14px rgba(37, 99, 235, .20);
        transition: .2s ease;
    }

    .btn-add:hover {
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(37, 99, 235, .28);
    }

    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 14px;
    }

    .alert-success-custom {
        background: #ecfdf5;
        color: #047857;
    }

    .alert-danger-custom {
        background: #fef2f2;
        color: #b91c1c;
    }

    .data-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
        background: #ffffff;
    }

    .table-wrapper {
        border: 1px solid #edf0f4;
        border-radius: 12px;
        overflow: hidden;
    }

    .category-table {
        margin-bottom: 0;
    }

    .category-table thead {
        background: #f8fafc;
    }

    .category-table thead th {
        border-bottom: 1px solid #e5e7eb;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 15px;
        white-space: nowrap;
    }

    .category-table tbody td {
        padding: 15px;
        border-color: #f1f5f9;
        color: #475569;
        font-size: 14px;
        vertical-align: middle;
    }

    .category-table tbody tr {
        transition: .15s ease;
    }

    .category-table tbody tr:hover {
        background: #f8fbff;
    }

    .number-cell {
        color: #94a3b8 !important;
        font-weight: 600;
        width: 60px;
    }

    .category-name {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .category-title {
        color: #1e293b;
        font-weight: 700;
    }

    .description-text {
        color: #64748b;
        max-width: 350px;
    }

    .product-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 700;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-buttons .btn {
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        padding: 7px 11px;
    }

    .btn-edit {
        color: #b45309;
        background: #fffbeb;
        border: 1px solid #fef3c7;
    }

    .btn-edit:hover {
        color: #92400e;
        background: #fef3c7;
    }

    .btn-delete {
        color: #dc2626;
        background: #fef2f2;
        border: 1px solid #fee2e2;
    }

    .btn-delete:hover {
        color: #b91c1c;
        background: #fee2e2;
    }

    .empty-state {
        padding: 45px 20px !important;
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 19px;
    }

    .pagination-wrapper {
        padding-top: 20px;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }

        .page-header .header-content {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 15px;
        }

        .btn-add {
            width: 100%;
        }
    }
</style>

<div class="container-fluid kategori-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center header-content">

            <div class="d-flex align-items-center gap-3">

                <div class="header-icon">
                    <i class="fas fa-layer-group"></i>
                </div>

                <div>
                    <h3 class="fw-bold">
                        Kategori Produk
                    </h3>

                    <p>
                        Kelola kategori marketplace DesaHub.
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.kategori.create') }}"
               class="btn btn-primary btn-add">

                <i class="fas fa-plus me-1"></i>
                Tambah Kategori

            </a>

        </div>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-custom alert-success-custom mb-4">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="alert alert-custom alert-danger-custom mb-4">

            <i class="fas fa-circle-exclamation me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- DATA --}}
    <div class="card data-card shadow-sm">

        <div class="card-body p-4">

            <div class="table-wrapper">

                <div class="table-responsive">

                    <table class="table table-hover align-middle category-table">

                        <thead>

                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Produk</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($categories as $category)

                                <tr>

                                    {{-- NO --}}
                                    <td class="number-cell">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>


                                    {{-- NAMA --}}
                                    <td>

                                        <div class="category-name">

                                            <div class="category-icon">
                                                <i class="fas fa-tag"></i>
                                            </div>

                                            <div class="category-title">
                                                {{ $category->name }}
                                            </div>

                                        </div>

                                    </td>


                                    {{-- DESKRIPSI --}}
                                    <td>

                                        <span class="description-text">
                                            {{ $category->description ?? '-' }}
                                        </span>

                                    </td>


                                    {{-- JUMLAH PRODUK --}}
                                    <td>

                                        <span class="product-count">

                                            <i class="fas fa-box"></i>

                                            {{ $category->products_count }}

                                            <span class="fw-normal">
                                                produk
                                            </span>

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="action-buttons">

                                            <a href="{{ route('admin.kategori.edit', $category) }}"
                                               class="btn btn-edit">

                                                <i class="fas fa-pen me-1"></i>
                                                Edit

                                            </a>


                                            <form action="{{ route('admin.kategori.destroy', $category) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus kategori ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-delete">

                                                    <i class="fas fa-trash me-1"></i>
                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center empty-state">

                                        <div class="empty-icon">
                                            <i class="fas fa-tags"></i>
                                        </div>

                                        <div class="fw-semibold text-secondary">
                                            Belum ada kategori
                                        </div>

                                        <small class="text-muted">
                                            Kategori produk akan muncul di sini.
                                        </small>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}
            <div class="pagination-wrapper">
                {{ $categories->links() }}
            </div>

        </div>

    </div>

</div>

@endsection