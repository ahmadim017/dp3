<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pphkonsumsi extends Model
{
    use HasFactory;
    protected $table = 'pphkonsumsi';
    protected $fillable = ['id_bahanpangan','kkal','persen','ake','skoraktual','skorake','skorpph','id_tahun','tahun'];
    public function bahanpanganpphid()
    {
        return $this->belongsTo('App\Models\bahanpanganpph','id_bahanpangan');
    }
}
