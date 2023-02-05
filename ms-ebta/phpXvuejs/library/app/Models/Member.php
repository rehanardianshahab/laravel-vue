<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    // fillable/guarded
    protected $guarded = ['id'];

    // relasi database
    public function user()
    {
        return $this->hasOne('App\Models\User', 'member_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'member_id');
    }
}
