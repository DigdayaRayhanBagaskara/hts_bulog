<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\KategoriMasalah;
use App\Models\Log;
use App\Models\Tiket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class TiketController extends Controller
{

    //Tiket Diproses

    public function index()
    {
        $data = Tiket::with('logs')->where('id_user', Auth::id())->orderBy('created_at', 'DESC')->get();
        return view('manager.tiket.index', compact('data'));
    }
    public function create()
    {
        $kategori_masalah = KategoriMasalah::orderBy('created_at', 'DESC')->get();
        return view('manager.tiket.create', compact('kategori_masalah'));
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategori_masalah' => 'required|exists:kategori_masalah,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar_tiket' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['id_user'] = Auth::user()->id;
        $data['id_tiket'] = date('YmdHis');
        $data['waktu_tiket'] = date('Y-m-d H:i:s');

        $file = $request->file('gambar_tiket');
        $namaFile = str_replace(' ', '_', strtolower(Auth::user()->nama)) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gambar_tiket', $namaFile);
        $data['gambar_tiket'] = $namaFile;
        
        $done = Tiket::create($data);
        
        $cek = Log::where('id_tiket', $done->id)->where('id_user', Auth::user()->id)->where('status', 'Pending')->where('detail', 'Tiket Masuk')->first();
        if($cek == null){
            Log::create([
                'id_tiket' => $done->id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Masuk',
                'status' => 'Pending',
            ]);
        }
        
        if ($done) {
            return redirect('/manager/tiket')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/manager/tiket')->with('gagal', 'Data gagal ditambahkan!');
        }
    }
    
    public function show($id)
    {
        $data = Tiket::where('id', $id)->first();
        return view('manager.tiket.show', compact('data'));
    }

    public function lihatTanggapanTiket($id)
    {
        $data = Tiket::where('id', $id)->first();
        return view('manager.tiket.tanggapan', compact('data'));
    }
    public function tidakSelesaiTiket($id)
    {
        $tiket = Tiket::where('id', $id)->first();
        $kategori_masalah = KategoriMasalah::orderBy('created_at', 'DESC')->get();
        return view('manager.tiket.tidak_selesai', compact('tiket', 'kategori_masalah'));
    }

    public function prosesTidakSelesaiTiket(Request $request, $id){
        $data = $request->validate([
            // 'id_kategori_masalah' => 'required|exists:kategori_masalah,id',
            // 'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar_tiket' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $tiket = Tiket::where('id', $id)->first();
        
        $data['id_kategori_masalah'] = $tiket->id_kategori_masalah;
        $data['judul'] = $tiket->judul;
        $data['id_tautan'] = $id;
        $data['id_user'] = Auth::user()->id;
        $data['id_tiket'] = date('YmdHis');
        $data['waktu_tiket'] = date('Y-m-d H:i:s');

        $file = $request->file('gambar_tiket');
        $namaFile = str_replace(' ', '_', strtolower(Auth::user()->nama)) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gambar_tiket', $namaFile);
        $data['gambar_tiket'] = $namaFile;
        
        $done = Tiket::create($data);
        $cek = Log::where('id_tiket', $done->id)->where('id_user', Auth::user()->id)->where('status', 'Pending')->where('detail', 'Tiket Masuk')->first();
        
        if ($done) {
            if($cek == null){
                Log::create([
                    'id_tiket' => $done->id,
                    'id_user' => Auth::user()->id,
                    'waktu' => date('Y-m-d H:i:s'),
                    'detail' => 'Tiket Masuk',
                    'status' => 'Pending',
                ]);
            }
            Log::create([
                'id_tiket' => $id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Tidak Selesai',
                'status' => 'Closed',
            ]);
            Tiket::where('id', $id)->update([
                'status' => 'Closed'
            ]);
            
            return redirect('/manager/tiket')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/manager/tiket')->with('gagal', 'Data gagal ditambahkan!');
        }

    }

    public function selesaiTiket($id)
    {
        $cek = Log::where('id_tiket', $id)->where('id_user', Auth::user()->id)->where('status', 'CLosed')->where('detail', 'Tiket Selesai')->first();
        if($cek == null){
            $done = Log::create([
                'id_tiket' => $id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Selesai',
                'status' => 'Closed',
            ]);
        }

        if ($done) {
            return redirect('/manager/tiket')->with('berhasil', 'Data berhasil diselesaikan!');
        } else {
            return redirect('/manager/tiket')->with('gagal', 'Data gagal diselesaikan!');
        }
    }

    //Log Tiket
    public function logTiket($id){
        $data = Log::where('id_tiket', $id)->orderBy('created_at', 'DESC')->get();
        $id_tiket = Log::where('id_tiket', $id)->first()->tiket->id_tiket;
        return view('manager.log_tiket', compact('data', 'id_tiket'));
    }

    public function laporan(){
        $data = Tiket::orderBy('created_at', 'DESC')->get();
        return view('manager.laporan.index', compact('data'));
    }

    public function cetak(Request $request){
        $data = $request->all();
        if($data['tanggal_mulai'] == null || $data['tanggal_selesai'] == null){
            $cetak = Tiket::where('status_pesanan', 'diterima')->orderBy('created_at', 'DESC')->get();
        }else{
            $tm = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d\TH:i:s.u\Z');
            $ts = Carbon::parse($data['tanggal_selesai'])->addDay()->format('Y-m-d\TH:i:s.u\Z');
            $cetak = Tiket::whereBetween('created_at', [$tm, $ts])->orderBy('created_at', 'DESC')->get();
        }      
        $date = date('d-M-Y H:i:s');
        return Pdf::loadView('manager.laporan.cetak', compact('cetak', 'date'))->setPaper('A4', 'landscape')->stream('laporan_tiket - '. $date .'.pdf');
    }


    

    
}
