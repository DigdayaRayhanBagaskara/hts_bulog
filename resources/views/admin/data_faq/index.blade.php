@extends('admin.template')
@section('title', 'Data Master - Data FAQ')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-12">
        <div class="card-body">
            <div class="">
                <a href="/admin/data_faq/create" class="mx-1 btn btn-primary px-5 mb-2">Tambah</a>
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
                            <th class="text-center align-middle">Nama Kategori</th>
                            <th class="text-center align-middle">Nama Subkategori</th>
                            <th class="text-center align-middle">Judul</th>
                            <th class="text-center align-middle">Deskripsi</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">{{$row->kategori_masalah->nama_kategori}}</td>
                            <td class="text-center align-middle">{{$row->kategori_masalah->nama_subkategori}}</td>
                            <td class="text-center align-middle">{{$row->judul}}</td>
                            <td class="text-center align-middle">{{$row->deskripsi}}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-between">
                                    <a href="/admin/data_faq/{{$row->id}}/edit" class="mx-1 btn btn-warning">Edit</a>
                                    <form action="/admin/data_faq/{{$row->id}}" method="POST"
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
