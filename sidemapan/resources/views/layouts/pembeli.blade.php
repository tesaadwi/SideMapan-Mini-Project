<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SideMapan') - SideMapan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #334155;
        }

        /* SIDEBAR */
        .buyer-sidebar {
            width: 245px;
            flex-shrink: 0;
        }

        /* MENU */
        .buyer-menu {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #475569;
            transition: all .2s ease;
        }

        .buyer-menu:hover {
            background: #ecfdf5;
            color: #166534;
        }

        .buyer-menu.active {
            background: #166534;
            color: white;
            box-shadow: 0 3px 8px rgba(22, 101, 52, .15);
        }

        .buyer-menu i {
            width: 19px;
            text-align: center;
            font-size: 15px;
        }

        /* CARD MARKETPLACE */
        .market-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            transition: .2s;
        }

        .market-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 23, 42, .07);
            border-color: #bbf7d0;
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        ::-webkit-scrollbar-thumb {
            background: #bbf7d0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #86efac;
        }

        /* MOBILE */
        @media(max-width: 768px) {

            .buyer-sidebar {
                width: 76px;
            }

            .buyer-sidebar .menu-label,
            .buyer-sidebar .sidebar-brand {
                display: none;
            }

            .buyer-menu {
                justify-content: center;
                padding: 13px 8px;
            }

            .buyer-menu i {
                font-size: 16px;
            }
        }

        @media(max-width: 480px) {

            .buyer-sidebar {
                display: none;
            }
        }
    </style>

    @stack('styles')

</head>

