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

    .page-header h3 {
        color: #111827;
        font-size: 24px;
        margin-bottom: 5px;
    }

    .page-header p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 14px;
    }

    .form-card {
        border: 1px solid #e5e7eb !important;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 26px;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1e293b;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 22px;
    }

    .form-section-title-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .form-label-custom {
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-control-custom {
        border: 1px solid #dbe1ea;
        border-radius: 9px;
        min-height: 44px;
        font-size: 14px;
        color: #334155;
        box-shadow: none;
        transition: .2s ease;
    }

    .form-control-custom:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    textarea.form-control-custom {
        min-height: 120px;
        resize: vertical;
    }

    .error-text {
        display: block;
        margin-top: 6px;
        font-size: 12px;
        color: #dc2626;
    }

    .button-area {
        border-top: 1px solid #f1f5f9;
        margin-top: 25px;
        padding-top: 20px;
        display: flex;
        gap: 8px;
    }

    .btn-save {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 5px 14px rgba(37, 99, 235, .18);
        transition: .2s ease;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(37, 99, 235, .25);
    }

    .btn-back {
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 14px;
        font-weight: 600;
    }

    .form-hint {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 6px;
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 20px;
        }

        .form-card .card-body {
            padding: 20px;
        }

        .button-area {
            flex-direction: column;
        }

        .button-area .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid kategori-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon">
                <i class="fas fa-plus"></i>
            </div>

            <div>
                <h3 class="fw-bold">
                    Tambah Kategori
                </h3>

                <p>
                    Tambahkan kategori baru untuk produk marketplace DesaHub.
                </p>
            </div>

        </div>

    </div>


    {{-- FORM --}}
    <div class="card form-card border-0 shadow-sm">

        <div class="card-body">

            <div class="form-section-title">

                <div class="form-section-title-icon">
                    <i class="fas fa-tag"></i>
                </div>

                Informasi Kategori

            </div>


            <form action="{{ route('admin.kategori.store') }}" method="POST">

                @csrf


                {{-- NAMA KATEGORI --}}
                <div class="mb-4">

                    <label class="form-label form-label-custom">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control form-control-custom"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Makanan, Fashion, Kerajinan"
                        required
                    >

                    @error('name')
                        <small class="error-text">
                            <i class="fas fa-circle-exclamation me-1"></i>
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-2">

                    <label class="form-label form-label-custom">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        class="form-control form-control-custom"
                        rows="4"
                        placeholder="Masukkan deskripsi singkat kategori..."
                    >{{ old('description') }}</textarea>

                    <div class="form-hint">
                        <i class="fas fa-info-circle me-1"></i>
                        Deskripsi membantu menjelaskan jenis produk dalam kategori.
                    </div>

                    @error('description')
                        <small class="error-text">
                            <i class="fas fa-circle-exclamation me-1"></i>
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- BUTTON --}}
                <div class="button-area">

                    <button type="submit"
                            class="btn btn-primary btn-save">

                        <i class="fas fa-save me-1"></i>
                        Simpan Kategori

                    </button>

                    <a href="{{ route('admin.kategori.index') }}"
                       class="btn btn-secondary btn-back">

                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection