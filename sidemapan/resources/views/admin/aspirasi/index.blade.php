@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-2">Aspirasi & Pengaduan Warga</h1>
    <p class="text-gray-500 mb-6">
        Kelola aspirasi dan pengaduan yang dikirim oleh pengguna.
    </p>

    <form method="GET" class="flex flex-wrap gap-3 mb-5">
        <select name="jenis" class="border rounded-lg p-2">
            <option value="">Semua Jenis</option>
            <option value="aspirasi" @selected(request('jenis') === 'aspirasi')>
                Aspirasi
            </option>
            <option value="pengaduan" @selected(request('jenis') === 'pengaduan')>
                Pengaduan
            </option>
        </select>

        <select name="status" class="border rounded-lg p-2">
            <option value="">Semua Status</option>
            @foreach(['pending', 'processing', 'resolved', 'rejected'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Filter
        </button>

        <a href="{{ route('admin.aspirasi.index') }}"
           class="border px-4 py-2 rounded-lg">
            Reset
        </a>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">No.</th>
                    <th class="p-4">Pengguna</th>
                    <th class="p-4">Judul</th>
                    <th class="p-4">Jenis</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($aspirasis as $aspirasi)
                    <tr class="border-t">
                        <td class="p-4">
                            {{ $loop->iteration + ($aspirasis->currentPage() - 1) * $aspirasis->perPage() }}
                        </td>
                        <td class="p-4">{{ $aspirasi->user->name }}</td>
                        <td class="p-4">{{ $aspirasi->judul }}</td>
                        <td class="p-4 capitalize">{{ $aspirasi->jenis }}</td>
                        <td class="p-4">{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                        <td class="p-4">{{ ucfirst($aspirasi->status) }}</td>
                        <td class="p-4">
                            <a href="{{ route('admin.aspirasi.show', $aspirasi) }}"
                               class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            Belum ada aspirasi atau pengaduan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $aspirasis->links() }}
    </div>
</div>
@endsection