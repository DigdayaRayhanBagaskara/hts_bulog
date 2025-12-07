@extends('admin.template')
@section('title', 'Data Master - Jabatan & Area')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-5 mx-2 my-2">
        <div class="card-header text-center font-weight-bold" style="font-size:larger">Jabatan</div>
        <div class="card-body">
            <div class="">
                <a href="/admin/jabatan_area/create" class="mx-1 btn btn-primary px-5 mb-2">Tambah</a>
            </div>
            @if(session('jabatan_berhasil'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('jabatan_berhasil') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('jabatan_gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('jabatan_gagal') }}
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
                            <th class="text-center align-middle">Nama Jabatan</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_jabatan as $row_jabatan)
                        <tr>
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">{{$row_jabatan->nama_jabatan}}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-between">
                                    <a href="/admin/jabatan_area/{{$row_jabatan->id}}/edit" class="mx-1 btn btn-warning">Edit</a>
                                    <form action="/admin/jabatan_area/{{$row_jabatan->id}}" method="POST"
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
    <div class="card p-4 shadow col-sm-6 mx-2 my-2">
        <div class="card-header text-center font-weight-bold" style="font-size:larger">Area</div>
        <div class="card-body">
            <div class="">
                <a href="/admin/area_jabatan/create" class="mx-1 btn btn-primary px-5 mb-2">Tambah</a>
            </div>
            @if(session('area_berhasil'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('area_berhasil') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('area_gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('area_gagal') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Nama Area</th>
                            <th class="text-center align-middle">Tipe Area</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_area as $row_area)
                        <tr>
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">{{$row_area->nama_area}}</td>
                            <td class="text-center align-middle">{{$row_area->tipe_area}}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-between">
                                    <a href="/admin/area_jabatan/{{$row_area->id}}/edit" class="mx-1 btn btn-warning">Edit</a>
                                    <form action="/admin/area_jabatan/{{$row_area->id}}" method="POST"
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
