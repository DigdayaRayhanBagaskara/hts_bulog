@extends('admin.template')
@section('title', "Data Tiket - Log Tiket : ID Tiket. {$id_tiket}")

@section('content')
<div class="row justify-content-center">
    <div class="card p-4 shadow col-sm-12">
        <div class="">
            <a href="{{ url()->previous() }}" class="btn btn-secondary px-5 mb-2">Kembali</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example1">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Waktu</th>
                            <th class="text-center align-middle">User</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td class="text-center align-middle">{{$loop->iteration}}</td>
                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($row->waktu)->format('d M Y | H:i:s') }}</td>
                            <td class="text-center align-middle">{{$row->user->nama}}</td>
                            <td class="text-center align-middle">{{$row->status}}</td>
                            <td class="text-center align-middle">{{$row->detail}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
