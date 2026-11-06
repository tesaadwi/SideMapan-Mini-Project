@extends('layouts.admin')

@section('content')

<style>
    .umkm-page {
        padding-bottom: 30px;
    }

    .page-header {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 70%);
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
        font-size: 14px;
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

    .alert-success-custom {
        border: none;
        border-radius: 12px;
        background: #ecfdf5;
        color: #047857;
        padding: 13px 16px;
        font-size: 14px;
    }

    .data-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
        background: #ffffff;
    }

    .filter-area {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .filter-area .form-control,
    .filter-area .form-select {
        border: 1px solid #dbe1ea;
        border-radius: 9px;
        min-height: 42px;
        font-size: 14px;
        box-shadow: none;
    }

    .filter-area .form-control:focus,
    .filter-area .form-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .btn-search {
        border-radius: 9px;
        min-height: 42px;
        font-weight: 600;
        background: #2563eb;
        border-color: #2563eb;
    }

    .table-wrapper {
        border: 1px solid #edf0f4;
        border-radius: 12px;
        overflow: hidden;
    }

    .umkm-table {
        margin-bottom: 0;
    }

    .umkm-table thead {
        background: #f8fafc;
    }

    .umkm-table thead th {
        border-bottom: 1px solid #e5e7eb;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 15px;
        white-space: nowrap;
    }

    .umkm-table tbody td {
        padding: 15px;
        border-color: #f1f5f9;
        color: #475569;
        font-size: 14px;
        vertical-align: middle;
    }

    .umkm-table tbody tr {
        transition: .15s ease;
    }

    .umkm-table tbody tr:hover {
        background: #f8fbff;
    }

    .number-cell {
        color: #94a3b8 !important;
        font-weight: 600;
        width: 55px;
    }

    .umkm-name {
        color: #1e293b;
        font-weight: 700;
        font-size: 14px;
    }

    .owner-name {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .owner-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .phone-text {
        color: #64748b;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 20px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-approved {
        background: #ecfdf5;
        color: #059669;
    }

    .status-rejected {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-pending {
        background: #fffbeb;
        color: #d97706;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 10px;
    }

    .btn-detail {
        color: #2563eb;
        background: #eff6ff;
        border: 1px solid #dbeafe;
    }

    .btn-detail:hover {
        color: #1d4ed8;
        background: #dbeafe;
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
        color: #94a3b8 !important;
    }

    .empty-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 12px;
        border-radius: 14px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .pagination-wrapper {
        padding-top: 20px;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: flex-end;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }

        .page-header .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 15px;
        }

        .btn-add {
            width: 100%;
        }

        .filter-area {
            padding: 12px;
        }

        .action-buttons {
            min-width: 150px;
        }
    }
</style>

<div class="container-fluid umkm-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div
                        style="
                            width: 38px;
                            height: 38px;
                            border-radius: 10px;
                            background: #dbeafe;
                            color: #2563eb;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 17px;
                        "
                    >
                        <i class="fas fa-store"></i>
                    </div>

                    <h3 class="fw-bold mb-0">Data UMKM</h3>
                </div>

                <p class="text-muted">
                    Kelola seluruh UMKM DesaHub.
                </p>
            </div>

            <a href="{{ route('admin.umkm.create') }}"
               class="btn btn-primary btn-add">
                <i class="fas fa-plus me-1"></i>
                Tambah UMKM
            </a>

        </div>

    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="alert alert-success-custom mb-4">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- DATA CARD --}}
    <div class="card data-card shadow-sm border-0">

        <div class="card-body p-4">

            {{-- FILTER --}}
            <div class="filter-area">

                <form method="GET"
                      action="{{ route('admin.umkm.index') }}"
                      class="row g-2">

                    <div class="col-md-6">

                        <div class="position-relative">
                            <i
                                class="fas fa-search position-absolute"
                                style="
                                    left: 13px;
                                    top: 13px;
                                    color: #94a3b8;
                                    font-size: 13px;
                                "
                            ></i>

                            <input type="text"
                                   name="search"
                                   class="form-control ps-5"
                                   placeholder="Cari nama UMKM..."
                                   value="{{ request('search') }}">
                        </div>

                    </div>

                    <div class="col-md-3">

                        <select name="status"
                                class="form-select">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="menunggu"
                                @selected(request('status') == 'menunggu')>
                                Menunggu
                            </option>

                            <option value="disetujui"
                                @selected(request('status') == 'disetujui')>
                                Disetujui
                            </option>

                            <option value="ditolak"
                                @selected(request('status') == 'ditolak')>
                                Ditolak
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button class="btn btn-primary btn-search w-100">
                            <i class="fas fa-search me-1"></i>
                            Cari
                        </button>

                    </div>

                </form>

            </div>

            {{-- TABLE --}}
            <div class="table-wrapper">

                <div class="table-responsive">

                    <table class="table table-hover align-middle umkm-table">

                        <thead>

                            <tr>
                                <th>No.</th>
                                <th>Nama UMKM</th>
                                <th>Pemilik</th>
                                <th>Telepon</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($umkms as $umkm)

                                <tr>

                                    <td class="number-cell">
                                        {{ $umkms->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <div class="umkm-name">
                                            {{ $umkm->nama_umkm }}
                                        </div>
                                    </td>

                                    <td>

                                        <div class="owner-name">

                                            <div class="owner-avatar">
                                                {{ strtoupper(substr($umkm->user?->name ?? 'U', 0, 1)) }}
                                            </div>

                                            <span>
                                                {{ $umkm->user?->name ?? 'Belum terhubung' }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>
                                        <span class="phone-text">
                                            <i class="fas fa-phone me-1 text-muted"></i>
                                            {{ $umkm->no_telepon }}
                                        </span>
                                    </td>

                                    <td>

                                        @if($umkm->status_verifikasi == 'disetujui')

                                            <span class="status-badge status-approved">
                                                Disetujui
                                            </span>

                                        @elseif($umkm->status_verifikasi == 'ditolak')

                                            <span class="status-badge status-rejected">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="status-badge status-pending">
                                                Menunggu
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <div class="action-buttons">

                                            <a href="{{ route('admin.umkm.show', $umkm) }}"
                                               class="btn btn-detail">
                                                <i class="fas fa-eye me-1"></i>
                                                Detail
                                            </a>

                                            <a href="{{ route('admin.umkm.edit', $umkm) }}"
                                               class="btn btn-edit">
                                                <i class="fas fa-edit me-1"></i>
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.umkm.destroy', $umkm) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-delete">
                                                    <i class="fas fa-trash me-1"></i>
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="text-center empty-state">

                                        <div class="empty-icon">
                                            <i class="fas fa-store-slash"></i>
                                        </div>

                                        <div class="fw-semibold text-secondary mb-1">
                                            Belum ada data UMKM
                                        </div>

                                        <small>
                                            Data UMKM yang terdaftar akan muncul di sini.
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
                {{ $umkms->links() }}
            </div>

        </div>

    </div>

</div>

@endsection