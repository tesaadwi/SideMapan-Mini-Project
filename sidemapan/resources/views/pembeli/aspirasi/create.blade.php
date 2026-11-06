@extends('layouts.pembeli')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-2xl font-bold mb-2">Buat Aspirasi atau Pengaduan</h1>
    <p class="text-gray-500 mb-6">
        Isi formulir berikut untuk menyampaikan laporan kepada admin desa.
    </p>

    <div class="bg-white rounded-xl shadow p-6">
        <form action="{{ route('pembeli.aspirasi.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2">Jenis Laporan</label>
                
<select name="jenis"
        class="w-full border rounded-lg p-3"
        required>
    <option value="">Pilih jenis laporan</option>

    <option value="aspirasi" @selected(old('jenis') === 'aspirasi')>
        Aspirasi
    </option>

    <option value="pengaduan" @selected(old('jenis') === 'pengaduan')>
        Pengaduan
    </option>
</select>

                @error('jenis')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Judul</label>
                <input type="text"
                       name="judul"
                       value="{{ old('judul') }}"
                       class="w-full border rounded-lg p-3"
                       placeholder="Masukkan judul laporan"
                       maxlength="255"
                       required>
                @error('judul')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-2">Isi Laporan</label>
                <textarea name="isi"
                          rows="6"
                          class="w-full border rounded-lg p-3"
                          placeholder="Tuliskan aspirasi atau pengaduan secara jelas..."
                          maxlength="5000"
                          required>{{ old('isi') }}</textarea>
                @error('isi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('pembeli.aspirasi.index') }}"
                   class="px-5 py-2 rounded-lg border">
                    Batal
                </a>

                <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection