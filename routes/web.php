<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return redirect('/admin');
});

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        //Dashboard
        Route::get('/','DashboardController@index');
        
        //Master Data
            //User
            Route::resource('/data_user', 'UserController');
            
            //Jabatan & Area
            Route::resource('/jabatan_area', 'JabatanController');
            Route::resource('/area_jabatan', 'AreaController');
            
            //Kategori Masalah
            Route::resource('/kategori_masalah', 'KategoriMasalahController');
            
            //Data FAQ
            Route::resource('/data_faq', 'FAQController');
            
        //Data Tiket
            //Tambah Tiket
            Route::get('/tambah_tiket', 'TiketController@tambahTiket');
            Route::post('/tambah_tiket', 'TiketController@simpanTambahTiket');
            
            //Tiket Masuk
            Route::get('/tiket_masuk', 'TiketController@tiketMasuk');
            Route::get('/tiket_masuk/{tiket}', 'TiketController@lihatTiketMasuk');
            Route::patch('/tiket_masuk/{tiket}/proses', 'TiketController@prosesTiketMasuk');
            
            //Tiket Diproses
            Route::get('/tiket_diproses', 'TiketController@tiketDiproses');
            Route::get('/tiket_diproses/{tiket}', 'TiketController@lihatTiketDiproses');
            Route::get('/tiket_diproses/tanggapi/{tiket}', 'TiketController@tanggapiTiketDiproses');
            Route::get('/tiket_diproses/tanggapi/{tiket}/show', 'TiketController@lihatTanggapanTiketDiproses');
            Route::patch('/tiket_diproses/tanggapi/{tiket}/proses', 'TiketController@prosesTiketDiproses');
            Route::patch('/tiket_diproses/{tiket}/selesai', 'TiketController@selesaiTiketDiproses');
            
            //Tiket Diproses
            Route::get('/tiket_selesai', 'TiketController@tiketSelesai');
            Route::get('/tiket_selesai/{tiket}', 'TiketController@lihatTiketSelesai');
            Route::get('/tiket_selesai/{tiket}/cetak', 'TiketController@cetakTiketSelesai');
            
            //Log Tiket
            Route::get('/log_tiket/{tiket}', 'TiketController@logTiket');
            
        //Lihat FAQ
        Route::get('/lihat_faq', 'FAQController@lihatFAQ');
});

Route::prefix('manager')
    ->namespace('App\Http\Controllers\Manager')
    ->middleware(['auth', 'manager'])
    ->group(function () {

        //Dashboard
        Route::get('/','DashboardController@index');    
        
        //Tiket
        Route::resource('/tiket','TiketController');
        Route::get('/tiket/{tiket}/tanggapan', 'TiketController@lihatTanggapanTiket');    
        Route::patch('/tiket/{tiket}/selesai', 'TiketController@selesaiTiket');    
        Route::get('/tiket/{tiket}/tidak_selesai', 'TiketController@tidakSelesaiTiket');   
        Route::patch('/tiket/tidak_selesai/{tiket}', 'TiketController@prosesTidakSelesaiTiket');   
        
        //Log Tiket
        Route::get('/log_tiket/{tiket}', 'TiketController@logTiket');    
    
        //Lihat FAQ
        Route::get('/lihat_faq', 'FAQController@lihatFAQ');
        
        //Laporan
        Route::get('/laporan','TiketController@laporan');    
        Route::post('/laporan/cetak','TiketController@cetak');    
});

Route::prefix('user')
    ->namespace('App\Http\Controllers\User')
    ->middleware(['auth', 'user'])
    ->group(function () {

        //Dashboard
        Route::get('/','DashboardController@index');    
        
        //Tiket
        Route::resource('/tiket','TiketController');
        Route::get('/tiket/{tiket}/tanggapan', 'TiketController@lihatTanggapanTiket');    
        Route::patch('/tiket/{tiket}/selesai', 'TiketController@selesaiTiket');   
        Route::get('/tiket/{tiket}/tidak_selesai', 'TiketController@tidakSelesaiTiket');   
        Route::patch('/tiket/tidak_selesai/{tiket}', 'TiketController@prosesTidakSelesaiTiket');   
        
        //Log Tiket
        Route::get('/log_tiket/{tiket}', 'TiketController@logTiket');    
    
        //Lihat FAQ
        Route::get('/lihat_faq', 'FAQController@lihatFAQ');
});


Auth::routes();
