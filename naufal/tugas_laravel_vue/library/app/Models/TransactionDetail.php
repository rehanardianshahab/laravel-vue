<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'book_id',
        'trans_qty'
    ];

    public function transactions() {
        return $this->hasMany('App\Models\Transaction', 'id');
    }

    public function books() {
        return $this->hasMany('App\Models\Book', 'book_id');
    }
}
