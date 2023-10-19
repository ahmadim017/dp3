<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pphkecukupangizi extends Model
{
    use HasFactory;
    protected $fillable = ['id_bahanpangan','kkal','persen','ake','skoraktual','skorake','skorpph','gram','persenprotein','akp','id_tahun','tahun'];

    public function bahanpanganpphid()
    {
        return $this->belongsTo('App\Models\bahanpanganpph','id_bahanpangan');
    }
}
