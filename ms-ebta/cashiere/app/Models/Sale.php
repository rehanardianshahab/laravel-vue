<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $guarded = ['id'];

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }
    public function salesDetail()
    {
        return $this->hasMany(SalesDetail::class, 'sale_id', 'id');
    }
}
