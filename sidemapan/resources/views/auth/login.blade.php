<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SideMapan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --green-primary: #198754;
            --green-dark: #105c3b;
            --green-deep: #0b3d2a;
            --green-light: #eaf7ef;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(25, 135, 84, 0.13),
                    transparent 38%
                ),
                linear-gradient(135deg, #f4fbf6, #eaf7ef);
        }

        .login-card {
            animation: fadeIn 0.6s ease;
        }

        .brand-icon {
            background: linear-gradient(
                135deg,
                var(--green-primary),
                var(--green-dark)
            );
            box-shadow: 0 8px 22px rgba(25, 135, 84, 0.25);
        }

        .input-field {
            transition: all 0.25s ease;
        }

        .input-field:focus {
            border-color: var(--green-primary);
            box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.12);
        }

        .login-button {
            background: linear-gradient(
                135deg,
                var(--green-primary),
                var(--green-dark)
            );
            transition: all 0.25s ease;
        }

        .login-button:hover {
            background: linear-gradient(
                135deg,
                #157347,
                var(--green-deep)
            );
            transform: translateY(-2px);
            box-shadow: 0 9px 20px rgba(16, 92, 59, 0.22);
        }

        .login-button:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

    <!-- Kartu Login -->
    <div class="login-card w-full max-w-lg bg-white rounded-3xl
                shadow-xl border border-green-100 p-8 sm:p-12">

        <!-- Logo dan Judul -->
        <div class="text-center mb-9">

            <div class="brand-icon w-20 h-20 text-white rounded-2xl
                        flex items-center justify-center mx-auto mb-5">
                <span class="text-4xl font-bold">S</span>
            </div>

            <h1 class="text-4xl font-bold text-green-900 tracking-tight">
                SideMapan
            </h1>

            <p class="text-gray-500 mt-3 text-base">
                Masuk ke akun SideMapan kamu
            </p>

            <div class="w-16 h-1 bg-green-600 rounded-full mx-auto mt-5"></div>

        </div>

        <!-- Pesan Berhasil -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700
                        p-4 rounded-xl mb-6 text-sm">
                <div class="flex items-start gap-2">
                    <span class="font-bold">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700
                        p-4 rounded-xl mb-6 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <label for="email"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    required
                    autofocus
                    autocomplete="email"
                    class="input-field w-full border border-gray-300
                           rounded-xl px-5 py-4 text-base text-gray-700
                           placeholder-gray-400 focus:outline-none"
                >
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    autocomplete="current-password"
                    class="input-field w-full border border-gray-300
                           rounded-xl px-5 py-4 text-base text-gray-700
                           placeholder-gray-400 focus:outline-none"
                >
            </div>

            <!-- Ingat Saya -->
            <div class="flex items-center mb-7">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    id="remember"
                    class="w-5 h-5 accent-green-600 rounded cursor-pointer"
                >

                <label for="remember"
                       class="text-base text-gray-600 ml-3 cursor-pointer">
                    Ingat saya
                </label>
            </div>

            <!-- Tombol Login -->
            <button
                type="submit"
                class="login-button w-full text-white font-semibold
                       py-4 text-lg rounded-xl transition duration-300"
            >
                Login
            </button>
        </form>

        <!-- Link Daftar -->
        <p class="text-center text-base text-gray-600 mt-8">
            Belum memiliki akun?

            <a href="{{ route('register') }}"
               class="text-green-700 font-semibold hover:text-green-900
                      hover:underline transition">
                Daftar sekarang
            </a>
        </p>

        <!-- Kembali ke Beranda -->
        <div class="text-center mt-7 pt-6 border-t border-green-100">
            <a href="{{ route('home') }}"
               class="text-sm text-gray-500 hover:text-green-700
                      transition inline-flex items-center gap-2">
                <span>←</span>
                <span>Kembali ke beranda</span>
            </a>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-xs text-gray-400">
                © {{ date('Y') }} SideMapan
            </p>

            <p class="text-xs text-gray-400 mt-1">
                Sistem Informasi Desa Gilang
            </p>
        </div>

    </div>

</body>
</html>
