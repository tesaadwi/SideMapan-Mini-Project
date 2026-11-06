@extends('layouts.umkm')

@section('content')

<style>
    .edit-product-page {
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

    .form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .form-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .form-card-title {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .form-card-subtitle {
        font-size: 12px;
        color: #94a3b8;
        margin: 4px 0 0;
    }

    .form-card-body {
        padding: 26px;
    }

    .form-section {
        margin-bottom: 26px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #334155;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 17px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }

    .section-title i {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: #ecfdf5;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .form-label-custom {
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .required-star {
        color: #ef4444;
    }

    .form-control,
    .form-select {
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        min-height: 44px;
        font-size: 13px;
        color: #334155;
        padding: 10px 13px;
        box-shadow: none;
        transition: all .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.10);
    }

    textarea.form-control {
        min-height: 115px;
        resize: vertical;
    }

    .input-group-text {
        background: #f8fafc;
        border-color: #dbe2ea;
        color: #64748b;
        border-radius: 10px 0 0 10px;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .current-image-box {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        padding: 12px;
        margin-bottom: 12px;
    }

    .current-image {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 11px;
        border: 1px solid #dbe2ea;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.08);
    }

    .image-info-title {
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .image-info-text {
        color: #94a3b8;
        font-size: 11px;
        margin: 0;
    }

    .help-text {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        margin-top: 6px;
    }

    .error-text {
        display: block;
        color: #dc2626;
        font-size: 11px;
        margin-top: 6px;
        font-weight: 500;
    }

    .status-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        padding: 15px;
    }

    .status-label {
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-top: 22px;
        border-top: 1px solid #e2e8f0;
        margin-top: 8px;
    }

    .footer-info {
        color: #94a3b8;
        font-size: 11px;
    }

    .button-group {
        display: flex;
        gap: 8px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        border-radius: 10px;
        background: #059669;
        color: #ffffff;
        padding: 10px 17px;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 5px 14px rgba(5, 150, 105, 0.18);
        transition: all .2s ease;
    }

    .btn-save:hover {
        background: #047857;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        background: #ffffff;
        color: #475569;
        padding: 10px 16px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
    }

    .btn-back:hover {
        background: #f8fafc;
        color: #1e293b;
        border-color: #cbd5e1;
    }

    .alert-custom {
        border: none;
        border-radius: 13px;
        padding: 14px 16px;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
    }

    .alert-custom ul {
        padding-left: 20px;
    }

    @media (max-width: 768px) {
        .edit-product-page {
            margin: -16px;
            padding: 18px;
        }

        .page-header {
            padding: 18px;
        }

        .page-title {
            font-size: 21px;
        }

        .form-card-body {
            padding: 19px;
        }

        .form-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .button-group {
            width: 100%;
        }

        .button-group .btn-save,
        .button-group .btn-back {
            flex: 1;
            justify-content: center;
        }
    }
</style>


<div class="edit-product-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex align-items-center gap-3">

            <div class="page-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>

            <div>
                <h3 class="page-title">
                    Edit Produk
                </h3>

                <p class="page-subtitle">
                    Perbarui informasi produk yang kamu jual di DesaHub.
                </p>
            </div>

        </div>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger alert-custom mb-4">

            <div class="fw-bold mb-2">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                Produk belum dapat diperbarui.
            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">

            <p class="form-card-title">
                Informasi Produk
            </p>

            <p class="form-card-subtitle">
                Pastikan informasi produk sudah sesuai sebelum menyimpan perubahan.
            </p>

        </div>


        <div class="form-card-body">

            <form action="{{ route('umkm.products.update', $product) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- INFORMASI DASAR --}}
                <div class="form-section">

                    <div class="section-title">

                        <i class="fa-solid fa-box"></i>

                        Informasi Dasar

                    </div>


                    {{-- KATEGORI --}}
                    <div class="mb-4">

                        <label class="form-label-custom">
                            Kategori
                            <span class="required-star">*</span>
                        </label>

                        <select name="category_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $product->category_id) == $category->id)>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('category_id')

                            <small class="error-text">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    {{-- NAMA PRODUK --}}
                    <div class="mb-4">

                        <label class="form-label-custom">
                            Nama Produk
                            <span class="required-star">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $product->name) }}"
                               placeholder="Masukkan nama produk"
                               required>

                        @error('name')

                            <small class="error-text">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="mb-0">

                        <label class="form-label-custom">
                            Deskripsi
                        </label>

                        <textarea name="description"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Masukkan deskripsi produk">{{ old('description', $product->description) }}</textarea>

                        @error('description')

                            <small class="error-text">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>

                        @enderror

                    </div>

                </div>


                {{-- HARGA & STOK --}}
                <div class="form-section">

                    <div class="section-title">

                        <i class="fa-solid fa-tags"></i>

                        Harga & Stok

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label-custom">
                                Harga
                                <span class="required-star">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input type="number"
                                       name="price"
                                       class="form-control"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('price', $product->price) }}"
                                       placeholder="Contoh: 25000"
                                       required>

                            </div>

                            @error('price')

                                <small class="error-text">
                                    <i class="fa-solid fa-circle-exclamation me-1"></i>
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label-custom">
                                Stok
                                <span class="required-star">*</span>
                            </label>

                            <input type="number"
                                   name="stock"
                                   class="form-control"
                                   min="0"
                                   value="{{ old('stock', $product->stock) }}"
                                   required>

                            @error('stock')

                                <small class="error-text">
                                    <i class="fa-solid fa-circle-exclamation me-1"></i>
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- GAMBAR --}}
                <div class="form-section">

                    <div class="section-title">

                        <i class="fa-solid fa-image"></i>

                        Gambar Produk

                    </div>


                    @if($product->image)

                        <div class="current-image-box">

                            <img src="{{ asset('storage/' . $product->image) }}"
                                 width="120"
                                 height="120"
                                 class="current-image"
                                 style="object-fit: cover;"
                                 alt="Gambar produk">

                            <div>

                                <div class="image-info-title">
                                    Gambar Saat Ini
                                </div>

                                <p class="image-info-text">
                                    Kosongkan upload jika tidak ingin mengganti gambar.
                                </p>

                            </div>

                        </div>

                    @endif


                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/png,image/jpeg,image/webp">

                    <small class="help-text">
                        Format yang didukung: JPG, JPEG, PNG, atau WEBP.
                    </small>

                    @error('image')

                        <small class="error-text">
                            <i class="fa-solid fa-circle-exclamation me-1"></i>
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="form-section mb-0">

                    <div class="section-title">

                        <i class="fa-solid fa-toggle-on"></i>

                        Status Produk

                    </div>


                    <div class="status-box">

                        <label class="status-label">
                            Status
                            <span class="required-star">*</span>
                        </label>

                        <select name="status"
                                class="form-select"
                                required>

                            <option value="active"
                                @selected(old('status', $product->status) === 'active')>

                                Aktif

                            </option>

                            <option value="inactive"
                                @selected(old('status', $product->status) === 'inactive')>

                                Nonaktif

                            </option>

                        </select>

                        @error('status')

                            <small class="error-text">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>

                        @enderror

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="form-footer">

                    <span class="footer-info">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Periksa kembali data sebelum menyimpan.
                    </span>

                    <div class="button-group">

                        <a href="{{ route('umkm.products.index') }}"
                           class="btn-back">

                            <i class="fa-solid fa-arrow-left"></i>

                            Kembali

                        </a>

                        <button type="submit"
                                class="btn-save">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection