<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\KategoriMasalah;
use Illuminate\Http\Request;

class FAQController extends Controller
{

    public function lihatFAQ()
    {
        $data = FAQ::with('kategori_masalah')->get();
        $kategoriMasalah = [];
        foreach ($data as $faq) {
            $kategori = $faq->kategori_masalah->nama_kategori;
            $subkategori = $faq->kategori_masalah->nama_subkategori;

            $kategoriMasalah[$kategori][$subkategori][] = $faq;
        }

        return view('manager.lihat_faq', compact('kategoriMasalah'));
    }

}
