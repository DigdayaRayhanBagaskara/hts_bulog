@extends('admin.template')
@section('title', 'Data Master - Jabatan & Area')

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

        <form method="POST" action="/admin/area_jabatan/{{ $data->id }}">
            @csrf
            @method('put')
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Edit Data Area</div>
            <div class="card-body">
                <input type="text" value="{{ $data->nama_area }}" name="nama_area" class="form-control mb-2" required placeholder="Nama Area">

                <select name="tipe_area" class="form-control mb-2" required>
                    <option value="">-- Silahkan pilih Tipe Area --</option>
                    <option value="entitas" {{ $data->tipe_area == 'entitas' ? 'selected' : '' }}>entitas</option>
                    <option value="gudang" {{ $data->tipe_area == 'gudang' ? 'selected' : '' }}>gudang</option>
                </select>
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
