<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Space extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getImage()
    {
        if (substr($this->image, 0, 5) == "https") {
            return $this->image;
        }

        if ($this->image) {
            return asset('/uploads/imgCover/' . $this->image);
        }

        return 'https://via.placeholder.com/500x500.png?text=No+Cover';
    }

    public function getCreatedAtAttribute()
    {
    
    return
     Carbon::parse($this->attributes['created_at'])->locale('id')->isoFormat('D MMMM Y');
    }
}
