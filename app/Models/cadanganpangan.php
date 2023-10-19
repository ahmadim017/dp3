<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class cadanganpangan extends Model
{
    use HasFactory;
    protected $table = 'cadanganpangan';

    public function bulanid()
    {
        return $this->belongsTo('App\Models\bulan','id_bulan');
    }

    public function gettglkontrakAttribute()
    {
    
    return
     Carbon::parse($this->attributes['tglkontrak'])->locale('id')->isoFormat('D MMMM Y');
    }

    public function penyaluran()
    {
        return $this->hasMany(penyaluran::class, 'id_cadanganpangan');
    }

    public function pelepasan()
    {
        return $this->hasMany(pelepasan::class, 'id_cadanganpangan');
    }

}
