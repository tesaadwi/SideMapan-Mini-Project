<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | DesaHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto p-6">

        <div class="bg-white rounded-xl shadow p-8">

            <div class="mb-6">
                <a href="{{ route('umkm.produk.index') }}"
                   class="text-green-700 hover:underline">
                    ← Kembali ke Produk
                </a>

                <h1 class="text-2xl font-bold text-gray-800 mt-4">
                    Tambah Produk
                </h1>

                <p class="text-gray-500 mt-1">
                    Masukkan informasi produk yang ingin dijual.
                </p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('umkm.produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- NAMA PRODUK --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Nama Produk
                    </label>

                    <input type="text"
                           name="nama"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama produk"
                           class="w-full border rounded-lg p-3 focus:ring-2
                                  focus:ring-green-500"
                           required>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Kategori
                    </label>

                    <select name="kategori_id"
                            class="w-full border rounded-lg p-3"
                            required>

                        <option value="">Pilih kategori</option>

                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Deskripsi Produk
                    </label>

                    <textarea name="deskripsi"
                              rows="4"
                              placeholder="Jelaskan produk kamu"
                              class="w-full border rounded-lg p-3">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- HARGA --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Harga (Rp)
                    </label>

                    <input type="number"
                           name="harga"
                           value="{{ old('harga') }}"
                           min="0"
                           placeholder="Contoh: 15000"
                           class="w-full border rounded-lg p-3"
                           required>
                </div>

                {{-- STOK --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Stok Produk
                    </label>

                    <input type="number"
                           name="stok"
                           value="{{ old('stok', 0) }}"
                           min="0"
                           class="w-full border rounded-lg p-3"
                           required>
                </div>

                {{-- FOTO --}}
                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Foto Produk
                    </label>

                    <input type="file"
                           name="foto"
                           accept="image/jpeg,image/png"
                           class="w-full border rounded-lg p-3">

                    <p class="text-sm text-gray-500 mt-2">
                        Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                    </p>
                </div>

                {{-- TOMBOL --}}
                <div class="flex gap-3">

                    <a href="{{ route('umkm.produk.index') }}"
                       class="flex-1 text-center border border-gray-300
                              rounded-lg py-3 hover:bg-gray-100">
                        Batal
                    </a>

                    <button type="submit"
                            class="flex-1 bg-green-700 text-white
                                   rounded-lg py-3 hover:bg-green-800">
                        Simpan Produk
                    </button>

                </div>

            </form>

        </div>
    </div>

</body>
</html>