@extends('layouts.pembeli')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <a href="{{ route('pembeli.aspirasi.index') }}"
       class="text-blue-600 hover:underline">
        ← Kembali
    </a>

    <div class="bg-white rounded-xl shadow p-6 mt-4">
        <div class="flex justify-between gap-4 flex-wrap">
            <div>
                <span class="text-sm text-gray-500 capitalize">
                    {{ $aspirasi->jenis }}
                </span>
                <h1 class="text-2xl font-bold mt-1">
                    {{ $aspirasi->judul }}
                </h1>
            </div>

            <span class="h-fit px-3 py-1 rounded-full text-sm
                @if($aspirasi->status === 'pending') bg-yellow-100 text-yellow-700
                @elseif($aspirasi->status === 'processing') bg-blue-100 text-blue-700
                @elseif($aspirasi->status === 'resolved') bg-green-100 text-green-700
                @else bg-red-100 text-red-700
                @endif">
                {{ ucfirst($aspirasi->status) }}
            </span>
        </div>

        <p class="text-sm text-gray-500 mt-3">
            Dikirim pada {{ $aspirasi->created_at->format('d/m/Y H:i') }}
        </p>

        <hr class="my-5">

        <h2 class="font-semibold mb-2">Isi Laporan</h2>
        <p class="text-gray-700 whitespace-pre-line">{{ $aspirasi->isi }}</p>

        <hr class="my-5">

        <h2 class="font-semibold mb-2">Tanggapan Admin</h2>

        @if($aspirasi->tanggapan)
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="whitespace-pre-line text-gray-700">{{ $aspirasi->tanggapan }}</p>
            </div>
        @else
            <p class="text-gray-500">Belum ada tanggapan dari admin.</p>
        @endif
    </div>
</div>
@endsection