<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard UMKM') - SideMapan</title>


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

        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #334155;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .umkm-sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
        }


        .umkm-logo {
            border-bottom: 1px solid #e2e8f0;
        }


        .umkm-profile {
            border-bottom: 1px solid #e2e8f0;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .umkm-menu {

            display: flex;

            align-items: center;

            gap: 13px;

            padding: 12px 14px;

            border-radius: 10px;

            color: #475569;

            font-size: 14px;

            font-weight: 500;

            text-decoration: none;

            transition: all .2s ease;

        }


        .umkm-menu:hover {

            background: #ecfdf5;

            color: #047857;

        }


        .umkm-menu.active {

            background: #059669;

            color: white;

            box-shadow: 0 4px 10px rgba(5, 150, 105, .15);

        }


        .umkm-menu i {

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

            background: #f8fafc;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .umkm-header {

            background: #ffffff;

            border-bottom: 1px solid #e2e8f0;

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

            background: #ecfdf5;

            color: #059669;

        }


        .umkm-avatar {

            width: 40px;

            height: 40px;

            border-radius: 10px;

            background: #d1fae5;

            color: #047857;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .logout-area {

            border-top: 1px solid #e2e8f0;

        }


        .logout-button:hover {

            background: #fef2f2;

            color: #dc2626;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .umkm-card {

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 14px;

            box-shadow: 0 2px 6px rgba(15, 23, 42, .04);

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 768px) {

            .umkm-sidebar {

                width: 250px;

                position: fixed;

                z-index: 50;

                left: -260px;

                top: 0;

                bottom: 0;

                transition: left .3s ease;

                box-shadow: 10px 0 30px rgba(15, 23, 42, .15);

            }


            .umkm-sidebar.open {

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

    <aside id="umkmSidebar"
           class="umkm-sidebar w-60 shrink-0 min-h-screen
                  flex flex-col">


        {{-- =================================================
            LOGO
        ================================================== --}}

        <div class="umkm-logo h-20 flex items-center px-5">

            <div class="w-10 h-10 rounded-xl
                        bg-emerald-600 text-white
                        flex items-center justify-center">

                <i class="fa-solid fa-store"></i>

            </div>


            <div class="ml-3">

                <span class="font-bold text-xl text-slate-800 block">
                    SideMapan
                </span>

                <span class="text-xs text-slate-400">
                    Panel UMKM
                </span>

            </div>

        </div>


        {{-- =================================================
            PROFIL TOKO
        ================================================== --}}

        <div class="umkm-profile px-5 py-5">

            <div class="flex items-center gap-3">


                <div class="w-10 h-10 rounded-xl
                            bg-emerald-50
                            text-emerald-600
                            flex items-center justify-center">

                    <i class="fa-solid fa-store"></i>

                </div>


                <div class="min-w-0">

                    <p class="text-sm font-semibold
                              text-slate-700 truncate">

                        {{ auth()->user()->umkm->name ?? 'Toko UMKM' }}

                    </p>


                    <div class="flex items-center gap-1.5 mt-1">

                        <span class="w-2 h-2 rounded-full
                                     bg-emerald-500">
                        </span>

                        <p class="text-xs text-slate-400">
                            Pelaku UMKM
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            MENU SIDEBAR
        ================================================== --}}

        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">


            <p class="px-3 mb-3 text-[11px]
                      font-bold uppercase tracking-wider
                      text-slate-400">

                Menu Utama

            </p>


            {{-- DASHBOARD --}}
            <a href="{{ route('umkm.dashboard') }}"
               class="umkm-menu
               {{ request()->routeIs('umkm.dashboard') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- PRODUK --}}
            <a href="{{ route('umkm.products.index') }}"
               class="umkm-menu
               {{ request()->routeIs('umkm.products.*') ? 'active' : '' }}">

                <i class="fa-solid fa-box"></i>

                <span>
                    Produk
                </span>

            </a>


            {{-- PESANAN --}}
            <a href="{{ route('umkm.orders.index') }}"
               class="umkm-menu
               {{ request()->routeIs('umkm.orders.*') ? 'active' : '' }}">

                <i class="fa-solid fa-receipt"></i>

                <span>
                    Pesanan
                </span>

            </a>



            {{-- LAPORAN PENJUALAN --}}
            <a href="{{ route('umkm.laporan.index') }}"
               class="umkm-menu
               {{ request()->routeIs('umkm.laporan.*') ? 'active' : '' }}">

                <i class="fa-solid fa-chart-line"></i>

                <span>
                    Laporan Penjualan
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
                        class="umkm-menu logout-button w-full">

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

        <header class="umkm-header h-20
                       flex items-center
                       justify-between px-5 md:px-7">


            {{-- HEADER KIRI --}}
            <div class="flex items-center gap-4">


                {{-- MOBILE MENU --}}
                <button id="umkmMenuButton"
                        type="button"
                        class="md:hidden
                               w-10 h-10
                               rounded-lg
                               text-slate-600
                               hover:bg-slate-100
                               transition">

                    <i class="fa-solid fa-bars"></i>

                </button>


                <div>

                    <span class="font-semibold text-base
                                 text-slate-800">

                        SideMapan

                    </span>


                    <p class="hidden sm:block
                              text-xs text-slate-400
                              mt-0.5">

                        Kelola usaha dan produk UMKM

                    </p>

                </div>

            </div>


            {{-- HEADER KANAN --}}
            <div class="flex items-center gap-4">


                

                </button>


                {{-- PROFILE --}}
                <div class="flex items-center gap-3
                            pl-4 border-l border-slate-200">


                    <div class="umkm-avatar">

                        <i class="fa-solid fa-store"></i>

                    </div>


                    <div class="hidden sm:block">

                        <span class="text-sm
                                     font-semibold
                                     text-slate-700 block">

                            {{ auth()->user()->umkm->name ?? 'Toko UMKM' }}

                        </span>


                        <span class="text-xs text-slate-400">

                            Pelaku UMKM

                        </span>

                    </div>

                </div>

            </div>

        </header>


        {{-- =================================================
            KONTEN HALAMAN
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

    const umkmMenuButton =
        document.getElementById('umkmMenuButton');

    const umkmSidebar =
        document.getElementById('umkmSidebar');


    if (umkmMenuButton && umkmSidebar) {

        umkmMenuButton.addEventListener('click', function () {

            umkmSidebar.classList.toggle('open');

        });

    }

</script>


@stack('scripts')


</body>

</html>