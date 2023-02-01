<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    // guarded or fillable
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    // relasi database
    public function Books()
    {
        return $this->hasMany('App\Models\Book', 'author_id');
    }
}
