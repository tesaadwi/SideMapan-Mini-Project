<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SideMapan - Desa Gilang</title>
    <meta name="description" content="SideMapan, platform digital untuk mengenal potensi Desa Gilang, kegiatan masyarakat, dan UMKM lokal.">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --green-primary: #198754;
            --green-dark: #105c3b;
            --green-deep: #0b3d2a;
            --green-light: #eaf7ef;
            --green-soft: #f4fbf6;
            --text-dark: #18352a;
            --text-muted: #6b7c72;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            background: #f8fbf9;
            color: var(--text-dark);
            font-family: "Segoe UI", Arial, sans-serif;
            overflow-x: hidden;
        }

        a {
            transition: all .25s ease;
        }

        section {
            scroll-margin-top: 85px;
        }

        /* NAVBAR */
        .navbar {
            min-height: 76px;
            background: rgba(255,255,255,.97);
            backdrop-filter: blur(12px);
        }

        .navbar-brand {
            font-size: 1.55rem;
            font-weight: 850;
            letter-spacing: -.6px;
            color: var(--green-primary) !important;
        }

        .navbar-brand span {
            color: var(--text-dark);
        }

        .brand-icon {
            display: inline-flex;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            border-radius: 13px;
            background: linear-gradient(135deg, #198754, #42b878);
            color: white;
            box-shadow: 0 5px 14px rgba(25,135,84,.2);
        }

        .nav-link {
            color: #52675b !important;
            font-weight: 600;
            margin: 0 4px;
            padding: 10px 12px !important;
            border-radius: 9px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--green-primary) !important;
            background: var(--green-light);
        }

        .btn-green {
            background: var(--green-primary);
            border: 1px solid var(--green-primary);
            color: white;
            border-radius: 10px;
            padding: 11px 21px;
            font-weight: 700;
            transition: all .25s ease;
        }

        .btn-green:hover {
            background: var(--green-dark);
            border-color: var(--green-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(25,135,84,.2);
        }

        .btn-outline-green {
            border: 1px solid var(--green-primary);
            color: var(--green-primary);
            background: white;
            border-radius: 10px;
            padding: 11px 21px;
            font-weight: 700;
        }

        .btn-outline-green:hover {
            background: var(--green-primary);
            color: white;
        }

        /* HERO */
        .hero {
            position: relative;
            isolation: isolate;
            min-height: 650px;
            display: flex;
            align-items: center;
            padding: 95px 0;
            color: white;
            background:
                linear-gradient(110deg, rgba(5,47,30,.91), rgba(12,89,53,.73), rgba(9,54,36,.48)),
                url('{{ asset('images/kantor-desa-gilang.web') }}');
            background-size: cover;
            background-position: center 65%;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            z-index: -1;
            width: 420px;
            height: 420px;
            top: -180px;
            right: -80px;
            border-radius: 50%;
            background: rgba(105,210,145,.12);
            filter: blur(2px);
        }

        .hero::after {
            content: "";
            position: absolute;
            z-index: -1;
            width: 350px;
            height: 350px;
            bottom: -220px;
            left: 25%;
            border-radius: 50%;
            background: rgba(105,210,145,.13);
        }

        .hero-content {
            max-width: 790px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 10px 16px;
            border: 1px solid rgba(255,255,255,.25);
            background: rgba(255,255,255,.12);
            border-radius: 50px;
            font-size: .92rem;
            font-weight: 600;
            margin-bottom: 25px;
            backdrop-filter: blur(8px);
        }

        .hero h1 {
            font-size: clamp(2.6rem, 5vw, 4.25rem);
            font-weight: 850;
            line-height: 1.12;
            letter-spacing: -1.5px;
            margin-bottom: 23px;
        }

        .hero h1 span {
            color: #a9f0c2;
        }

        .hero p {
            color: rgba(255,255,255,.88);
            max-width: 650px;
            font-size: 1.12rem;
            line-height: 1.85;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 13px;
            flex-wrap: wrap;
        }

        .hero .btn {
            padding: 13px 23px;
            border-radius: 11px;
            font-weight: 700;
        }

        .hero .btn-light {
            color: var(--green-dark);
        }

        .hero .btn-light:hover {
            background: #dff6e7;
            transform: translateY(-2px);
        }

        .hero .btn-outline-light:hover {
            color: var(--green-dark);
        }

        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 35px;
            margin-top: 43px;
            padding-top: 26px;
            border-top: 1px solid rgba(255,255,255,.24);
        }

        .hero-stat strong {
            display: block;
            font-size: 1.65rem;
            font-weight: 850;
            color: #c1f5d2;
        }

        .hero-stat span {
            font-size: .9rem;
            color: rgba(255,255,255,.8);
        }

        /* SECTION GENERAL */
        .section {
            padding: 85px 0;
        }

        .section-heading {
            max-width: 720px;
            margin: 0 auto 48px;
            text-align: center;
        }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--green-primary);
            background: var(--green-light);
            border-radius: 50px;
            padding: 8px 14px;
            font-size: .83rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .7px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.55rem);
            font-weight: 850;
            letter-spacing: -.7px;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .section-subtitle {
            color: var(--text-muted);
            line-height: 1.85;
            margin: 0 auto;
        }

        /* TENTANG DESA */
        .about-section {
            background: var(--green-soft);
        }

        .about-card {
            position: relative;
            background: white;
            border: 1px solid #e5f0e8;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 8px 28px rgba(24,77,47,.045);
            transition: all .25s ease;
        }

        .about-card:hover {
            transform: translateY(-6px);
            border-color: #b9e4c8;
            box-shadow: 0 15px 32px rgba(24,77,47,.09);
        }

        .about-icon,
        .activity-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: var(--green-light);
            color: var(--green-primary);
            font-size: 1.55rem;
            margin-bottom: 21px;
        }

        .about-card h4,
        .activity-card h5 {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 13px;
        }

        .about-card p,
        .activity-card p {
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 0;
        }

        .stat-card {
            height: 100%;
            background: linear-gradient(135deg, #ffffff, #f1faf4);
            border: 1px solid #dcefe2;
            border-radius: 20px;
            padding: 27px 22px;
            text-align: center;
            transition: all .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(25,135,84,.08);
        }

        .stat-card i {
            display: block;
            color: var(--green-primary);
            font-size: 1.8rem;
            margin-bottom: 12px;
        }

        .stat-card strong {
            display: block;
            color: var(--green-dark);
            font-size: 1.9rem;
            font-weight: 850;
            margin-bottom: 6px;
        }

        .stat-card span {
            color: var(--text-muted);
            font-size: .93rem;
        }

        .industry-note {
            padding: 22px 25px;
            background: white;
            border: 1px solid #dcefe2;
            border-left: 5px solid var(--green-primary);
            border-radius: 15px;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .industry-note i {
            color: var(--green-primary);
            font-size: 1.3rem;
        }

        /* KEGIATAN DESA */
        .activity-card {
            height: 100%;
            background: white;
            border: 1px solid #e7efe9;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 7px 24px rgba(24,77,47,.045);
            transition: all .25s ease;
        }

        .activity-card:hover {
            transform: translateY(-6px);
            border-color: #b9e4c8;
            box-shadow: 0 15px 30px rgba(24,77,47,.09);
        }

        /* VIDEO PROFIL */
        .profile-section {
            background: white;
        }

        .profile-card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #104c32, #198754);
            border-radius: 25px;
            padding: 43px;
            color: white;
            box-shadow: 0 15px 35px rgba(16,92,59,.16);
        }

        .profile-card::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -80px;
            top: -120px;
            border: 35px solid rgba(255,255,255,.07);
            border-radius: 50%;
            pointer-events: none;
        }

        .profile-card h3 {
            font-weight: 850;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .profile-card p {
            color: rgba(255,255,255,.84);
            line-height: 1.8;
            max-width: 650px;
        }

        .profile-card .btn {
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 700;
        }

        /* UMKM */
        .umkm-card {
            height: 100%;
            overflow: hidden;
            background: white;
            border: 1px solid #e7efe9;
            border-radius: 19px;
            box-shadow: 0 7px 24px rgba(24,77,47,.05);
            transition: all .25s ease;
        }

        .umkm-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px rgba(24,77,47,.1);
        }

        .umkm-image,
        .umkm-placeholder {
            width: 100%;
            height: 205px;
        }

        .umkm-image {
            object-fit: cover;
            transition: transform .35s ease;
        }

        .umkm-card:hover .umkm-image {
            transform: scale(1.035);
        }

        .umkm-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e6f5eb, #f5fbf6);
            color: #69a881;
            font-size: 3rem;
        }

        .umkm-card-body {
            padding: 25px;
        }

        .umkm-card h5 {
            font-size: 1.13rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .umkm-description {
            min-height: 52px;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 17px;
        }

        .umkm-location {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: var(--text-muted);
            font-size: .9rem;
            line-height: 1.6;
        }

        .umkm-location i {
            color: var(--green-primary);
        }

        .umkm-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--green-light);
            color: var(--green-dark);
            font-size: .78rem;
            font-weight: 800;
            border-radius: 50px;
            padding: 6px 10px;
            margin-bottom: 13px;
        }

        /* CTA */
        .cta {
            position: relative;
            overflow: hidden;
            padding: 78px 0;
            background: linear-gradient(120deg, #0d5b38, #198754, #239b60);
            color: white;
        }

        .cta::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,.06);
            top: -150px;
            left: -80px;
        }

        .cta h2 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 850;
            margin-bottom: 17px;
        }

        .cta p {
            max-width: 680px;
            margin: 0 auto 28px;
            color: rgba(255,255,255,.86);
            line-height: 1.8;
        }

        .cta .btn {
            border-radius: 10px;
            padding: 12px 23px;
            font-weight: 700;
        }

        /* FOOTER */
        footer {
            background: #102d20;
            color: white;
            padding: 58px 0 25px;
        }

        .footer-brand {
            font-size: 1.6rem;
            font-weight: 850;
            margin-bottom: 14px;
        }

        .footer-brand span {
            color: #a8e8bd;
        }

        .footer-text {
            color: rgba(255,255,255,.68);
            line-height: 1.85;
        }

        .footer-title {
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: #c0f1d0;
        }

        .footer-link {
            display: inline-flex;
            align-items: flex-start;
            gap: 9px;
            color: rgba(255,255,255,.7);
            text-decoration: none;
            line-height: 1.75;
        }

        .footer-link:hover {
            color: white;
            padding-left: 3px;
        }

        .footer-link i {
            margin-top: 4px;
            color: #8cdbab;
        }

        .footer-contact {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-bottom: 16px;
            color: rgba(255,255,255,.72);
            line-height: 1.75;
        }

        .footer-contact i {
            margin-top: 4px;
            color: #8cdbab;
            font-size: 1.05rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.12);
            margin-top: 38px;
            padding-top: 23px;
            color: rgba(255,255,255,.53);
            font-size: .88rem;
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero {
                min-height: 590px;
                padding: 75px 0;
                background-position: center;
            }

            .hero h1 {
                font-size: 2.65rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-buttons .btn {
                width: 100%;
            }

            .hero-stats {
                gap: 20px;
            }

            .hero-stat strong {
                font-size: 1.35rem;
            }

            .section {
                padding: 62px 0;
            }

            .profile-card {
                padding: 30px 24px;
            }

            .profile-card h3 {
                font-size: 1.5rem;
            }

            .about-card,
            .activity-card {
                padding: 25px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="brand-icon">
                <i class="bi bi-buildings-fill"></i>
            </span>
            Side<span>Mapan</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Buka navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-lg-4 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang Desa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kegiatan">Kegiatan Desa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#umkm">UMKM Desa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>
            </ul>

            <div class="d-flex gap-2 mt-3 mt-lg-0">
                <a href="{{ route('login') }}" class="btn btn-outline-green">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-green">
                    <i class="bi bi-person-plus me-1"></i> Daftar
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="hero-content">

            <div class="hero-badge">
                <i class="bi bi-geo-alt-fill"></i>
                Desa Gilang, Kecamatan Taman, Sidoarjo
            </div>

            <h1>
                Selamat Datang di
                <span>SideMapan</span>
            </h1>

            <p>
                Platform digital Desa Gilang untuk mengenal potensi desa,
                memperoleh informasi masyarakat, serta menemukan berbagai
                produk UMKM lokal dalam satu tempat.
            </p>

            <div class="hero-buttons">
                <a href="#umkm" class="btn btn-light">
                    <i class="bi bi-shop me-2"></i>
                    Jelajahi UMKM Desa
                </a>

                <a
                    href="https://youtu.be/mrX5ezlgm6I?si=Kp2PDvouNszHow6a"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-outline-light"
                >
                    <i class="bi bi-play-circle me-2"></i>
                    Profil Desa Gilang
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <strong>±5.950</strong>
                    <span>Jiwa Penduduk</span>
                </div>

                <div class="hero-stat">
                    <strong>107,98 Ha</strong>
                    <span>Luas Wilayah</span>
                </div>

                <div class="hero-stat">
                    <strong>Potensial</strong>
                    <span>UMKM dan Industri</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- TENTANG DESA --}}
