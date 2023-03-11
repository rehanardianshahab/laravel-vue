<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GundamProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'stock_qty',
        'category_id',
        'manufacturer_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    public function transaction_detail() {
        return $this->hasMany(TransactionDetail::class, 'gundam_product_id');
    }
}
