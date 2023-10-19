<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelepasan extends Model
{
    use HasFactory;

    protected $table = 'pelepasans';
    protected $fillable = [
        'id_cadanganpangan',
        'nik',
        'nama',
        'id_komoditas',
        'jumlah',
    ];
    public function komoditasid()
    {
        return $this->belongsTo('App\Models\komoditas','id_komoditas');
    }
    public function usulan()
    {
        return $this->belongsTo('App\Models\usulan','id_usulan');
    }
}
