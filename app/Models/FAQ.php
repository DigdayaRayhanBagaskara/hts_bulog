<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = 'faq';
    protected $fillable = [
        'id_kategori_masalah',
        'judul',
        'deskripsi',
    ];
    public function kategori_masalah(){
        return $this->belongsTo(KategoriMasalah::class, 'id_kategori_masalah', 'id');
    }
}
