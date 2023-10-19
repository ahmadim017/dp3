<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pphkonsumsitahun extends Model
{
    use HasFactory;

    public function pphkonsumsi()
    {
        return $this->hasMany(pphkonsumsi::class, 'id_tahun');
    }
    public function pphkecukupangizi()
    {
        return $this->hasMany(pphkecukupangizi::class, 'id_tahun');
    }
}
