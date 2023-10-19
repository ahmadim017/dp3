<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class jenissampel extends Model
{
    use HasFactory;
    protected $fillable = ['jenissampel','hasiluji','keterangan'];
    public function getCreatedAtAttribute()
    {
    
    return
     Carbon::parse($this->attributes['created_at'])
     ->locale('id')->isoFormat('D MMMM Y');
    }
     public function keamananpanganid()
    {
        return $this->belongsTo('App\Models\keamananpangan','id_keamananpangan');
    }
}
