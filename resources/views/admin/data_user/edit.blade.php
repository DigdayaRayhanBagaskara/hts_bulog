@extends('admin.template')
@section('title', 'Data Master - Data User')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-6">
        @if(session('gagal'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('gagal') }}
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="/admin/data_user/{{ $data->id }}">
            @csrf
            @method('put')
            <div class="card-header text-center font-weight-bold" style="font-size: larger;">Edit Data</div>
            <div class="card-body">
                <input type="text" value="{{ $data->username_nip }}" readonly name="username_nip" class="form-control mb-2" required placeholder="Username (NIP)">
                <input type="text" value="{{ $data->nama }}" name="nama" class="form-control mb-2" required placeholder="Nama">
                <input type="text" value="{{ $data->no_telp }}" name="no_telp" class="form-control mb-2" required placeholder="No. Telepon">

                <select name="id_jabatan" class="form-control mb-2" required>
                    <option value="">-- Silahkan Pilih Jabatan --</option>
                    @foreach($jabatan as $j)
                        <option value="{{ $j->id }}" {{ $data->id_jabatan == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jabatan }}
                        </option>
                    @endforeach
                </select>

                <select name="id_area" class="form-control mb-2" required>
                    <option value="">-- Silahkan Pilih Area --</option>
                    @foreach($area as $a)
                        <option value="{{ $a->id }}" {{ $data->id_area == $a->id ? 'selected' : '' }}>
                            {{ $a->nama_area }} | {{ $a->tipe_area }}
                        </option>
                    @endforeach
                </select>

                <input type="password" name="password" class="form-control mb-2" placeholder="Password">
                <input type="password" name="konfirmasi_password" class="form-control mb-2" placeholder="Konfirmasi Password">

                <select name="tipe_user" class="form-control mb-2" required>
                    <option value="">-- Silahkan Pilih Tipe User --</option>
                    <option value="user" {{ $data->tipe_user == 'user' ? 'selected' : '' }}>User</option>
                    <option value="manajer" {{ $data->tipe_user == 'manajer' ? 'selected' : '' }}>Manajer</option>
                    <option value="admin" {{ $data->tipe_user == 'admin' ? 'selected' : '' }}>Admin</option>
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
