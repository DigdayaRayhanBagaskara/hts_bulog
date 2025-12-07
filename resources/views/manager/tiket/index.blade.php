@extends('manager.template')
@section('title', 'Tiket')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-12">
        <div class="">
            <a href="/manager/tiket/create" class="mx-1 btn btn-primary px-5 mb-2">Tambah</a>
        </div>
        <div class="card-body">
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
                            <th class="text-center align-middle">ID Tiket</th>
                            <th class="text-center align-middle">Nama User</th>
                            <th class="text-center align-middle">Jabatan</th>
                            <th class="text-center align-middle">Area</th>
                            <th class="text-center align-middle">Kategori</th>
                            <th class="text-center align-middle">Subkategori</th>
                            <th class="text-center align-middle">Judul</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">{{$row->id_tiket}}</td>
                            <td class="text-center align-middle">{{$row->user->nama}}</td>
                            <td class="text-center align-middle">{{$row->user->jabatan->nama_jabatan}}</td>
                            <td class="text-center align-middle">{{$row->user->area->nama_area}} | {{$row->user->area->tipe_area}} </td>
                            <td class="text-center align-middle">{{$row->kategori_masalah->nama_kategori}}</td>
                            <td class="text-center align-middle">{{$row->kategori_masalah->nama_subkategori}}</td>
                            <td class="text-center align-middle">{{$row->judul}}</td>
                            <td class="text-center align-middle">{{$row->status}}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-left">
                                    <a href="/manager/tiket/{{$row->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat!" class="mx-1 btn btn-success"><i class="fa fa-eye"></i></a>
                                    @if($row->tanggapan != null)
                                    <a href="/manager/tiket/{{$row->id}}/tanggapan" data-bs-toggle="tooltip" data-bs-placement="top" title="Tanggapan" class="mx-1 btn btn-info"><i class="fa fa-comment"></i></a>
                                    @endif
                                    <a href="/manager/log_tiket/{{$row->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Log Tiket" class="mx-1 btn btn-secondary"><i class="fa fa-history"></i></a>
                                    @php
                                        $tiketTautan = \App\Models\Tiket::where('id_tautan', $row->id)->first();
                                    @endphp
                                    
                                    @if($row->id_tautan != null)
                                        <a href="/manager/tiket/{{$row->id_tautan}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Tiket Sebelumnya!" class="mx-1 btn btn-warning"><i class="fa fa-eye"></i></a>
                                    @endif
                                    @if($row->logs->contains(function($log) {
                                        return $log->status === 'Closed' && $log->detail === 'Tiket Selesai' ;
                                    }))
                                    @elseif($row->logs->contains(function($log) {
                                        return $log->status === 'Closed' && $log->detail === 'Tiket Tidak Selesai';
                                    }))                                    
                                    <a href="/manager/tiket/{{$tiketTautan->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Tiket Lanjutan!" class="mx-1 btn btn-danger"><i class="fa fa-eye"></i></a>
                                    @elseif($row->logs->contains(function($log) {
                                        return $log->status === 'Process' && $log->detail === 'Tiket Ditanggapi';
                                    }))
                                        <a href="/manager/tiket/{{$row->id}}/tidak_selesai"
                                            onclick="return confirm('Apakah anda yakin Tidak Selesaikan data ini?')"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tidak Selesai"
                                            class="mx-1 btn btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form action="/manager/tiket/{{$row->id}}/selesai" method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin Selesaikan data ini?')">
                                            @csrf
                                            @method('patch')
                                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai" class="mx-1 btn btn-success" type="submit"><i class="fa fa-check"></i></button>
                                        </form>
                                    @endif
                                    
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
