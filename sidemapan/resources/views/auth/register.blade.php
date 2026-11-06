<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - SideMapan</title>

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

        .register-card {
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
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 15px 18px;
            font-size: 15px;
            color: #374151;
            background: #fff;
            transition: all 0.25s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--green-primary);
            box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.12);
        }

        .input-field::placeholder {
            color: #9ca3af;
        }

        .section-title {
            color: var(--green-dark);
            font-size: 17px;
            font-weight: 700;
        }

        .section-divider {
            height: 1px;
            background: #e5f1e8;
            margin: 24px 0;
        }

        .register-button {
            background: linear-gradient(
                135deg,
                var(--green-primary),
                var(--green-dark)
            );
            transition: all 0.25s ease;
        }

        .register-button:hover {
            background: linear-gradient(
                135deg,
                #157347,
                var(--green-deep)
            );
            transform: translateY(-2px);
            box-shadow: 0 9px 20px rgba(16, 92, 59, 0.22);
        }

        .register-button:active {
            transform: translateY(0);
        }

        #umkm-field {
            background: #f6fbf7;
            border: 1px solid #d9eee0;
            border-radius: 16px;
            padding: 22px;
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

    <div class="register-card w-full max-w-2xl bg-white rounded-3xl
                shadow-xl border border-green-100 p-7 sm:p-10 lg:p-12 my-4">

        <!-- Logo dan Judul -->
        <div class="text-center mb-9">

            <div class="brand-icon w-20 h-20 text-white rounded-2xl
                        flex items-center justify-center mx-auto mb-5">
                <span class="text-4xl font-bold">S</span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold text-green-900">
                Buat Akun SideMapan
            </h1>

            <p class="text-gray-500 mt-3 text-base">
                Bergabung dan dukung UMKM lokal Desa Gilang
            </p>

            <div class="w-16 h-1 bg-green-600 rounded-full mx-auto mt-5"></div>
        </div>

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700
                        p-4 rounded-xl mb-6 text-sm">
                <p class="font-semibold mb-2">
                    Pendaftaran belum berhasil:
                </p>

                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Pendaftaran -->
        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <!-- Informasi Akun -->
            <div class="mb-5">
                <h2 class="section-title">Informasi Akun</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi informasi dasar untuk membuat akun.
                </p>
            </div>

            <!-- Nama Lengkap -->
            <div class="mb-5">
                <label for="name"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Nama Lengkap
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap"
                    class="input-field"
                >
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="nama@email.com"
                    class="input-field"
                >
            </div>

            <!-- Jenis Akun -->
            <div class="mb-5">
                <label for="role"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Jenis Akun
                </label>

                <select
                    name="role"
                    id="role"
                    required
                    class="input-field"
                >
                    <option value="pembeli"
                        {{ old('role', 'pembeli') === 'pembeli' ? 'selected' : '' }}>
                        Pembeli / Masyarakat
                    </option>

                    <option value="umkm"
                        {{ old('role') === 'umkm' ? 'selected' : '' }}>
                        Pelaku UMKM
                    </option>
                </select>
            </div>

            <!-- Informasi UMKM -->
            <div id="umkm-field" class="hidden mt-7">

                <div class="mb-6">
                    <h2 class="section-title">
                        Informasi Pemilik dan Usaha
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Lengkapi informasi berikut agar admin dapat melihat
                        data pemilik dan usaha UMKM saat melakukan verifikasi.
                    </p>
                </div>

                <!-- Nama Toko -->
                <div class="mb-5">
                    <label for="umkm_name"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Toko / Usaha UMKM
                    </label>

                    <input
                        id="umkm_name"
                        type="text"
                        name="umkm_name"
                        value="{{ old('umkm_name') }}"
                        placeholder="Contoh: Keripik Bu Siti"
                        class="input-field"
                    >
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-5">
                    <label for="phone"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Telepon 
                    </label>

                    <input
                        id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Contoh: 081234567890"
                        autocomplete="tel"
                        class="input-field"
                    >
                </div>

                <!-- Alamat -->
                <div class="mb-5">
                    <label for="umkm_address"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Alamat Usaha
                    </label>

                    <textarea
                        id="umkm_address"
                        name="umkm_address"
                        rows="3"
                        placeholder="Masukkan alamat lengkap tempat usaha"
                        class="input-field resize-y"
                    >{{ old('umkm_address') }}</textarea>
                </div>

                <!-- Tentang UMKM -->
                <div class="mb-4">
                    <label for="umkm_description"
                           class="block text-sm font-semibold text-gray-700 mb-2">
                        Tentang UMKM
                    </label>

                    <textarea
                        id="umkm_description"
                        name="umkm_description"
                        rows="4"
                        placeholder="Ceritakan produk, jenis usaha, dan informasi singkat tentang UMKM kamu"
                        class="input-field resize-y"
                    >{{ old('umkm_description') }}</textarea>
                </div>

                <div class="bg-green-100 border border-green-200
                            text-green-800 p-4 rounded-xl text-sm">
                    <p class="font-semibold mb-1">
                        Informasi verifikasi
                    </p>

                    <p>
                        Data usaha akan digunakan untuk proses verifikasi
                        oleh admin. Kamu perlu menunggu persetujuan admin
                        sebelum mulai berjualan.
                    </p>
                </div>

            </div>

            <div class="section-divider"></div>

            <!-- Keamanan Akun -->
            <div class="mb-5">
                <h2 class="section-title">Keamanan Akun</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Buat password untuk melindungi akun kamu.
                </p>
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    class="input-field"
                >
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-7">
                <label for="password_confirmation"
                       class="block text-base font-semibold text-gray-700 mb-3">
                    Konfirmasi Password
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    placeholder="Masukkan kembali password"
                    class="input-field"
                >
            </div>

            <!-- Tombol Daftar -->
            <button
                type="submit"
                class="register-button w-full text-white font-semibold
                       py-4 text-lg rounded-xl transition duration-300"
            >
                Daftar Sekarang
            </button>
        </form>

        <!-- Link Login -->
        <p class="text-center text-base text-gray-600 mt-8">
            Sudah memiliki akun?

            <a href="{{ route('login') }}"
               class="text-green-700 font-semibold hover:text-green-900
                      hover:underline transition">
                Login
            </a>
        </p>

        <!-- Kembali ke Beranda -->
        <div class="text-center mt-6 pt-6 border-t border-green-100">
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

    <!-- Tampilkan Form Tambahan untuk Pelaku UMKM -->
    <script>
        const roleSelect = document.getElementById('role');
        const umkmField = document.getElementById('umkm-field');

        const umkmName = document.getElementById('umkm_name');
        const phone = document.getElementById('phone');
        const umkmAddress = document.getElementById('umkm_address');
        const umkmDescription = document.getElementById('umkm_description');

        function toggleUmkmField() {
            const isUmkm = roleSelect.value === 'umkm';

            umkmField.classList.toggle('hidden', !isUmkm);

            umkmName.required = isUmkm;
            phone.required = isUmkm;
            umkmAddress.required = isUmkm;
            umkmDescription.required = isUmkm;
        }

        roleSelect.addEventListener('change', toggleUmkmField);

        toggleUmkmField();
    </script>

</body>
</html>
