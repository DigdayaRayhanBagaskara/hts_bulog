<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FAQ;

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

        return view('user.lihat_faq', compact('kategoriMasalah'));
    }

}
