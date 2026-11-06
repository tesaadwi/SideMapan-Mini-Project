@extends('layouts.admin')

@section('content')

<style>
    .add-product-page {
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

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 9px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 600;
        background: #ffffff;
    }

    /* FORM CARD */
    .form-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 26px;
    }

    /* SECTION */
    .form-section {
        margin-bottom: 24px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #1e293b;
        font-size: 15px;
        font-weight: 700;
        padding-bottom: 12px;
        margin-bottom: 18px;
        border-bottom: 1px solid #eef2f7;
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

    /* LABEL */
    .form-label {
        color: #334155;
        font-size: 13px;
        font-weight: 600 !important;
        margin-bottom: 7px;
    }

    .required-mark {
        color: #dc2626;
    }

    /* INPUT */
    .form-control,
    .form-select {
        min-height: 43px;
        border: 1px solid #dbe1ea;
        border-radius: 9px;
        color: #334155;
        font-size: 13px;
        box-shadow: none !important;
        transition: .2s ease;
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10) !important;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .input-group-text {
        background: #f8fafc;
        border-color: #dbe1ea;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        border-radius: 9px 0 0 9px;
    }

    .input-group .form-control {
        border-radius: 0 9px 9px 0;
    }

    /* FILE */
    .file-help {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        margin-top: 7px;
    }

    /* STATUS */
    .status-info {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 14px;
        margin-top: 8px;
    }

    .status-info i {
        color: #2563eb;
    }

    .status-info span {
        color: #64748b;
        font-size: 11px;
    }

    /* BUTTON */
    .form-actions {
        border-top: 1px solid #eef2f7;
        padding-top: 20px;
        margin-top: 8px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 9px 17px;
        border: none;
        border-radius: 9px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 5px 14px rgba(37, 99, 235, .16);
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 9px 17px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
    }

    /* ERROR */
    .invalid-feedback {
        font-size: 11px;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }

        .page-header h3 {
            font-size: 21px;
        }

        .page-header .d-flex {
            align-items: flex-start !important;
            flex-direction: column;
        }

        .back-button {
            width: 100%;
            justify-content: center;
        }

        .form-card .card-body {
            padding: 20px;
        }
    }

    @media (max-width: 576px) {
        .form-actions {
            flex-direction: column;
        }

        .btn-save,
        .btn-cancel {
            width: 100%;
        }
    }
</style>


<div class="container-fluid add-product-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center gap-3">

            <div class="d-flex align-items-center gap-3">

                <div class="header-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>

                <div>

                    <h3 class="fw-bold">
                        Tambah Produk
                    </h3>

                    <p>
                        Tambahkan produk baru ke marketplace DesaHub.
                    </p>

                </div>

            </div>


            <a href="{{ route('admin.products.index') }}"
               class="btn btn-light border back-button">

                <i class="fa-solid fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>


    {{-- FORM --}}
    <div class="card form-card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- INFORMASI PRODUK --}}
                <div class="form-section">

                    <div class="section-title">

                        <span class="section-icon">
                            <i class="fa-solid fa-box"></i>
                        </span>

                        Informasi Produk

                    </div>


                    {{-- Nama Produk --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Produk
                            <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama produk"
                            required
                        >

                        @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- UMKM --}}
                    <div class="mb-3">

                        <label class="form-label">
                            UMKM
                            <span class="required-mark">*</span>
                        </label>

                        <select
                            name="umkm_id"
                            class="form-select @error('umkm_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Pilih UMKM
                            </option>

                            @foreach($umkms as $umkm)

                                <option
                                    value="{{ $umkm->id }}"
                                    @selected(old('umkm_id') == $umkm->id)
                                >
                                    {{ $umkm->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('umkm_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Kategori --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Kategori
                            <span class="required-mark">*</span>
                        </label>

                        <select
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Pilih Kategori
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="4"
                            placeholder="Masukkan deskripsi produk"
                        >{{ old('description') }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- HARGA DAN STOK --}}
                <div class="form-section">

                    <div class="section-title">

                        <span class="section-icon">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>

                        Harga & Stok

                    </div>


                    <div class="row">

                        {{-- Harga --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Harga
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    min="0"
                                    step="1"
                                    value="{{ old('price') }}"
                                    placeholder="0"
                                    required
                                >

                            </div>

                            @error('price')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Stok --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Stok
                                <span class="required-mark">*</span>
                            </label>

                            <input
                                type="number"
                                name="stock"
                                class="form-control @error('stock') is-invalid @enderror"
                                min="0"
                                value="{{ old('stock', 0) }}"
                                placeholder="0"
                                required
                            >

                            @error('stock')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- GAMBAR --}}
                <div class="form-section">

                    <div class="section-title">

                        <span class="section-icon">
                            <i class="fa-solid fa-image"></i>
                        </span>

                        Gambar Produk

                    </div>


                    <label class="form-label">
                        Gambar Produk
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/png,image/jpeg,image/webp"
                    >

                    <small class="file-help">
                        Format yang didukung: JPG, JPEG, PNG, atau WEBP.
                    </small>

                    @error('image')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="form-section mb-0">

                    <div class="section-title">

                        <span class="section-icon">
                            <i class="fa-solid fa-toggle-on"></i>
                        </span>

                        Status Produk

                    </div>


                    <label class="form-label">
                        Status
                        <span class="required-mark">*</span>
                    </label>

                    <select
                        name="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >

                        <option
                            value="aktif"
                            @selected(old('status', 'aktif') == 'aktif')
                        >
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            @selected(old('status') == 'nonaktif')
                        >
                            Nonaktif
                        </option>

                    </select>

                    @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                    <div class="status-info">

                        <i class="fa-solid fa-circle-info me-2"></i>

                        <span>
                            Produk berstatus aktif akan dapat ditampilkan di marketplace DesaHub.
                        </span>

                    </div>

                </div>


                {{-- TOMBOL --}}
                <div class="form-actions d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary btn-save"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Simpan Produk

                    </button>


                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-secondary btn-cancel"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection