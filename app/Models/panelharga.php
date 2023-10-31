<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panelharga extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_komoditas',
        'tanggal',
        'harga',
    ];

    public function datakomoditas()
    {
        return $this->belongsTo(datakomoditas::class, 'id_komoditas');
    }

    
}
