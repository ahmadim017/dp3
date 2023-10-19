<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usulan extends Model
{
    use HasFactory;
    public function kecamatanid()
    {
        return $this->belongsTo('App\Models\kecamatan','id_kecamatan');
    }

    public function gettgllahirAttribute()
    {
    
    return
     Carbon::parse($this->attributes['tgllahir'])->locale('id')->isoFormat('D MMMM Y');
    }
    public function penyaluran()
    {
        return $this->hasMany(penyaluran::class, 'id_usulan');
    }

    public function pelepasan()
    {
        return $this->hasMany(pelepasan::class, 'id_usulan');
    }

}
