<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skpg extends Model
{
    use HasFactory;
    protected $table = 'skpg';
    protected $fillable = ['id_skpgbulan','id_bulan','id_kecamatan','tahun','ketersediaan','pemanfaatan','akses','skorkomposit'];

    public function kecamatanid()
    {
        return $this->belongsTo('App\Models\kecamatan','id_kecamatan');
    }
    public function bulanid()
    {
        return $this->belongsTo('App\Models\bulan','id_bulan');
    }
}
