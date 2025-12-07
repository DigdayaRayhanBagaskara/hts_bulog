@extends('admin.template')
@section('title', 'Dashboard')

@section('content')
<div class="row">

    <div class="col-sm-12">
        <div class="card mb-5 shadow p-4">
            <div class="card-body">
                <h5 class="card-title">Selamat Datang!</h5>
                <p class="card-text">
                    Selamat datang di <strong>Sistem Informasi Helpdesk Ticketing System</strong><br>
                    Perum Bulog Kanwil Riau dan Kepri!
                </p>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <a href="/admin/data_user" class="text-decoration-none col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Data User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Monthly) Card Example -->
    <a href="/admin/tiket_masuk" class="text-decoration-none col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TIket Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tm}}</div>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Monthly) Card Example -->
    <a href="/admin/tiket_diproses" class="text-decoration-none col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Tiket Diproses
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$td}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Pending Requests Card Example -->
    <a href="/admin/tiket_selesai" class="text-decoration-none col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tiket Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ts}}</div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
@endsection
