<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pphketersediaantahun extends Model
{
    use HasFactory;
	public function pphketersediaan()
    {
        return $this->hasMany(pphketersediaan::class, 'id_tahun');
    }

}
