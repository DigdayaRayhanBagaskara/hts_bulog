<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\KategoriMasalah;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FAQ::orderBy('created_at', 'DESC')->get();
        return view('admin.data_faq.index', compact('data'));
    }

    public function lihatFAQ()
    {
        $data = FAQ::with('kategori_masalah')->get();
        $kategoriMasalah = [];
        foreach ($data as $faq) {
            $kategori = $faq->kategori_masalah->nama_kategori;
            $subkategori = $faq->kategori_masalah->nama_subkategori;

            $kategoriMasalah[$kategori][$subkategori][] = $faq;
        }

        return view('admin.lihat_faq', compact('kategoriMasalah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_masalah = KategoriMasalah::orderBy('created_at', 'DESC')->get();
        return view('admin.data_faq.create', compact('kategori_masalah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategori_masalah' => 'required|exists:kategori_masalah,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);
        
        // Simpan ke database
        $done = FAQ::create($data);
        
        if ($done) {
            return redirect('/admin/data_faq')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/data_faq')->with('gagal', 'Data gagal ditambahkan!');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $fAQ, $id)
    {
        $data = FAQ::where('id', $id)->first();
        $kategori_masalah = KategoriMasalah::orderBy('created_at', 'DESC')->get();
        return view('admin.data_faq.edit', compact('data', 'kategori_masalah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_kategori_masalah' => 'required|exists:kategori_masalah,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $done = $faq->update($data);

        if ($done) {
            return redirect('/admin/data_faq')->with('berhasil', 'Data berhasil diperbarui!');
        } else {
            return redirect('/admin/data_faq')->with('gagal', 'Data gagal diperbarui!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $fAQ, $id)
    {
        $faq = Faq::findOrFail($id);
        $done = $faq->delete();

        if ($done) {
            return redirect('/admin/data_faq')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/data_faq')->with('gagal', 'Data gagal dihapus!');
        }
    }
}
