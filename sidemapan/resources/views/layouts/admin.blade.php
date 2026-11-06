
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin SideMapan') - SideMapan</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        * {
            box-sizing: border-box;
        }

        /* =====================================================
           GLOBAL
        ===================================================== */

        :root {
            --green-primary: #198754;
            --green-dark: #105c3b;
            --green-deep: #0b3d2a;
            --green-pastel: #eaf7ef;
            --green-sage: #a8d5b5;
            --green-border: #d7eadc;
            --green-hover: #f0f8f2;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f8f4;
            color: #334b3d;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .admin-sidebar {
            background: linear-gradient(
                180deg,
                #ffffff 0%,
                #f7fbf8 100%
            );
            border-right: 1px solid var(--green-border);
        }

        .admin-logo {
            border-bottom: 1px solid var(--green-border);
        }

        .admin-profile {
            border-bottom: 1px solid var(--green-border);
        }

        /* =====================================================
           MENU
        ===================================================== */

        .admin-menu {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #475f50;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all .2s ease;
        }

        .admin-menu:hover {
            background: #eaf7ef;
            color: var(--green-dark);
        }

        .admin-menu.active {
            background: linear-gradient(
                135deg,
                #198754 0%,
                #105c3b 100%
            );
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(16, 92, 59, .18);
        }

        .admin-menu i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 15px;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .content-scroll {
            min-width: 0;
            background: #f3f8f4;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .admin-header {
            background: rgba(255, 255, 255, .96);
            border-bottom: 1px solid var(--green-border);
            box-shadow: 0 2px 8px rgba(16, 92, 59, .025);
        }

        .notification-button {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: .2s ease;
        }

        .notification-button:hover {
            background: #eaf7ef;
            color: var(--green-dark);
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(
                135deg,
                #d9f0df,
                #a8d5b5
            );
            color: #105c3b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* =====================================================
           LOGOUT
        ===================================================== */

        .logout-area {
            border-top: 1px solid var(--green-border);
        }

        .logout-button:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 768px) {

            .admin-sidebar {
                width: 250px;
                position: fixed;
                z-index: 50;
                left: -260px;
                top: 0;
                bottom: 0;
                transition: left .3s ease;
                box-shadow: 10px 0 30px rgba(11, 61, 42, .15);
            }

            .admin-sidebar.open {
                left: 0;
            }

        }

    </style>

    @stack('styles')

</head>

<body>

<div class="min-h-screen flex">

    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}

    <aside id="adminSidebar"
           class="admin-sidebar w-60 shrink-0 min-h-screen flex flex-col">

        {{-- =================================================
            LOGO
        ================================================== --}}

        <div class="admin-logo h-20 flex items-center px-5">

            <div class="w-10 h-10 rounded-xl
                        bg-green-800 text-white
                        flex items-center justify-center
                        shadow-sm">

                <i class="fa-solid fa-house"></i>

            </div>

            <div class="ml-3">

                <span class="font-bold text-xl text-green-950 block">
                    SideMapan
                </span>

                <span class="text-xs text-slate-500">
                    Admin Panel
                </span>

            </div>

        </div>

        {{-- =================================================
            PROFIL ADMIN
        ================================================== --}}

        <div class="admin-profile px-5 py-5">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-green-100 text-green-800
                            flex items-center justify-center">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-semibold
                              text-slate-800 truncate">

                        {{ auth()->user()->name ?? 'Admin Desa' }}

                    </p>

                    <div class="flex items-center gap-1.5 mt-1">

                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                        <p class="text-xs text-slate-500">
                            Administrator
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- =================================================
            MENU
        ================================================== --}}

        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">

            <p class="px-3 mb-3 text-[11px]
                      font-bold uppercase tracking-wider
                      text-green-800">

                Menu Utama

            </p>

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}"
               class="admin-menu
               {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

                <span>
                    Dashboard
                </span>

            </a>

            {{-- UMKM --}}
            <a href="{{ route('admin.verifikasi.index') }}"
               class="admin-menu
               {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}">

                <i class="fa-solid fa-store"></i>

                <span>
                    UMKM
                </span>

            </a>

            {{-- PRODUK --}}
            <a href="{{ route('admin.products.index') }}"
               class="admin-menu
               {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

                <i class="fa-solid fa-box"></i>

                <span>
                    Produk
                </span>

            </a>

            {{-- PESANAN --}}
            <a href="{{ route('admin.orders.index') }}"
               class="admin-menu
               {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

                <i class="fa-solid fa-receipt"></i>

                <span>
                    Pesanan
                </span>

            </a>

            {{-- KATEGORI --}}
            <a href="{{ route('admin.kategori.index') }}"
               class="admin-menu
               {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">

                <i class="fa-solid fa-tags"></i>

                <span>
                    Kategori
                </span>

            </a>

            {{-- LAPORAN PENJUALAN --}}
            <a href="{{ route('admin.laporan.index') }}"
               class="admin-menu
               {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">

                <i class="fa-solid fa-chart-line"></i>

                <span>
                    Laporan Penjualan
                </span>

            </a>

                        {{-- ASPIRASI --}}
            <a href="{{ route('admin.aspirasi.index') }}"
               class="admin-menu
               {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">

                <i class="fa-solid fa-comments"></i>

                <span>
                    Aspirasi
                </span>

            </a>

        </nav>

        {{-- =================================================
            LOGOUT
        ================================================== --}}

        <div class="logout-area p-3">

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="admin-menu logout-button w-full">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </aside>

    {{-- =====================================================
        MAIN CONTENT
    ====================================================== --}}

    <div class="flex-1 min-w-0 content-scroll">

        {{-- =================================================
            HEADER
        ================================================== --}}

        <header class="admin-header h-20
                       flex items-center
                       justify-between px-5 md:px-7">

            {{-- HEADER KIRI --}}
            <div class="flex items-center gap-4">

                {{-- MOBILE BUTTON --}}
                <button id="adminMenuButton"
                        type="button"
                        class="md:hidden
                               w-10 h-10
                               rounded-lg
                               text-green-800
                               hover:bg-green-50
                               transition">

                    <i class="fa-solid fa-bars"></i>

                </button>

                <div>

                    <span class="font-semibold text-base text-green-950">
                        SideMapan
                    </span>

                    <p class="hidden sm:block
                              text-xs text-slate-500
                              mt-0.5">

                        Sistem Informasi Desa

                    </p>

                </div>

            </div>

            {{-- HEADER KANAN --}}
            <div class="flex items-center gap-4">

                {{-- PROFILE --}}
                <div class="flex items-center gap-3
                            pl-4 border-l border-green-100">

                    <div class="admin-avatar">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div class="hidden sm:block">

                        <span class="text-sm
                                     font-semibold
                                     text-slate-800 block">

                            {{ auth()->user()->name ?? 'Admin Desa' }}

                        </span>

                        <span class="text-xs text-slate-500">
                            Administrator
                        </span>

                    </div>

                </div>

            </div>

        </header>

        {{-- =================================================
            HALAMAN
        ================================================== --}}

        <main class="p-5 md:p-7">

            @yield('content')

        </main>

    </div>

</div>

{{-- =========================================================
    MOBILE SIDEBAR SCRIPT
========================================================= --}}

<script>

    const adminMenuButton =
        document.getElementById('adminMenuButton');

    const adminSidebar =
        document.getElementById('adminSidebar');

    if (adminMenuButton && adminSidebar) {

        adminMenuButton.addEventListener('click', function () {

            adminSidebar.classList.toggle('open');

        });

    }

</script>

@stack('scripts')

</body>

</html>