<body>

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="buyer-sidebar bg-white border-r border-slate-200
                  min-h-screen flex flex-col">

        {{-- LOGO --}}
        <a href="{{ route('pembeli.dashboard') }}"
           class="h-18 flex items-center px-5 py-4
                  border-b border-slate-100">

            <div class="w-10 h-10 rounded-xl bg-green-100
                        text-green-800 flex items-center justify-center">

                <i class="fa-solid fa-house text-base"></i>

            </div>

            <span class="sidebar-brand font-bold text-xl ml-3 text-slate-800">
                SideMapan
            </span>

        </a>

        {{-- MENU --}}
        <nav class="flex-1 p-3 space-y-1">

            <p class="menu-label text-[11px] uppercase tracking-wider
                      text-slate-400 font-bold px-3 pt-4 pb-3">
                Menu Utama
            </p>

            {{-- BERANDA --}}
            <a href="{{ route('pembeli.dashboard') }}"
               class="buyer-menu
               {{ request()->routeIs('pembeli.dashboard') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

                <span class="menu-label">
                    Beranda
                </span>

            </a>

            {{-- PESANAN --}}
            @if (Route::has('pembeli.orders.index'))

                <a href="{{ route('pembeli.orders.index') }}"
                   class="buyer-menu
                   {{ request()->routeIs('pembeli.orders.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-receipt"></i>

                    <span class="menu-label">
                        Pesanan Saya
                    </span>

                </a>

            @endif

            {{-- KERANJANG --}}
            @if (Route::has('pembeli.cart.index'))

                <a href="{{ route('pembeli.cart.index') }}"
                   class="buyer-menu
                   {{ request()->routeIs('pembeli.cart.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <span class="menu-label">
                        Keranjang
                    </span>

                </a>

            @endif

            {{-- ASPIRASI --}}
            @if (Route::has('pembeli.aspirasi.index'))

                <a href="{{ route('pembeli.aspirasi.index') }}"
                   class="buyer-menu
                   {{ request()->routeIs('pembeli.aspirasi.*') ? 'active' : '' }}">

                    <i class="fa-solid fa-comments"></i>

                    <span class="menu-label">
                        Aspirasi
                    </span>

                </a>

            @endif

        </nav>

        {{-- USER / LOGOUT --}}
        <div class="p-3 border-t border-slate-100">

            @auth

                <div class="menu-label flex items-center gap-3 mb-3 px-2">

                    <div class="w-9 h-9 rounded-full bg-green-100
                                text-green-800 flex items-center justify-center">

                        <i class="fa-solid fa-user text-sm"></i>

                    </div>

                    <div class="min-w-0">

                        <p class="text-sm font-semibold text-slate-700 truncate">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Pembeli
                        </p>

                    </div>

                </div>

                @if (Route::has('logout'))

                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button type="submit"
                                class="w-full flex items-center justify-center
                                       gap-2 bg-red-50 hover:bg-red-100
                                       text-red-600 text-sm font-semibold
                                       py-2.5 rounded-lg transition">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            <span class="menu-label">
                                Logout
                            </span>

                        </button>

                    </form>

                @endif

            @else

                <a href="{{ Route::has('login') ? route('login') : url('/login') }}"
                   class="flex items-center justify-center gap-2
                          bg-green-800 hover:bg-green-900 text-white
                          text-sm font-semibold py-2.5 rounded-lg transition">

                    <i class="fa-solid fa-user"></i>

                    <span class="menu-label">
                        Login / Daftar
                    </span>

                </a>

            @endauth

        </div>

    </aside>

    {{-- MAIN --}}
    <div class="flex-1 min-w-0">

        {{-- HEADER --}}
        <header class="min-h-20 bg-white border-b border-slate-200
                       flex items-center justify-between
                       px-4 md:px-7 gap-5">

            {{-- SEARCH --}}
            <form action="{{ route('pembeli.dashboard') }}"
                  method="GET"
                  class="relative flex-1 max-w-2xl">

                <i class="fa-solid fa-magnifying-glass absolute
                          left-4 top-1/2 -translate-y-1/2
                          text-slate-400 text-sm"></i>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk, UMKM, atau kategori..."
                    class="w-full bg-slate-50 border border-slate-200
                           rounded-xl py-3 pl-11 pr-4
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           focus:outline-none
                           focus:ring-2 focus:ring-green-200
                           focus:border-green-500
                           focus:bg-white transition"
                >

            </form>

            {{-- CART + PROFILE --}}
            <div class="flex items-center gap-5">

                {{-- KERANJANG --}}
                @if (Route::has('pembeli.cart.index'))

                    <a href="{{ route('pembeli.cart.index') }}"
                       class="relative flex h-10 w-10 items-center
                              justify-center rounded-xl
                              text-slate-600
                              hover:bg-green-50
                              hover:text-green-800
                              transition"
                       aria-label="Keranjang">

                        <i class="fa-solid fa-cart-shopping text-lg"></i>

                        @auth

                            @php
                                $cartCount = \App\Models\Cart::where(
                                    'user_id',
                                    auth()->id()
                                )->sum('quantity');
                            @endphp

                            @if ($cartCount > 0)

                                <span class="absolute -top-1 -right-1
                                             bg-red-500 text-white
                                             text-[10px] font-bold
                                             rounded-full min-w-5 h-5 px-1
                                             flex items-center justify-center
                                             border-2 border-white">

                                    {{ $cartCount }}

                                </span>

                            @endif

                        @endauth

                    </a>

                @endif

                {{-- PEMBATAS --}}
                @auth
                    <div class="hidden sm:block h-8 w-px bg-slate-200"></div>
                @endauth

                {{-- PROFIL --}}
                @auth

                    <div class="hidden sm:flex items-center gap-3">

                        <div class="w-10 h-10 rounded-full
                                    bg-green-100 text-green-800
                                    flex items-center justify-center">

                            <i class="fa-solid fa-user"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Akun Pembeli
                            </p>

                        </div>

                    </div>

                @else

                    <a href="{{ Route::has('login') ? route('login') : url('/login') }}"
                       class="hidden sm:inline-flex items-center gap-2
                              rounded-lg bg-green-800 px-4 py-2.5
                              text-sm font-semibold text-white
                              hover:bg-green-900 transition">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        Masuk

                    </a>

                @endauth

            </div>

        </header>

        {{-- CONTENT --}}
        <main class="p-5 md:p-7">

            {{-- SUCCESS --}}
            @if (session('success'))

                <div class="mb-5 flex items-center gap-3
                            rounded-xl border border-green-200
                            bg-green-50 px-4 py-3
                            text-sm text-green-800">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif

            {{-- ERROR --}}
            @if (session('error'))

                <div class="mb-5 flex items-center gap-3
                            rounded-xl border border-red-200
                            bg-red-50 px-4 py-3
                            text-sm text-red-700">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif

            @yield('content')

        </main>

    </div>

</div>

@stack('scripts')

</body>

</html>
