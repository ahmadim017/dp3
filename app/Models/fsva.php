<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fsva extends Model
{
    use HasFactory;
    protected $fillable = ['kelurahan','id_tahun','indexprioritas','penyediaanpangan','kesejahteraanrendah','aksespenghubung','aksesairbersih','jmltenagakesehatan'];
}
