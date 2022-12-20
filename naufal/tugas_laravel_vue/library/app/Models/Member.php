<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'phone_number',
        'address',
        'email',
        'role',
        'entry_date',
    ];

    public function user() {
        return $this->hasOne('App\Models\User', 'member_id');
    }
}
