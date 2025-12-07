<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriMasalah;
use Illuminate\Http\Request;

class KategoriMasalahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KategoriMasalah::orderBy('created_at', 'DESC')->get();
        return view('admin.kategori_masalah.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori_masalah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'nama_subkategori' => 'required|string|max:100',
        ]);
    
        $done = KategoriMasalah::create($data);
    
        if ($done) {
            return redirect('/admin/kategori_masalah')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/kategori_masalah')->with('gagal', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriMasalah $kategoriMasalah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = KategoriMasalah::where('id', $id)->first();
        return view('admin.kategori_masalah.edit', compact('data'));
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'nama_subkategori' => 'required|string|max:100',
        ]);
    
        $kategoriMasalah = KategoriMasalah::findOrFail($id);
        $done = $kategoriMasalah->update($data);
    
        if ($done) {
            return redirect('/admin/kategori_masalah')->with('berhasil', 'Data berhasil diperbarui!');
        } else {
            return redirect('/admin/kategori_masalah')->with('gagal', 'Data gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategoriMasalah = KategoriMasalah::findOrFail($id);
        $done = $kategoriMasalah->delete();
    
        if ($done) {
            return redirect('/admin/kategori_masalah')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/kategori_masalah')->with('gagal', 'Data gagal dihapus!');
        }
    }
}
