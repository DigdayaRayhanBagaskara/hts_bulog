@extends('admin.template')
@section('title', 'Data Tiket - Tiket Diproses')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            session('gagal')
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="/admin/tiket_diproses/tanggapi/{{$data->id}}/proses" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin Tanggapi data ini?')">
            @csrf
            @method('patch')
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Tanggapi Tiket Diproses</div>
            <div class="card-body">
                <input readonly type="text" value="{{$data->id_tiket}}" name="id_tiket" class="form-control mb-2" required placeholder="ID Tiket">
                <textarea name="tanggapan" class="form-control mb-2" required placeholder="Tanggapan"></textarea>
                <input type="file" name="gambar_tanggapan" class="form-control mb-2" required placeholder="gambar_tanggapan">
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection
