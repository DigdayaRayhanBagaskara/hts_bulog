@extends('admin.template')
@section('title', 'Data Master - Data FAQ')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            session('gagal')
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="/admin/data_faq">
            @csrf
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Tambah Data</div>
            <div class="card-body">
                <select name="id_kategori_masalah" class="form-control mb-2" required >
                    <option value="">-- Silahkan Pilih Kategori Masalah --</option>
                    @foreach($kategori_masalah as $km)
                        <option value="{{$km->id}}">{{$km->nama_kategori}} | {{$km->nama_subkategori}}</option>
                    @endforeach
                </select>
                <input type="text" name="judul" class="form-control mb-2" required placeholder="Judul">
                <textarea name="deskripsi" class="form-control mb-2" required placeholder="Deskripsi"></textarea>
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
