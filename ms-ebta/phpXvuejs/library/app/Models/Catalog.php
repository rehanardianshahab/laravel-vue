<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    // relasi database
    public function Books()
    {
        return $this->hasMany('App\Models\Book', 'catalog_id');
    }
}
