<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'date_start',
        'date_end',
        'status'
    ];

    public function transaction_detail() {
        return $this->belongsTo('App\Models\TransactionDetail', 'transaction_id');
    }
}