<section id="tentang" class="section about-section">
    <div class="container">

        <div class="section-heading">
            <div class="section-eyebrow">
                <i class="bi bi-buildings"></i>
                Profil Wilayah
            </div>

            <h2 class="section-title">Mengenal Desa Gilang</h2>

            <p class="section-subtitle">
                Desa Gilang merupakan bagian dari Kecamatan Taman,
                Kabupaten Sidoarjo, Jawa Timur. Desa ini memiliki
                masyarakat yang beragam serta potensi ekonomi yang
                dapat terus dikembangkan.
            </p>
        </div>

        {{-- Statistik desa --}}
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-people-fill"></i>
                    <strong>±5.950</strong>
                    <span>Jumlah Penduduk</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-map-fill"></i>
                    <strong>107,98 Ha</strong>
                    <span>Luas Wilayah</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-buildings-fill"></i>
                    <strong>Industri</strong>
                    <span>Potensi Perusahaan dan Usaha</span>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <h4>Lokasi Strategis</h4>

                    <p>
                        Berada di Kecamatan Taman, Kabupaten Sidoarjo,
                        Jawa Timur, dengan akses menuju berbagai fasilitas
                        dan kawasan kegiatan ekonomi.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-buildings-fill"></i>
                    </div>

                    <h4>Potensi Industri</h4>

                    <p>
                        Desa Gilang memiliki banyak perusahaan besar di
                        kawasan sekitarnya. Keberadaan sektor industri
                        menjadi salah satu potensi ekonomi wilayah.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="bi bi-shop-window"></i>
                    </div>

                    <h4>Pemberdayaan UMKM</h4>

                    <p>
                        SideMapan membantu memperkenalkan pelaku usaha
                        lokal agar informasi produk dan potensi UMKM
                        Desa Gilang lebih mudah dijangkau masyarakat.
                    </p>
                </div>
            </div>
        </div>

        <div class="industry-note mt-4">
            <div class="d-flex gap-3 align-items-start">
                <i class="bi bi-info-circle-fill"></i>
                <div>
                    <strong class="d-block mb-1">Potensi Desa Gilang</strong>
                    Desa Gilang memiliki potensi dari sektor industri dan
                    usaha lokal. Melalui digitalisasi, informasi mengenai
                    UMKM diharapkan lebih mudah ditemukan oleh masyarakat.
                </div>
            </div>
        </div>

    </div>
