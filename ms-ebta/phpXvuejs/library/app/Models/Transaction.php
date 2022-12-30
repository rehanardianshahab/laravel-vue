<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    // relasi database
    public function Member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }

    public function TransactionDetail()
    {
        return $this->hasOne('App\Models\TransactionDetail', 'transaction_id');
    }
}
