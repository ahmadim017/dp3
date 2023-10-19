<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class berita extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
public function getImage()
{
    if (substr($this->file, 0, 5) == "https") {
        return $this->file;
    }

    if ($this->file) {
        return Storage::url('/' . $this->file);
    }

    return 'https://via.placeholder.com/500x500.png?text=No+Cover';
}

public function getCreatedAtAttribute()
    {
    
    return
     Carbon::parse($this->attributes['created_at'])
     ->locale('id')->isoFormat('D MMM');
    }

}
