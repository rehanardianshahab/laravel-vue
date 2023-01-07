<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    
    // guarded or fillable
    protected $guarded = ['id'];
    
    // relasi database
    public function Books()
    {
        return $this->hasMany('App\Models\Book', 'publisher_id');
    }
}
