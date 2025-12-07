@extends('manager.template')
@section('title', 'Tiket')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('gagal') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form method="POST" action="/manager/tiket" enctype="multipart/form-data">
            @csrf
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Tambah Tiket</div>
            <div class="card-body">
                <select name="id_kategori_masalah" class="form-control mb-2" required>
                    <option value="">-- Silahkan Pilih Kategori Masalah --</option>
                    @foreach($kategori_masalah as $km)
                        <option value="{{ $km->id }}">{{ $km->nama_kategori }} | {{ $km->nama_subkategori }}</option>
                    @endforeach
                </select>
                <input type="text" name="judul" class="form-control mb-2" required placeholder="Judul">
                <textarea name="deskripsi" class="form-control mb-2" required placeholder="Deskripsi"></textarea>
                <input type="file" name="gambar_tiket" class="form-control mb-2" required>
            </div>
            <div class="card-footer text-center">
                <a href="/manager/tiket" class="btn btn-secondary">Kembali</a>
                <button type="reset" class="btn btn-warning">Kosongkan</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
