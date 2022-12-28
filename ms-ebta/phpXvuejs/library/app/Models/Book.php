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
        return $this->belongsTo('App\Models\Publisher', 'id');
    }

    public function Catalog()
    {
        return $this->belongsTo('App\Models\Catalog', 'id');
    }

    public function Author()
    {
        return $this->belongsTo('App\Models\Author', 'id');
    }
}
