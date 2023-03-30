<?php

namespace App\Providers;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // parent::boot();

        // static::creating(function(Transaction $transaction) {

        //     $transaction->invoice_number = "GNDM - ".str_pad($transaction->id, 6, '0', STR_PAD_LEFT);
        //     // $model->save();
        // });
    }
}
