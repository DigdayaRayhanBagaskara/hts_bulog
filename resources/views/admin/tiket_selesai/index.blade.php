@extends('admin.template')
@section('title', 'Data Master - Tiket Selesai')

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-12">
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
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-left">
                                    <a href="/admin/tiket_selesai/{{$row->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat!" class="mx-1 btn btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="/admin/log_tiket/{{$row->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Log" class="mx-1 btn btn-secondary"><i class="fa fa-history"></i></a>
                                    @php
                                        $tiketTautan = \App\Models\Tiket::where('id_tautan', $row->id)->first();
                                    @endphp
                                    @if($row->id_tautan != null)
                                        <a href="/admin/tiket_selesai/{{$row->id_tautan}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Tiket Sebelumnya!" class="mx-1 btn btn-warning"><i class="fa fa-eye"></i></a>
                                    @endif
                                    @if($row->logs->contains(function($log) {
                                        return $log->status === 'Closed' && $log->detail === 'Tiket Tidak Selesai';
                                    }))                                    
                                    <a href="/admin/tiket_selesai/{{$tiketTautan->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Tiket Lanjutan!" class="mx-1 btn btn-danger"><i class="fa fa-eye"></i></a>
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
