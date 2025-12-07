@extends('admin.template')
@section('title', 'Data Master - Kategori Masalah')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            session('gagal')
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="/admin/kategori_masalah">
            @csrf
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Tambah Data</div>
            <div class="card-body">
                <input type="text" name="nama_kategori" class="form-control mb-2" required placeholder="Nama Kategori">
                <input type="text" name="nama_subkategori" class="form-control mb-2" required placeholder="Nama Subkategori">
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
