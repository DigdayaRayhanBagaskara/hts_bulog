@extends('admin.template')
@section('title', 'Data Tiket - Tiket Selesai')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            session('gagal')
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-header text-center font-weight-bold" style="font-size: larger;">Lihat Tiket Selesai</div>
        <div class="card-body">
            <input type="text" readonly value="{{$data->id_tiket}}" name="id_tiket" class="form-control mb-2" required
                placeholder="ID Tiket">
            <input type="text" readonly value="{{$data->waktu_tiket}}" name="waktu_tiket" class="form-control mb-2" required
                placeholder="Waktu Tiket">
            <input type="text" readonly value="{{$data->user->nama}}" name="nama" class="form-control mb-2" required
                placeholder="Nama">
            <input type="text" readonly value="{{$data->user->no_telp}}" name="no_telp" class="form-control mb-2" required
                placeholder="No. Telepon">
            <input type="text" readonly value="{{$data->user->jabatan->nama_jabatan}}" name="jabatan" class="form-control mb-2"
                required placeholder="Jabatan">
            <input type="text" readonly value="{{$data->user->area->nama_area}} | {{$data->user->area->tipe_area}}" name="area"
                class="form-control mb-2" required placeholder="Area">
            <hr>
            <input type="text" readonly value="{{$data->kategori_masalah->nama_kategori}}" name="nama_kategori"
                class="form-control mb-2" required placeholder="Kategori">
            <input type="text" readonly value="{{$data->kategori_masalah->nama_subkategori}}" name="nama_subkategori"
                class="form-control mb-2" required placeholder="Subkategori">
            <input type="text" readonly value="{{$data->judul}}" name="judul" class="form-control mb-2" required placeholder="Judul">
            <textarea readonly name="deskripsi" class="form-control mb-2" required
                placeholder="Deskripsi"> {{$data->deskripsi}} </textarea>
            <hr>
            <div class="text-center">
                    <img src="{{ Storage::url('gambar_tiket/' . $data->gambar_tiket) }}" alt="Gambar Tiket" class="img-fluid rounded shadow mb-2" style="max-height: 300px; object-fit: contain;">
                </div>
            <hr>
            <textarea readonly name="tanggapan" class="form-control mb-2" required
                placeholder="Tanggapan"> {{$data->tanggapan}} </textarea>
            <hr>
            <div class="text-center">
                    <img src="{{ Storage::url('gambar_tanggapan/' . $data->gambar_tanggapan) }}" alt="Gambar Tanggapan" class="img-fluid rounded shadow mb-2" style="max-height: 300px; object-fit: contain;">
                </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            <a href="/admin/tiket_selesai/{{$data->id}}/cetak" target="_blank" class="btn btn-success">Cetak</a>
        </div>
    </div>
</div>
@endsection
