@extends('admin.template')
@section('title', 'Data Master - Jabatan & Area')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            session('gagal')
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="/admin/area_jabatan">
            @csrf
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Tambah Data Area</div>
            <div class="card-body">
                <input type="text" name="nama_area" class="form-control mb-2" required placeholder="Nama Area">
                <select name="tipe_area" class="form-control mb-2" required placeholder="Tipe Area">
                    <option value="">-- Silahkan pilih Tipe Area --</option>
                    <option value="entitas">entitas</option>
                    <option value="gudang">gudang</option>
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
