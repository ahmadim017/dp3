<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\jenissampel;
use Carbon\Carbon;

class keamananpangan extends Model
{
    use HasFactory;
    protected $table = 'keamananpangan';

   
public function gettglpengambilanAttribute()
    {
    return Carbon::parse($this->attributes['tglpengambilan'])->locale('id')->isoFormat('dddd, D MMMM Y');
    }
public function jenissampel()
{
    return $this->belongsTo(jenissampel::class);
}
}
