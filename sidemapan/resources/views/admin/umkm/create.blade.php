@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah UMKM</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.umkm.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama UMKM</label>
                    <input type="text"
                           name="nama_umkm"
                           class="form-control"
                           value="{{ old('nama_umkm') }}"
                           required>
                    @error('nama_umkm')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat"
                              class="form-control"
                              rows="3"
                              required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text"
                           name="no_telepon"
                           class="form-control"
                           value="{{ old('no_telepon') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo UMKM</label>
                    <input type="file"
                           name="logo"
                           class="form-control"
                           accept="image/png,image/jpeg">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan UMKM
                    </button>

                    <a href="{{ route('admin.umkm.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection