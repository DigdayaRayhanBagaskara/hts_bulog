<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriMasalah;
use App\Models\Log;
use App\Models\Tiket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class TiketController extends Controller
{

    //Tiket Tambah

    public function tambahTiket()
    {
        $kategori_masalah = KategoriMasalah::orderBy('created_at', 'DESC')->get();
        return view('admin.tambah_tiket', compact('kategori_masalah'));
    }

    public function simpanTambahTiket(Request $request)
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
            return redirect('/admin/tiket_masuk')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/tiket_masuk')->with('gagal', 'Data gagal ditambahkan!');
        }

    }

    //Tiket Masuk

    public function tiketMasuk()
    {
        $data = Tiket::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();
        return view('admin.tiket_masuk.index', compact('data'));
    }
    public function lihatTiketMasuk($id)
    {
        $cek = Log::where('id_tiket', $id)->where('id_user', Auth::user()->id)->where('status', 'Pending')->where('detail', 'Tiket Dilihat')->first();
        if($cek == null){
            Log::create([
                'id_tiket' => $id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Dilihat',
                'status' => 'Pending',
            ]);
        }
        $data = Tiket::where('id', $id)->first();
        return view('admin.tiket_masuk.show', compact('data'));
    }
    public function prosesTiketMasuk($id)
    {
        $cek = Log::where('id_tiket', $id)->where('id_user', Auth::user()->id)->where('status', 'Process')->where('detail', 'Tiket Diproses')->first();
        if($cek == null){
            Log::create([
                'id_tiket' => $id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Diproses',
                'status' => 'Process',
            ]);
        }

        $tiket = Tiket::findOrFail($id);
        $done = $tiket->update(['status' => 'Process']);

        if ($done) {
            return redirect('/admin/tiket_diproses')->with('berhasil', 'Data berhasil diproses!');
        } else {
            return redirect('/admin/tiket_diproses')->with('gagal', 'Data gagal diproses!');
        }

    }


    //Tiket Diproses

    public function tiketDiproses()
    {
        $data = Tiket::with('logs')->where('status', 'Process')->orderBy('created_at', 'DESC')->get();
        return view('admin.tiket_diproses.index', compact('data'));
    }
    public function lihatTiketDiproses($id)
    {
        $data = Tiket::where('id', $id)->first();
        return view('admin.tiket_diproses.show', compact('data'));
    }
    public function tanggapiTiketDiproses($id)
    {
        $data = Tiket::where('id', $id)->first();
        return view('admin.tiket_diproses.tanggapi', compact('data'));
    }
    public function prosesTiketDiproses(Request $request, $id)
    {
        $data = $request->validate([
            'id_tiket' => 'required|exists:tiket,id_tiket',
            'tanggapan' => 'required|string',
            'gambar_tanggapan' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);
        // Simpan berkas tanggapan
        $file = $request->file('gambar_tanggapan');
        $namaFile = 'tanggapan-' . str_replace(' ', '_', strtolower(Auth::user()->nama)) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gambar_tanggapan', $namaFile);
        $data['gambar_tanggapan'] = $namaFile;

        $tiket = Tiket::findOrFail($id);
        $done = $tiket->update($data);

        $cek = Log::where('id_tiket', $id)->where('id_user', Auth::user()->id)->where('status', 'Process')->where('detail', 'Tiket Ditanggapi')->first();
        if($cek == null){
            Log::create([
                'id_tiket' => $id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Ditanggapi',
                'status' => 'Process',
            ]);
        }

        if ($done) {
            return redirect('/admin/tiket_diproses')->with('berhasil', 'Data berhasil diproses!');
        } else {
            return redirect('/admin/tiket_diproses')->with('gagal', 'Data gagal diproses!');
        }
    }
    public function lihatTanggapanTiketDiproses($id)
    {
        $data = Tiket::where('id', $id)->first();
        return view('admin.tiket_diproses.tanggapan', compact('data'));
    }
    public function selesaiTiketDiproses($id)
    {
        $cek = Log::where('id_tiket', $id)->where('id_user', Auth::user()->id)->where('status', 'CLosed')->where('detail', 'Tiket Selesai')->first();
        if($cek == null){
            Log::create([
                'id_tiket' => $id,
                'id_user' => Auth::user()->id,
                'waktu' => date('Y-m-d H:i:s'),
                'detail' => 'Tiket Selesai',
                'status' => 'Closed',
            ]);
        }

        $tiket = Tiket::findOrFail($id);
        $done = $tiket->update(['status' => 'Closed']);

        if ($done) {
            return redirect('/admin/tiket_selesai')->with('berhasil', 'Data berhasil diselesaikan!');
        } else {
            return redirect('/admin/tiket_selesai')->with('gagal', 'Data gagal diselesaikan!');
        }
    }

    //Tiket Selesai

    public function tiketSelesai()
    {
        $data = Tiket::where('status', 'Closed')->orderBy('created_at', 'DESC')->get();
        return view('admin.tiket_selesai.index', compact('data'));
    }
    public function lihatTiketSelesai($id)
    {
        $data = Tiket::where('id', $id)->first();
        return view('admin.tiket_selesai.show', compact('data'));
    }

    public function cetakTiketSelesai($id){
        $data = Tiket::where('id', $id)->first();
        $date = date('d-M-Y H:i:s');
        return Pdf::loadView('admin.cetak', compact('data', 'date'))->setPaper([0, 0, 250, 800], 'portrait')->stream('tiketSelesai - '. $date .'.pdf');
    }



    //Log Tiket

    public function logTiket($id){
        $data = Log::where('id_tiket', $id)->orderBy('created_at', 'DESC')->get();
        $id_tiket = Log::where('id_tiket', $id)->first()->tiket->id_tiket;
        return view('admin.log_tiket', compact('data', 'id_tiket'));
    }

    

    
}
