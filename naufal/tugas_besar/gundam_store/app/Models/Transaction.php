<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'purchase_date',
        'repayment_date',
        'status',
        'member_id'
    ];

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::created(function($model) {
            $model->invoice_number = "GNDM - ".str_pad($model->id, 6, '0', STR_PAD_LEFT);
            $model->save();
        });
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function transaction_detail() {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
