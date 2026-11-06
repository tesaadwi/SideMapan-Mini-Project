
@extends('layouts.admin')

@section('title', 'Detail Verifikasi UMKM')

@section('content')

<style>
    .detail-page {
        background: #f3f8f4;
        min-height: calc(100vh - 80px);
        margin: -24px;
        padding: 28px;
        color: #334b3d;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #dcebe0;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(16, 92, 59, .045);
    }

    .hero-card {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        background: linear-gradient(135deg, #198754 0%, #105c3b 55%, #0b3d2a 100%);
        color: white;
        box-shadow: 0 12px 30px rgba(16, 92, 59, .17);
    }

    .hero-card::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -90px;
        top: -150px;
        background: rgba(255,255,255,.10);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-card::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: 80px;
        bottom: -130px;
        background: rgba(255,255,255,.08);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .store-avatar {
        width: 82px;
        height: 82px;
        border-radius: 22px;
        background: rgba(255,255,255,.16);
        border: 1px solid rgba(255,255,255,.28);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,.10);
        flex-shrink: 0;
    }

    .info-card {
        height: 100%;
        padding: 20px;
        border-radius: 16px;
        background: #fff;
        border: 1px solid #e1eee4;
        transition: .2s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16,92,59,.07);
        border-color: #b9ddc3;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eaf6ed;
        color: #17663b;
        flex-shrink: 0;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-title-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #eaf6ed;
        color: #17663b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .status-box {
        border-radius: 16px;
        padding: 24px;
        text-align: center;
    }

    .status-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 26px;
    }

    .action-btn {
        width: 100%;
        border-radius: 12px;
        padding: 12px 18px;
        font-weight: 600;
        border: 0;
        transition: .2s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .reject-panel {
        border-radius: 14px;
        background: #fff5f4;
        border: 1px solid #f3d5d2;
    }

    .description-box {
        background: #f6faf7;
        border: 1px solid #e1eee4;
        border-radius: 14px;
        padding: 20px;
        line-height: 1.8;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: rgba(255,255,255,.83);
    }

    .detail-page h2,
    .detail-page h5,
    .detail-page h6 {
        color: #173f2a;
    }

    .detail-page .hero-card h2 {
        color: #fff;
        overflow-wrap: anywhere;
    }

    .detail-page .btn-back {
        background: #fff;
        color: #17663b;
        border: 1px solid #dcebe0;
        transition: .2s ease;
    }

    .detail-page .btn-back:hover {
        background: #eaf6ed;
        color: #0b3d2a;
        border-color: #b9ddc3;
        transform: translateY(-1px);
    }

    .detail-page .btn-approve {
        background: linear-gradient(135deg, #198754, #105c3b);
        color: #fff;
        box-shadow: 0 5px 12px rgba(16,92,59,.14);
    }

    .detail-page .btn-approve:hover {
        background: linear-gradient(135deg, #157347, #0b3d2a);
        color: #fff;
    }

    .detail-page .btn-reject {
        color: #bd4141;
        border: 1px solid #f0c9c6;
        background: #fff;
    }

    .detail-page .btn-reject:hover {
        color: #a52e2e;
        background: #fff5f4;
        border-color: #e7b1ad;
    }

    .detail-page .form-control {
        border-color: #dcebe0;
        color: #334b3d;
    }

    .detail-page .form-control:focus {
        border-color: #72b78a;
        box-shadow: 0 0 0 3px rgba(25,135,84,.10);
    }

    .detail-page .btn-danger {
        background: #c24141;
        border-color: #c24141;
    }

    .detail-page .btn-danger:hover {
        background: #a52e2e;
        border-color: #a52e2e;
    }

    @media (max-width: 768px) {
        .detail-page {
            margin: -16px;
            padding: 16px;
        }

        .hero-card {
            border-radius: 18px;
        }

        .store-avatar {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            font-size: 24px;
        }

        .detail-page .hero-content {
            padding: 22px !important;
        }

        .detail-page .hero-content .d-flex.align-items-center.gap-4 {
            align-items: flex-start !important;
            gap: 14px !important;
        }

        .detail-page .hero-content h2 {
            font-size: 1.35rem;
        }

        .detail-page .hero-content .meta-item {
            font-size: 12px;
        }

        .info-card {
            padding: 16px;
        }

        .detail-page .row.g-4 {
            --bs-gutter-x: 1rem;
            --bs-gutter-y: 1rem;
        }
    }
</style>


<div class="detail-page">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-column flex-md-row
                justify-content-between
                align-items-md-center
                gap-3 mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-2">

                <span class="badge rounded-pill
                             bg-success bg-opacity-10
                             text-success
                             px-3 py-2">

                    <i class="fa-solid fa-store me-1"></i>
                    Verifikasi UMKM

                </span>

                <span class="text-muted small">
                    / Detail
                </span>

            </div>

            <h2 class="fw-bold mb-1">
                Detail UMKM
            </h2>

            <p class="text-muted mb-0">
                Lihat informasi dan lakukan verifikasi UMKM.
            </p>

        </div>


        <a href="{{ route('admin.verifikasi.index') }}"
           class="btn btn-back shadow-sm
                  rounded-3 px-4 py-2">

            <i class="fa-solid fa-arrow-left me-2"></i>
            Kembali

        </a>

    </div>


    {{-- ================= SUCCESS ================= --}}
    @if(session('success'))

        <div class="alert alert-success
                    border-0 shadow-sm rounded-3
                    d-flex align-items-center gap-3 mb-4">

            <div class="rounded-circle
                        bg-success bg-opacity-10
                        text-success
                        d-flex align-items-center justify-content-center"
                 style="width:42px;height:42px;">

                <i class="fa-solid fa-check"></i>

            </div>

            <div>
                <div class="fw-bold">
                    Berhasil
                </div>

                <div class="small">
                    {{ session('success') }}
                </div>
            </div>

        </div>

    @endif


    {{-- ================= HERO ================= --}}
    <div class="hero-card mb-4">

        <div class="hero-content p-4 p-lg-5">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <div class="d-flex align-items-center gap-4">

                        <div class="store-avatar">

                            <i class="fa-solid fa-store"></i>

                        </div>


                        <div>

                            <div class="text-white-50
                                        text-uppercase
                                        small
                                        fw-semibold
                                        mb-1">

                                UMKM Desa Gilang

                            </div>

                            <h2 class="fw-bold mb-2">

                                {{ $umkm->nama_umkm }}

                            </h2>

                            <div class="d-flex flex-wrap gap-3">

                                <div class="meta-item">

                                    <i class="fa-solid fa-user"></i>

                                    {{ $umkm->user->name ?? '-' }}

                                </div>

                                <div class="meta-item">

                                    <i class="fa-solid fa-location-dot"></i>

                                    Desa Gilang

                                </div>

                                <div class="meta-item">

                                    <i class="fa-solid fa-hashtag"></i>

                                    {{ $umkm->id }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-4 mt-4 mt-lg-0">

                    <div class="bg-white bg-opacity-10
                                rounded-4
                                p-4
                                text-center"
                         style="backdrop-filter:blur(8px);">

                        <div class="small text-white-50 mb-2">
                            STATUS VERIFIKASI
                        </div>

                        @if($umkm->status === 'approved')

                            <div class="fw-bold fs-5">

                                <i class="fa-solid fa-circle-check me-2"></i>
                                Disetujui

                            </div>

                        @elseif($umkm->status === 'rejected')

                            <div class="fw-bold fs-5">

                                <i class="fa-solid fa-circle-xmark me-2"></i>
                                Ditolak

                            </div>

                        @else

                            <div class="fw-bold fs-5">

                                <i class="fa-solid fa-clock me-2"></i>
                                Menunggu

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================= MAIN GRID ================= --}}
    <div class="row g-4">


        {{-- ================= LEFT ================= --}}
        <div class="col-xl-8">


            {{-- PEMILIK --}}
            <div class="detail-card p-4 mb-4">

                <div class="section-title">

                    <div class="section-title-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Informasi Pemilik
                        </h5>

                        <small class="text-muted">
                            Data akun pemilik UMKM
                        </small>

                    </div>

                </div>


                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="d-flex align-items-center gap-3">

                                <div class="info-icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>

                                <div class="overflow-hidden">

                                    <small class="text-muted d-block mb-1">
                                        Nama Pemilik
                                    </small>

                                    <div class="fw-bold text-dark text-truncate">

                                        {{ $umkm->user->name ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="d-flex align-items-center gap-3">

                                <div class="info-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>

                                <div class="overflow-hidden">

                                    <small class="text-muted d-block mb-1">
                                        Email
                                    </small>

                                    <div class="fw-bold text-dark text-truncate">

                                        {{ $umkm->user->email ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="d-flex align-items-center gap-3">

                                <div class="info-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>

                                <div>

                                    <small class="text-muted d-block mb-1">
                                        Nomor Telepon
                                    </small>

                                    <div class="fw-bold text-dark">

                                        {{ $umkm->phone ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="d-flex align-items-start gap-3">

                                <div class="info-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>

                                <div>

                                    <small class="text-muted d-block mb-1">
                                        Alamat
                                    </small>

                                    <div class="fw-bold text-dark">

                                        {{ $umkm->address ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- DESKRIPSI --}}
            <div class="detail-card p-4 mb-4">

                <div class="section-title">

                    <div class="section-title-icon">
                        <i class="fa-solid fa-align-left"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Tentang UMKM
                        </h5>

                        <small class="text-muted">
                            Deskripsi usaha
                        </small>

                    </div>

                </div>


                <div class="description-box">

                    <p class="mb-0 text-secondary">

                        {{ $umkm->description ?? '-' }}

                    </p>

                </div>

            </div>



            {{-- ALASAN PENOLAKAN --}}
            @if($umkm->status === 'rejected')

                <div class="detail-card p-4 mb-4">

                    <div class="reject-panel p-4">

                        <div class="d-flex gap-3">

                            <div class="rounded-3
                                        bg-danger
                                        text-white
                                        d-flex align-items-center justify-content-center
                                        flex-shrink-0"
                                 style="width:44px;height:44px;">

                                <i class="fa-solid fa-xmark"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold text-danger mb-2">

                                    Alasan Penolakan

                                </h6>

                                <p class="text-danger mb-0">

                                    {{ $umkm->rejection_reason ?? '-' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            @endif


        </div>



        {{-- ================= RIGHT ================= --}}
        <div class="col-xl-4">


            {{-- STATUS --}}
            <div class="detail-card p-4 mb-4">

                <div class="section-title">

                    <div class="section-title-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Status
                        </h5>

                        <small class="text-muted">
                            Status verifikasi UMKM
                        </small>

                    </div>

                </div>


                @if($umkm->status === 'approved')

                    <div class="status-box bg-success bg-opacity-10">

                        <div class="status-icon
                                    bg-success
                                    text-white">

                            <i class="fa-solid fa-check"></i>

                        </div>

                        <h5 class="fw-bold text-success">
                            Disetujui
                        </h5>

                        <p class="text-muted small mb-0">
                            UMKM telah berhasil diverifikasi.
                        </p>

                    </div>

                @elseif($umkm->status === 'rejected')

                    <div class="status-box bg-danger bg-opacity-10">

                        <div class="status-icon
                                    bg-danger
                                    text-white">

                            <i class="fa-solid fa-xmark"></i>

                        </div>

                        <h5 class="fw-bold text-danger">
                            Ditolak
                        </h5>

                        <p class="text-muted small mb-0">
                            Pengajuan UMKM ditolak.
                        </p>

                    </div>

                @else

                    <div class="status-box bg-warning bg-opacity-10">

                        <div class="status-icon
                                    bg-warning
                                    text-white">

                            <i class="fa-solid fa-clock"></i>

                        </div>

                        <h5 class="fw-bold text-warning">
                            Menunggu
                        </h5>

                        <p class="text-muted small mb-0">
                            Menunggu tindakan admin.
                        </p>

                    </div>

                @endif

            </div>



            {{-- AKSI --}}
            <div class="detail-card p-4">

                <div class="section-title">

                    <div class="section-title-icon">
                        <i class="fa-solid fa-sliders"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Aksi Verifikasi
                        </h5>

                        <small class="text-muted">
                            Kelola status pengajuan
                        </small>

                    </div>

                </div>


                {{-- SETUJUI --}}
                @if($umkm->status !== 'approved')

                    <form
                        action="{{ route('admin.verifikasi.setujui', $umkm->id) }}"
                        method="POST"
                        onsubmit="return confirm('Setujui UMKM ini?')"
                        class="mb-3"
                    >

                        @csrf
                        @method('PUT')

                        <button class="btn btn-approve action-btn">

                            <i class="fa-solid fa-check me-2"></i>

                            Setujui UMKM

                        </button>

                    </form>

                @endif


                {{-- TOLAK --}}
                @if($umkm->status !== 'rejected')

                    <button
                        class="btn btn-reject action-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#formTolak"
                    >

                        <i class="fa-solid fa-xmark me-2"></i>

                        Tolak UMKM

                    </button>


                    {{-- FORM PENOLAKAN --}}
                    <div class="collapse mt-3" id="formTolak">

                        <div class="reject-panel p-3">

                            <form
                                action="{{ route('admin.verifikasi.tolak', $umkm->id) }}"
                                method="POST"
                            >

                                @csrf
                                @method('PUT')


                                <label class="form-label fw-semibold text-dark">

                                    <i class="fa-solid
                                              fa-comment-dots
                                              text-danger
                                              me-2">
                                    </i>

                                    Alasan Penolakan

                                </label>


                                <textarea
                                    name="rejection_reason"
                                    class="form-control
                                           border-0
                                           shadow-sm
                                           rounded-3"
                                    rows="4"
                                    placeholder="Tuliskan alasan penolakan UMKM..."
                                    required
                                >{{ old('rejection_reason') }}</textarea>


                                @error('rejection_reason')

                                    <div class="text-danger small mt-2">

                                        <i class="fa-solid
                                                  fa-circle-exclamation
                                                  me-1">
                                        </i>

                                        {{ $message }}

                                    </div>

                                @enderror


                                <button class="btn btn-danger
                                               action-btn
                                               mt-3">

                                    <i class="fa-solid
                                              fa-paper-plane
                                              me-2">
                                    </i>

                                    Kirim Penolakan

                                </button>

                            </form>

                        </div>

                    </div>

                @endif

            </div>


        </div>

    </div>

</div>

@endsection
