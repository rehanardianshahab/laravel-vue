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
        $query = Member::select('members.name', 'transactions.date_end', 'transactions.status')
                    ->join('transactions', 'members.id', '=', 'transactions.member_id')
                    ->orderByRaw('members.id')
                    ->get();
        $count = Transaction::select(DB::raw('COUNT(transactions.status) as status_count'))->where('transactions.status', '=', 0)->get();
        $this->datas = $query;
        $this->count_notif = $count;

        view()->composer('layouts.admin', function($view) {
            $view->with([
                'contents' => $this->datas,
                'counts' => $this->count_notif
            ]);
        });
    }
}
