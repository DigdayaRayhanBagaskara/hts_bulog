@extends('manager.template')
@section('title', 'Tiket')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            session('gagal')
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Lihat Tiket Diproses</div>
            <div class="card-body">
                <input type="text" readonly value="{{$data->id_tiket}}" name="id_tiket" class="form-control mb-2" required placeholder="ID Tiket">
                <input type="text" readonly value="{{$data->waktu_tiket}}" name="waktu_tiket" class="form-control mb-2" required placeholder="Waktu Tiket">
                <input type="text" readonly value="{{$data->user->nama}}" name="nama" class="form-control mb-2" required placeholder="Nama">
                <input type="text" readonly value="{{$data->user->no_telp}}" name="no_telp" class="form-control mb-2" required placeholder="No. Telepon">
                <input type="text" readonly value="{{$data->user->jabatan->nama_jabatan}}" name="jabatan" class="form-control mb-2" required placeholder="Jabatan">
                <input type="text" readonly value="{{$data->user->area->nama_area}} | {{$data->user->area->tipe_area}}" name="area" class="form-control mb-2" required placeholder="Area">
                <hr>
                <input type="text" readonly value="{{$data->kategori_masalah->nama_kategori}}" name="nama_kategori" class="form-control mb-2" required placeholder="Kategori">
                <input type="text" readonly value="{{$data->kategori_masalah->nama_subkategori}}" name="nama_subkategori" class="form-control mb-2" required placeholder="Subkategori">
                <input type="text" readonly value="{{$data->judul}}" name="judul" class="form-control mb-2" required placeholder="Judul">
                <textarea readonly name="deskripsi" class="form-control mb-2" required placeholder="Deskripsi"> {{$data->deskripsi}} </textarea>
                <hr>
                <div class="text-center">
                    <img src="{{ Storage::url('gambar_tiket/' . $data->gambar_tiket) }}" alt="Gambar Tiket" class="img-fluid rounded shadow mb-2" style="max-height: 300px; object-fit: contain;">
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="/manager/tiket" class="btn btn-secondary">Kembali</a>
                @if($data->tanggapan != null)
                    <a href="/manager/tiket/{{$data->id}}/tanggapan" class="btn btn-info">Tanggapan</a>
                @endif
            </div>
    </div>
</div>
@endsection
