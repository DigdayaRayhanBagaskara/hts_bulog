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
        <div class="card-header text-center font-weight-bold" style="font-size: larger;">Tanggapan Tiket</div>
        <div class="card-body">
            <input readonly type="text" value="{{$data->id_tiket}}" name="id_tiket" class="form-control mb-2" required
                placeholder="ID Tiket">
            <textarea readonly name="tanggapan" class="form-control mb-2" required placeholder="Tanggapan">{{$data->tanggapan}}</textarea>
            <div class="text-center">
                <img src="{{ Storage::url('gambar_tanggapan/' . $data->gambar_tanggapan) }}" alt="Gambar Tanggapan" class="img-fluid rounded shadow mb-2" style="max-height: 100%; object-fit: contain;">
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
