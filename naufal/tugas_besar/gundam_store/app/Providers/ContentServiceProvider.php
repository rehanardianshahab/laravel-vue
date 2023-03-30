<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public $datas, $notif;

    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $query = Transaction::select('members.name', 'transactions.purchase_date', 'transactions.repayment_date', 'transactions.status', 'transactions.invoice_number')
                            ->join('members', 'members.id', '=', 'transactions.member_id')
                            ->orderByRaw('transactions.id')
                            ->get();
        
        $count = Transaction::select(DB::raw('COUNT(transactions.status) as status_count'))->where('transactions.status', '=', 0)->get();

        $this->datas = $query;
        $this->notif = $count;

        view()->composer('master.master', function($view) {
            $view->with([
                'contents' => $this->datas,
                'counts' => $this->notif
            ]);
        });
    }
}
