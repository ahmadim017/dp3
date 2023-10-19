<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'usermenus', 'id_menu', 'id_user');
    }
}
