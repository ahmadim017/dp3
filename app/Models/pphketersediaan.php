<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pphketersediaan extends Model
{
    use HasFactory;
    protected $table = 'pphketersediaan';
    protected $fillable = ['id_bahanpangan','tahun','energi','ake','skorriil','skorpph','id_tahun'];
    
    public function bahanpanganpphid()
    {
        return $this->belongsTo('App\Models\bahanpanganpph','id_bahanpangan');
    }

}
