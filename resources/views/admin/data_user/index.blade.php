@extends('admin.template')
@section('title', 'Data Master - Data User')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-12">
        <div class="card-body">
            <div class="">
                <a href="/admin/data_user/create" class="mx-1 btn btn-primary px-5 mb-2">Tambah</a>
            </div>
            @if(session('berhasil'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('berhasil') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('gagal') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Username (NIP)</th>
                            <th class="text-center align-middle">Nama</th>
                            <th class="text-center align-middle">No. Telepon</th>
                            <th class="text-center align-middle">Jabatan</th>
                            <th class="text-center align-middle">Area</th>
                            <th class="text-center align-middle">Tipe User</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">{{$row->username_nip}}</td>
                            <td class="text-center align-middle">{{$row->nama}}</td>
                            <td class="text-center align-middle">{{$row->no_telp}}</td>
                            <td class="text-center align-middle">{{$row->jabatan->nama_jabatan}}</td>
                            <td class="text-center align-middle">{{$row->area->nama_area}} | {{$row->area->tipe_area}}</td>
                            <td class="text-center align-middle">{{$row->tipe_user}}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-between">
                                    <a href="/admin/data_user/{{$row->id}}/edit" class="mx-1 btn btn-warning">Edit</a>
                                    <form action="/admin/data_user/{{$row->id}}" method="POST"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('delete')
                                        <button class="mx-1 btn btn-danger" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
