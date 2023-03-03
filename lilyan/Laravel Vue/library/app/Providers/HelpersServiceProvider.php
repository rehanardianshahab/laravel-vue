<?php

namespace App\Providers;

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;


class HelpersServiceProvider extends ServiceProvider
{
    public $name, $days; 
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        $members = Member::select('members.name','transactions.date_end','transactions.status')
					->join('transactions', 'members.id', '=', 'transactions.member_id')
					->orderBy('members.id')
                    ->get();	
        
        $transactions = Transaction::select(DB::raw('count(transactions.status) as jml_status', 'date_end'))
        ->where('transactions.status', '=', 0)
        ->get();
        
        $this->name = $members;
        $this->days = $transactions;

        view()->composer('layouts.admin', function($view) 
        {
            $view->with([ 
                'member_name' => $this->name, 
                'notif_days' => $this->days
            ]);
        });
    }
}