</section>

{{-- KEGIATAN DESA --}}
<section id="kegiatan" class="section">
    <div class="container">

        <div class="section-heading">
            <div class="section-eyebrow">
                <i class="bi bi-calendar-event"></i>
                Aktivitas Desa
            </div>

            <h2 class="section-title">Kegiatan dan Informasi Desa</h2>

            <p class="section-subtitle">
                Ruang untuk mengenal aktivitas masyarakat, informasi
                desa, dan potensi yang ada di lingkungan Desa Gilang.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="bi bi-calendar2-check"></i>
                    </div>

                    <h5>Kegiatan Masyarakat</h5>

                    <p>
                        Informasi mengenai aktivitas dan kegiatan masyarakat
                        yang mendukung kehidupan sosial di Desa Gilang.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>

                    <h5>Informasi Desa</h5>

                    <p>
                        Sarana untuk membantu masyarakat memperoleh
                        informasi dan mengenal berbagai potensi wilayah desa.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="bi bi-chat-square-text-fill"></i>
                    </div>

                    <h5>Aspirasi Warga</h5>

                    <p>
                        Warga yang telah memiliki akun dapat menggunakan
                        fitur SideMapan untuk menyampaikan aspirasi dan
                        pengaduan sesuai fitur yang tersedia.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- VIDEO PROFIL DESA --}}
