<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | DesaHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto p-6">

        <div class="bg-white rounded-xl shadow p-8">

            <a href="{{ route('umkm.produk.index') }}"
               class="text-green-700 hover:underline">
                ← Kembali ke Produk
            </a>

            <h1 class="text-2xl font-bold text-gray-800 mt-4 mb-6">
                Edit Produk
            </h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('umkm.produk.update', $produk->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Nama Produk
                    </label>

                    <input type="text"
                           name="nama"
                           value="{{ old('nama', $produk->nama) }}"
                           class="w-full border rounded-lg p-3"
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

                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                              rows="4"
                              class="w-full border rounded-lg p-3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                {{-- HARGA --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Harga (Rp)
                    </label>

                    <input type="number"
                           name="harga"
                           value="{{ old('harga', $produk->harga) }}"
                           min="0"
                           class="w-full border rounded-lg p-3"
                           required>
                </div>

                {{-- STOK --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Stok
                    </label>

                    <input type="number"
                           name="stok"
                           value="{{ old('stok', $produk->stok) }}"
                           min="0"
                           class="w-full border rounded-lg p-3"
                           required>
                </div>

                {{-- FOTO LAMA --}}
                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Foto Produk Saat Ini
                    </label>

                    @if ($produk->foto)
                        <img
                            src="{{ asset('storage/' . $produk->foto) }}"
                            alt="{{ $produk->nama }}"
                            class="h-32 w-32 object-cover rounded-lg mb-3"
                        >
                    @else
                        <p class="text-gray-500 mb-3">
                            Belum ada foto produk.
                        </p>
                    @endif

                    <label class="block font-semibold mb-2">
                        Ganti Foto Produk
                    </label>

                    <input type="file"
                           name="foto"
                           accept="image/jpeg,image/png"
                           class="w-full border rounded-lg p-3">

                    <p class="text-sm text-gray-500 mt-2">
                        Kosongkan jika tidak ingin mengganti foto.
                    </p>
                </div>

                {{-- STATUS --}}
                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Status Produk
                    </label>

                    <select name="status"
                            class="w-full border rounded-lg p-3"
                            required>
                        <option value="aktif"
                            {{ old('status', $produk->status) == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-green-700 text-white
                               rounded-lg py-3 hover:bg-green-800">
                    Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

</body>
</html>