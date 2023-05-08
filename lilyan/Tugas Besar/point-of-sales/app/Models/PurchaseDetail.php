<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'product_id', 'purchase_price', 'amount', 'subtotal'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id' );
    }

    public function members()
    {
        return $this->hasOne(Member::class, 'id', 'member_id' );
    }
}