<section class="section profile-section">
    <div class="container">
        <div class="profile-card">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div class="section-eyebrow bg-white text-success">
                        <i class="bi bi-play-circle-fill"></i>
                        Video Profil
                    </div>

                    <h3>Kenali Desa Gilang Lebih Dekat</h3>

                    <p class="mb-lg-0">
                        Saksikan video profil Desa Gilang untuk mengenal
                        desa, lingkungan, dan potensi yang dimilikinya.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <a
                        href="https://youtu.be/mrX5ezlgm6I?si=Kp2PDvouNszHow6a"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-light"
                    >
                        <i class="bi bi-youtube me-2"></i>
                        Tonton Profil Desa
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- UMKM DESA --}}
<section id="umkm" class="section about-section">
    <div class="container">

        <div class="section-heading">
            <div class="section-eyebrow">
                <i class="bi bi-shop"></i>
                Ekonomi Lokal
            </div>

            <h2 class="section-title">UMKM Desa Gilang</h2>

            <p class="section-subtitle">
                Kenali pelaku usaha lokal dan temukan produk yang
                ditawarkan oleh UMKM Desa Gilang.
            </p>
        </div>

        <div class="row g-4">

            
@forelse ($umkms as $umkm)
    <div class="col-md-6 col-lg-4">
        <div class="umkm-card">

            @if (!empty($umkm['foto']))
                <img
                    src="{{ asset('storage/' . $umkm['foto']) }}"
                    class="umkm-image"
                    alt="{{ $umkm['nama_usaha'] }}"
                    loading="lazy"
                >
            @else
                <div class="umkm-placeholder">
                    <i class="bi bi-shop"></i>
                </div>
            @endif

            <div class="umkm-card-body">
                <div class="umkm-label">
                    <i class="bi bi-patch-check-fill"></i>
                    UMKM Desa
                    @if (($umkm['sumber'] ?? '') === 'postgresql')
                        <span class="ms-1">· API</span>
                    @endif
                </div>

                <h5>{{ $umkm['nama_usaha'] }}</h5>

                <p class="umkm-description">
                    {{ \Illuminate\Support\Str::limit(
                        $umkm['deskripsi'] ?? 'UMKM lokal Desa Gilang.',
                        100
                    ) }}
                </p>

                @if (!empty($umkm['alamat']))
                    <div class="umkm-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ $umkm['alamat'] }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="about-card text-center py-5">
            <div class="about-icon mx-auto">
                <i class="bi bi-shop"></i>
            </div>

            <h4>Belum Ada UMKM Terdaftar</h4>
            <p class="mb-0">
                Data UMKM belum tersedia untuk ditampilkan.
            </p>
        </div>
    </div>
