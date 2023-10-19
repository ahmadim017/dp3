<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nbmtahun extends Model
{
    use HasFactory;
    public function nbm()
    {
        return $this->hasMany(nbm::class, 'id_tahun');
    }

}
