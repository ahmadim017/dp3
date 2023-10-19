<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skpgbulan extends Model
{
    use HasFactory;

    public function skpg()
    {
        return $this->hasMany(skpg::class, 'id_skpgbulan');
    }
    public function bulanid()
    {
        return $this->belongsTo('App\Models\bulan','id_bulan');
    }
}
