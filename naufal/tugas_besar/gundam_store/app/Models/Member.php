<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'gender',
        'role',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function transaction() {
        return $this->hasMany(Transaction::class, 'member_id');
    }
}
