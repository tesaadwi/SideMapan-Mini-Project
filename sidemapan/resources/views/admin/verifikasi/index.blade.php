
@extends('layouts.admin')

@section('title', 'Verifikasi UMKM')

@section('content')

<div class="w-full">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row
                md:items-center
                md:justify-between
                gap-4
                mb-6">

        <div>

            <div class="flex items-center gap-3 mb-2">

                <div class="w-11 h-11
                            rounded-xl
                            bg-green-100
                            text-green-800
                            flex items-center justify-center
                            shadow-sm">

                    <i class="fa-solid fa-store"></i>

                </div>

                <div>

                    <h1 class="text-2xl
                               font-bold
                               text-green-950">

                        Verifikasi UMKM

                    </h1>

                    <p class="text-sm
                              text-slate-500
                              mt-0.5">

                        Kelola dan verifikasi UMKM Desa Gilang.

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="mb-5
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    bg-green-50
                    border border-green-200
                    text-green-800">

            <div class="w-8 h-8
                        rounded-lg
                        bg-green-100
                        flex items-center justify-center">

                <i class="fa-solid fa-check text-sm"></i>

            </div>

            <span class="text-sm font-medium">

                {{ session('success') }}

            </span>

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="mb-5
                    flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    bg-red-50
                    border border-red-200
                    text-red-700">

            <div class="w-8 h-8
                        rounded-lg
                        bg-red-100
                        flex items-center justify-center">

                <i class="fa-solid fa-circle-exclamation text-sm"></i>

            </div>

            <span class="text-sm font-medium">

                {{ session('error') }}

            </span>

        </div>

    @endif


    {{-- TABLE CARD --}}
    <div class="bg-white
                rounded-2xl
                border border-green-100
                shadow-sm
                overflow-hidden">


        {{-- TABLE HEADER --}}
        <div class="px-6 py-5
                    border-b border-green-100
                    bg-gradient-to-r from-green-50/80 to-white
                    flex flex-col md:flex-row
                    md:items-center
                    md:justify-between
                    gap-3">

            <div>

                <h2 class="text-base
                           font-bold
                           text-green-950">

                    Daftar UMKM

                </h2>

                <p class="text-xs
                          text-slate-500
                          mt-1">

                    Daftar UMKM yang terdaftar di SideMapan.

                </p>

            </div>


            <div class="inline-flex items-center gap-2
                        px-3 py-2
                        rounded-xl
                        bg-green-50
                        border border-green-200
                        text-green-800">

                <i class="fa-solid fa-store text-xs"></i>

                <span class="text-xs font-semibold">

                    {{ $umkms->total() }} UMKM

                </span>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                {{-- TABLE HEAD --}}
                <thead>

                    <tr class="bg-green-50
                               border-b border-green-100">

                        <th class="px-6 py-4
                                   text-left
                                   text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-green-800">

                            No

                        </th>

                        <th class="px-6 py-4
                                   text-left
                                   text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-green-800">

                            UMKM

                        </th>

                        <th class="px-6 py-4
                                   text-left
                                   text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-green-800">

                            Pemilik

                        </th>

                        <th class="px-6 py-4
                                   text-left
                                   text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-green-800">

                            Status

                        </th>

                        <th class="px-6 py-4
                                   text-left
                                   text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-green-800">

                            Tanggal

                        </th>

                        <th class="px-6 py-4
                                   text-left
                                   text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-green-800">

                            Aksi

                        </th>

                    </tr>

                </thead>


                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-green-50">

                    @forelse($umkms as $umkm)

                        <tr class="group
                                   hover:bg-green-50/70
                                   transition-all duration-200">


                            {{-- NO --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center
                                            w-9 h-9
                                            rounded-xl
                                            bg-green-50
                                            border border-green-100
                                            text-green-800
                                            text-xs
                                            font-bold">

                                    {{ $umkms->firstItem() + $loop->index }}

                                </div>

                            </td>


                            {{-- NAMA UMKM --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="relative shrink-0">

                                        <div class="w-12 h-12
                                                    rounded-2xl
                                                    bg-gradient-to-br
                                                    from-green-600
                                                    to-green-950
                                                    text-white
                                                    flex items-center justify-center
                                                    shadow-md
                                                    shadow-green-800/20">

                                            <i class="fa-solid fa-store text-lg"></i>

                                        </div>


                                        {{-- STATUS DOT --}}
                                        @if($umkm->status === 'approved')

                                            <span class="absolute
                                                         -right-1
                                                         -bottom-1
                                                         w-4 h-4
                                                         rounded-full
                                                         bg-emerald-500
                                                         border-[3px]
                                                         border-white">
                                            </span>

                                        @elseif($umkm->status === 'rejected')

                                            <span class="absolute
                                                         -right-1
                                                         -bottom-1
                                                         w-4 h-4
                                                         rounded-full
                                                         bg-red-500
                                                         border-[3px]
                                                         border-white">
                                            </span>

                                        @else

                                            <span class="absolute
                                                         -right-1
                                                         -bottom-1
                                                         w-4 h-4
                                                         rounded-full
                                                         bg-amber-500
                                                         border-[3px]
                                                         border-white">
                                            </span>

                                        @endif

                                    </div>


                                    <div>

                                        <div class="font-bold
                                                    text-sm
                                                    text-green-950
                                                    group-hover:text-green-700">

                                            {{ $umkm->name }}

                                        </div>

                                        <div class="flex items-center gap-1.5 mt-1">

                                            <i class="fa-solid fa-location-dot
                                                      text-[10px]
                                                      text-green-600">
                                            </i>

                                            <span class="text-xs text-slate-500">

                                                UMKM Desa Gilang

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- PEMILIK --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10
                                                rounded-xl
                                                bg-green-50
                                                border border-green-100
                                                flex items-center justify-center
                                                text-green-800">

                                        <i class="fa-solid fa-user"></i>

                                    </div>

                                    <div>

                                        <div class="text-sm
                                                    font-semibold
                                                    text-slate-700">

                                            {{ $umkm->user->name ?? '-' }}

                                        </div>

                                        <div class="text-[11px]
                                                    text-slate-500
                                                    mt-0.5">

                                            Pemilik UMKM

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-6 py-5">

                                @if($umkm->status === 'approved')

                                    <span class="inline-flex items-center gap-2
                                                 px-3.5 py-2
                                                 rounded-xl
                                                 bg-emerald-50
                                                 border border-emerald-200
                                                 text-emerald-700
                                                 text-xs
                                                 font-bold">

                                        <span class="flex items-center justify-center
                                                     w-5 h-5
                                                     rounded-full
                                                     bg-emerald-500
                                                     text-white">

                                            <i class="fa-solid fa-check text-[9px]"></i>

                                        </span>

                                        Disetujui

                                    </span>

                                @elseif($umkm->status === 'rejected')

                                    <span class="inline-flex items-center gap-2
                                                 px-3.5 py-2
                                                 rounded-xl
                                                 bg-red-50
                                                 border border-red-200
                                                 text-red-700
                                                 text-xs
                                                 font-bold">

                                        <span class="flex items-center justify-center
                                                     w-5 h-5
                                                     rounded-full
                                                     bg-red-500
                                                     text-white">

                                            <i class="fa-solid fa-xmark text-[9px]"></i>

                                        </span>

                                        Ditolak

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2
                                                 px-3.5 py-2
                                                 rounded-xl
                                                 bg-amber-50
                                                 border border-amber-200
                                                 text-amber-700
                                                 text-xs
                                                 font-bold">

                                        <span class="flex items-center justify-center
                                                     w-5 h-5
                                                     rounded-full
                                                     bg-amber-500
                                                     text-white">

                                            <i class="fa-solid fa-clock text-[9px]"></i>

                                        </span>

                                        Menunggu

                                    </span>

                                @endif

                            </td>


                            {{-- TANGGAL --}}
                            <td class="px-6 py-5">

                                <div class="inline-flex items-center gap-2
                                            px-3 py-2
                                            rounded-xl
                                            bg-green-50
                                            border border-green-100">

                                    <i class="fa-regular fa-calendar
                                              text-green-700
                                              text-xs">
                                    </i>

                                    <span class="text-xs
                                                 font-semibold
                                                 text-slate-600">

                                        {{ $umkm->created_at?->format('d-m-Y') }}

                                    </span>

                                </div>

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-5">

                                <a
                                    href="{{ route('admin.verifikasi.show', $umkm->id) }}"
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           px-4 py-2.5
                                           rounded-xl
                                           bg-gradient-to-r
                                           from-green-600
                                           to-green-950
                                           hover:from-green-700
                                           hover:to-green-950
                                           text-white
                                           text-xs
                                           font-bold
                                           shadow-md
                                           shadow-green-800/20
                                           hover:-translate-y-0.5
                                           transition-all duration-200"
                                >

                                    <i class="fa-solid fa-eye text-[10px]"></i>

                                    Detail

                                    <i class="fa-solid fa-arrow-right text-[9px]"></i>

                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-6 py-16">

                                <div class="flex flex-col
                                            items-center
                                            justify-center
                                            text-center">

                                    <div class="w-20 h-20
                                                rounded-3xl
                                                bg-gradient-to-br
                                                from-green-50
                                                to-green-100
                                                border border-green-100
                                                text-green-700
                                                flex items-center justify-center
                                                mb-5">

                                        <i class="fa-solid fa-store text-3xl"></i>

                                    </div>

                                    <p class="text-base
                                              font-bold
                                              text-green-950">

                                        Belum ada data UMKM

                                    </p>

                                    <p class="text-sm
                                              text-slate-500
                                              mt-1">

                                        Data UMKM akan muncul di sini.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($umkms->hasPages())

            <div class="px-6 py-4
                        border-t border-green-100
                        bg-green-50/50">

                {{ $umkms->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
