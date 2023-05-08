<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'total_item', 'total_price','discount', 'payment', 'cash', 'user_id'];

    public function members()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
