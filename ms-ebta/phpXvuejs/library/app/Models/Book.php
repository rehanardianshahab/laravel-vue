<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // relation database
    public function Publisher()
    {
        return $this->belongsTo('App\Models\Book', 'publisher_id');
    }

    public function Catalog()
    {
        return $this->belongsTo('App\Models\Book', 'catalog_id');
    }
}
