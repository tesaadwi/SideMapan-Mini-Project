<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Saya | DesaHub</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-green-800 text-white p-6 hidden md:block">
            <h1 class="text-2xl font-bold mb-10">
                DesaHub
            </h1>

            <nav class="space-y-4">
                <a href="{{ url('/umkm/dashboard') }}"
                   class="block p-3 rounded-lg hover:bg-green-700">
                    Dashboard
                </a>

                <a href="{{ route('umkm.produk.index') }}"
                   class="block p-3 rounded-lg bg-green-700">
                    Produk Saya
                </a>

                <a href="{{ route('umkm.profil.edit') }}"
                   class="block p-3 rounded-lg hover:bg-green-700">
                    Profil Toko
                </a>

                <a href="{{ route('umkm.produk.index') }}"
                   class="block p-3 rounded-lg hover:bg-green-700">
                    Kelola Produk
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="mt-10">
                @csrf
                <button type="submit"
                    class="w-full text-left p-3 rounded-lg hover:bg-red-600">
                    Keluar
                </button>
            </form>
        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 p-6 md:p-10">

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center
                        sm:justify-between gap-4 mb-8">

                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Produk Saya
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Kelola produk yang dijual di marketplace DesaHub.
                    </p>
                </div>

                <a href="{{ route('umkm.produk.create') }}"
                   class="bg-green-700 hover:bg-green-800
                          text-white px-5 py-3 rounded-lg
                          font-semibold text-center">
                    + Tambah Produk
                </a>
            </div>

            {{-- NOTIFIKASI --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400
                            text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400
                            text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- DAFTAR PRODUK --}}
            <div class="bg-white rounded-xl shadow-sm p-6">

                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    Daftar Produk
                </h3>

                @if ($produks->count() > 0)

                    <div class="overflow-x-auto">

                        <table class="w-full text-left border-collapse">

                            <thead>
                                <tr class="bg-gray-50 text-gray-600
                                           border-b">
                                    <th class="p-4">Foto</th>
                                    <th class="p-4">Nama Produk</th>
                                    <th class="p-4">Kategori</th>
                                    <th class="p-4">Harga</th>
                                    <th class="p-4">Stok</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($produks as $produk)

                                    <tr class="border-b hover:bg-gray-50">

                                        {{-- FOTO PRODUK --}}
                                        <td class="p-4">
                                            @if ($produk->foto)
                                                <img
                                                    src="{{ asset('storage/' . $produk->foto) }}"
                                                    alt="{{ $produk->nama }}"
                                                    class="h-20 w-20 object-cover rounded-lg"
                                                >
                                            @else
                                                <div class="h-20 w-20 bg-gray-200
                                                            rounded-lg flex items-center
                                                            justify-center text-gray-500
                                                            text-xs text-center">
                                                    Tidak ada foto
                                                </div>
                                            @endif
                                        </td>

                                        {{-- NAMA PRODUK --}}
                                        <td class="p-4 font-semibold text-gray-800">
                                            {{ $produk->nama }}
                                        </td>

                                        {{-- KATEGORI --}}
                                        <td class="p-4 text-gray-600">
                                            {{ $produk->kategori->nama ?? '-' }}
                                        </td>

                                        {{-- HARGA --}}
                                        <td class="p-4 text-gray-700">
                                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                        </td>

                                        {{-- STOK --}}
                                        <td class="p-4 text-gray-700">
                                            {{ $produk->stok }}
                                        </td>

                                        {{-- STATUS --}}
                                        <td class="p-4">
                                            @if ($produk->status === 'aktif')
                                                <span class="bg-green-100 text-green-700
                                                             px-3 py-1 rounded-full
                                                             text-sm">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="bg-gray-200 text-gray-700
                                                             px-3 py-1 rounded-full
                                                             text-sm">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="p-4">
                                            <div class="flex gap-2">

                                                <a href="{{ route('umkm.produk.edit', $produk->id) }}"
                                                   class="bg-yellow-400 hover:bg-yellow-500
                                                          text-gray-900 px-3 py-2
                                                          rounded-lg text-sm">
                                                    Edit
                                                </a>

                                                <form
                                                    action="{{ route('umkm.produk.destroy', $produk->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700
                                                               text-white px-3 py-2
                                                               rounded-lg text-sm">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $produks->links() }}
                    </div>

                @else

                    <div class="text-center py-16">
                        <div class="text-5xl mb-4">📦</div>

                        <h3 class="text-xl font-semibold text-gray-700">
                            Belum Ada Produk
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Silakan tambahkan produk pertama toko kamu.
                        </p>

                        <a href="{{ route('umkm.produk.create') }}"
                           class="inline-block mt-5 bg-green-700
                                  hover:bg-green-800 text-white
                                  px-5 py-3 rounded-lg">
                            + Tambah Produk
                        </a>
                    </div>

                @endif

            </div>

        </main>
    </div>

</body>
</html>