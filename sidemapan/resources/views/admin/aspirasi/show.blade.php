@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <a href="{{ route('admin.aspirasi.index') }}"
       class="text-blue-600 hover:underline">
        ← Kembali
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mt-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6 mt-4">
        <div class="flex justify-between gap-4 flex-wrap">
            <div>
                <p class="text-sm text-gray-500 capitalize">
                    {{ $aspirasi->jenis }}
                </p>
                <h1 class="text-2xl font-bold mt-1">
                    {{ $aspirasi->judul }}
                </h1>
            </div>

            <span class="h-fit px-3 py-1 rounded-full bg-gray-100">
                {{ ucfirst($aspirasi->status) }}
            </span>
        </div>

        <div class="mt-4 text-sm text-gray-500">
            Pengirim: {{ $aspirasi->user->name }}<br>
            Tanggal: {{ $aspirasi->created_at->format('d/m/Y H:i') }}
        </div>

        <hr class="my-5">

        <h2 class="font-semibold mb-2">Isi Laporan</h2>
        <p class="whitespace-pre-line text-gray-700">{{ $aspirasi->isi }}</p>

        <hr class="my-5">

        <h2 class="font-semibold text-lg mb-4">Tindak Lanjut Admin</h2>

        <form action="{{ route('admin.aspirasi.update', $aspirasi) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-2">Status</label>
                <select name="status" class="w-full border rounded-lg p-3" required>
                    @foreach(['pending', 'processing', 'resolved', 'rejected'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $aspirasi->status) === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block font-medium mb-2">Tanggapan</label>
                <textarea name="tanggapan"
                          rows="5"
                          maxlength="5000"
                          class="w-full border rounded-lg p-3"
                          placeholder="Tuliskan tanggapan atau tindak lanjut...">{{ old('tanggapan', $aspirasi->tanggapan) }}</textarea>
                @error('tanggapan')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection