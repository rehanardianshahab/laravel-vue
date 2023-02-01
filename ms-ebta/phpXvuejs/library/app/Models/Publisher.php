<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory, SoftDeletes;
    
    // guarded or fillable
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    
    // relasi database
    public function Books()
    {
        return $this->hasMany('App\Models\Book', 'publisher_id');
    }
}
