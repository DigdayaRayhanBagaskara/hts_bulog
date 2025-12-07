<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $table = 'tiket';
    protected $fillable = [
        'id_tautan',
        'id_user',
        'id_kategori_masalah',
        'id_tiket',
        'judul',
        'deskripsi',
        'gambar_tiket',
        'status',
        'tanggapan',
        'gambar_tanggapan',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function kategori_masalah(){
        return $this->belongsTo(KategoriMasalah::class, 'id_kategori_masalah', 'id');
    }
    public function logs(){
        return $this->hasMany(Log::class, 'id_tiket', 'id');
    }

    
}
