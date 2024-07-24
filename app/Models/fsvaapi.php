<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fsvaapi extends Model
{
    use HasFactory;
    protected $fillable = ['kelurahan','tahun','indexprioritas','penyediaanpangan','kesejahteraanrendah','aksespenghubung','aksesairbersih','jmltenagakesehatan'];
}
