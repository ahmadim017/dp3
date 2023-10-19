<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\jenissampel;
class sosialisasi extends Model
{
    use HasFactory;

    public function getCreatedAtAttribute()
    {
    
    return
     Carbon::parse($this->attributes['created_at'])
     ->locale('id')->isoFormat('dddd, D MMMM Y');
    }
    public function kecamatanid()
    {
        return $this->belongsTo('App\Models\kecamatan','id_kecamatan');
    }
    public function jenissampel()
    {
    return $this->belongsTo(jenissampel::class);
    }

}
