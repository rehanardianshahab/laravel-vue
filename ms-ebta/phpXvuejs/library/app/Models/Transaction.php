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
        return $this->belongsTo('App\Models\User', 'member_id');
    }
}
