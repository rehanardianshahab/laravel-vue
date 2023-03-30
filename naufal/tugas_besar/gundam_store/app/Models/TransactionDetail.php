<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transaction_id',
        'gundam_product_id',
        'purchase_qty',
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function gundam_product() {
        return $this->belongsTo(GundamProduct::class);
    }
}
