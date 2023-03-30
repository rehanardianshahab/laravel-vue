<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_product',
    ];

    public function gundam_product() {
        return $this->hasMany(GundamProduct::class, 'category_id');
    }
}
