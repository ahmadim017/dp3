<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fsvatahun extends Model
{
    use HasFactory;
    public function fsva()
    {
        return $this->hasMany(fsva::class, 'id_tahun');
    }

}
