<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacture_company',
        'country',
        'established'
    ];

    public function gundam_product() {
        return $this->hasMany(GundamProduct::class, 'manufacturer_id');
    }
}
