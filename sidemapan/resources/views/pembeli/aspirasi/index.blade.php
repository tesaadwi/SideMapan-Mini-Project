@extends('layouts.pembeli')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold">Aspirasi & Pengaduan</h1>
            <p class="text-gray-500 mt-1">
                Sampaikan aspirasi atau pengaduan kepada admin desa.
            </p>
        </div>

        <a href="{{ route('pembeli.aspirasi.create') }}"
           class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            + Buat Laporan
        </a>
    </div>

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
                        <td class="p-4 font-medium">
                            {{ $aspirasi->judul }}
                        </td>
                        <td class="p-4 capitalize">
                            {{ $aspirasi->jenis }}
                        </td>
                        <td class="p-4">
                            {{ $aspirasi->created_at->format('d/m/Y') }}
                        </td>
                        <td class="p-4">
                            @php
                                $statusClass = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'resolved' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ];
                            @endphp

                            <span class="px-3 py-1 rounded-full text-sm {{ $statusClass[$aspirasi->status] }}">
                                {{ ucfirst($aspirasi->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <a href="{{ route('pembeli.aspirasi.show', $aspirasi) }}"
                               class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-500">
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