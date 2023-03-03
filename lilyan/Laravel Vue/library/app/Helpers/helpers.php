<?php

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

    function convert_date($value) {
        return date('H:i:s - d M Y', strtotime($value));
    }

    function date_formater($value) {
        return date('d M Y', strtotime($value));
    }

    function detail_status($status_pinjam) {
        if($status_pinjam == 1) {
            return "Sudah Dikembalikan";
        } else {
            return "Belum Dikembalikan";
        }
    }

    function durasi_hari($date_start, $date_end) {
        $date1 = strtotime($date_start);
        $date2 = strtotime($date_end);
        $totalSecondsDiff = abs($date1-$date2);
        $differentDays = $totalSecondsDiff/24/60/60;

        return $differentDays;
    }

    if(!function_exists('currency_IDR')){
    function currency_IDR($value)
        {
            return "Rp. " . number_format($value,0,',','.');
        }
    }
	
	function jml_hari($date_end) {
        $awal = strtotime(date('d-m-Y'));
        $akhir = strtotime($date_end);
        $awal_akhir = abs($awal - $akhir);
        $total_hari = $awal_akhir/60/60/24;

        return $total_hari;
    }
	
	function jml_status() {		
		$jml_notif = Transaction::select(DB::raw('count(transactions.status) as jml_status'))
                        ->where('transactions.status', '=', 0)
                        ->get();
		
		return $jml_notif;		
	}

    function name_notif(){
		$notif = Member::select('members.name,transactions.date_end,transactions.status')
				->join('transactions', 'transactions.members_id', '=', 'members.id')
				->orderBy('members.id')
                ->get();	

		return $notif;
	}
?>