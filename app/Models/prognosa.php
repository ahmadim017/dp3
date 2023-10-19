<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prognosa extends Model
{
    use HasFactory;
    protected $table = 'prognosa';
    protected $fillable = ['id_komoditas','stockawal','produksi','barangmasuk','kebutuhantahunan','totalketersediaan','kebutuhanbulanan','neraca','rencanaimpor','stockakhir','id_bulan','tahun'];
    public function komoditasid()
    {
        return $this->belongsTo('App\Models\komoditas','id_komoditas');
    } 

    public function bulanid()
    {
        return $this->belongsTo('App\Models\bulan','id_bulan');
    } 
}