@endforelse


        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta">
    <div class="container text-center">

        <div class="section-eyebrow bg-white text-success">
            <i class="bi bi-heart-fill"></i>
            Dukung Potensi Lokal
        </div>

        <h2>Jelajahi Potensi Desa Gilang</h2>

        <p>
            Mari mengenal UMKM lokal, mendukung usaha masyarakat,
            dan memanfaatkan layanan digital SideMapan untuk
            mendapatkan pengalaman yang lebih mudah dan praktis.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('login') }}" class="btn btn-light">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-outline-light">
                <i class="bi bi-person-plus me-2"></i>
                Daftar Sekarang
            </a>
        </div>

    </div>
</section>

{{-- FOOTER --}}
<footer id="kontak">
    <div class="container">

        <div class="row g-5">

            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <i class="bi bi-buildings-fill me-2"></i>
                    Side<span>Mapan</span>
                </div>

                <p class="footer-text">
                    Platform digital Desa Gilang untuk memperkenalkan
                    potensi desa, mendukung UMKM lokal, dan membantu
                    masyarakat mengakses informasi dalam satu tempat.
                </p>

                <a
                    href="https://youtu.be/mrX5ezlgm6I?si=Kp2PDvouNszHow6a"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-link"
                >
                    <i class="bi bi-play-circle-fill"></i>
                    Tonton Video Profil Desa
                </a>
            </div>

            {{-- Navigasi --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Navigasi</h6>

                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('home') }}" class="footer-link">
                        <i class="bi bi-house-fill"></i>
                        Beranda
                    </a>

                    <a href="#tentang" class="footer-link">
                        <i class="bi bi-buildings"></i>
                        Tentang Desa
                    </a>

                    <a href="#kegiatan" class="footer-link">
                        <i class="bi bi-calendar-event"></i>
                        Kegiatan Desa
                    </a>

                    <a href="#umkm" class="footer-link">
                        <i class="bi bi-shop"></i>
                        UMKM Desa
                    </a>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Kontak Desa</h6>

                <div class="footer-contact">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>
                        Jl. Raya Gilang 05 No.136, Gilang Selatan,
                        Gilang, Kec. Taman, Kabupaten Sidoarjo,
                        Jawa Timur 61257
                    </span>
                </div>

                <div class="footer-contact">
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:0317883846" class="footer-link">
                        031-7883846
                    </a>
                </div>

                <div class="footer-contact">
                    <i class="bi bi-clock-fill"></i>
                    <span>
                        Senin–Jumat<br>
                        08.00–15.30 WIB
                    </span>
                </div>
            </div>

            {{-- Tautan resmi --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Tautan dan Lokasi</h6>

                <div class="d-flex flex-column gap-3">
                    <a
                        href="http://www.sidoarjokab.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-link"
                    >
                        <i class="bi bi-globe"></i>
                        Website Pemkab Sidoarjo
                    </a>

                    <a
                        href="https://maps.app.goo.gl/7ifY6mmz9HbmbDrS7"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-link"
                    >
                        <i class="bi bi-map-fill"></i>
                        Lihat Lokasi di Google Maps
                    </a>

                    <a
                        href="https://youtu.be/mrX5ezlgm6I?si=Kp2PDvouNszHow6a"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-link"
                    >
                        <i class="bi bi-youtube"></i>
                        Video Profil Desa Gilang
                    </a>
                </div>

                <p class="footer-text small mt-3 mb-0">
                    Situs resmi kabupaten:
                    <br>
                    sidoarjokab.go.id
                </p>
            </div>

        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} SideMapan.
            Desa Gilang, Kecamatan Taman, Kabupaten Sidoarjo.
            <br>
            Dikembangkan untuk mendukung informasi desa dan promosi UMKM lokal.
        </div>

    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
