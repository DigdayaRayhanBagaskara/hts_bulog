<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'log';
    protected $fillable = [
        'id_tiket',
        'id_user',
        'waktu',
        'detail',
        'status',
    ];

    public function tiket(){
        return $this->belongsTo(Tiket::class, 'id_tiket', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
