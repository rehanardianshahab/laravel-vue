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
        'member_id',
        'total_price'
    ];

    protected $guarded = [];

    // protected static function boot() {
    //     parent::boot();

    //     static::created(function ($model) {
    //         $model->invoice_number = "GNDM - ".str_pad($model->id, 6, '0', STR_PAD_LEFT);
    //         $model->save();
    //     });
    // }

    protected static function generateInvoiceNumber()
    {
        $prefix = 'GNDM-';
        $latestInvoice = self::orderBy('id', 'desc')->first();
        $number = $latestInvoice ? intval(str_replace($prefix, '', $latestInvoice->invoice_number)) + 1 : 1;
        return $prefix . str_pad($number, 6, '0', STR_PAD_LEFT);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->invoice_number = self::generateInvoiceNumber();
        });
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function transaction_detail() {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
