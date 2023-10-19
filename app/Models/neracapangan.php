<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class neracapangan extends Model
{
    use HasFactory;

    protected $table = "neracapangan";
    protected $fillable = ['id_komoditas','barangmasuk','stockminggulalu','ketersediaanawal', 'ketersediaanakhir','harga','konsumsihari','konsumsiminggu','pengadaan','minggu','id_bulan','tahun'];

    public function komoditasid()
    {
        return $this->belongsTo('App\Models\komoditas','id_komoditas');
    }

    public function bulanid()
    {
        return $this->belongsTo('App\Models\bulan','id_bulan');
    }

    public function satuanid()
    {
        return $this->belongsTo('App\Models\satuan','id_satuan');
    }
}
