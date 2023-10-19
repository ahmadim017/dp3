<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nbm extends Model
{
    use HasFactory;
    protected $table = 'nbm';
    
    protected $fillable = ['id_bahanpangan','id_kategori','kalori','protein','lemak','tahun','id_tahun'];

    public function bahanpanganid()
    {
        return $this->belongsTo('App\Models\bahanpangan','id_bahanpangan');
    }

    public function kategoriid()
    {
        return $this->belongsTo('App\Models\kategori','id_kategori');
    }

}
