<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relasi database
    public function Transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_id');
    }

    public function Book()
    {
        return $this->belongsTo('App\Models\Book', 'book_id');
    }
}
