<?php

use App\Models\Transaction;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

	function convert_date($value) {
		return date('H:i:s - d M Y', strtotime($value));
	}

	function status($status) {
		if($status == 1) {
			$status = 'Borrowed';
		  }
		  else {
			$status = 'Returned';
		  }
		  return $status;
	}

	function lama_pinjam($date_start, $date_end) {

		$datetime1 = new DateTime($date_start);//start time
		$datetime2 = new DateTime($date_end);//end time
		$durasi = $datetime1->diff($datetime2); 
		{
			return $durasi->d;
		}
		
	}
	function numberWithSpaces($num) {
        $currency = "Rp. ".number_format($num, 0, ",", ".");

        return $currency;
    }

	function name_notif(){
		$notif = Member::selectRaw('members.name,transactions.date_end,transactions.status')
					->join('transactions', 'transactions.members_id', '=', 'members.id')
					->orderBy('members.id')->get();	

		return $notif;
	}
	
	function amount_days($date_end) {
        $today = strtotime(date('d-m-Y'));
        $limit = strtotime($date_end);
        $amount = abs($today - $limit);
        $count_days = $amount/60/60/24;

        return $count_days;
    }
	
	function time_limit() {		
		$count_notif = Transaction::selectRaw('count(transactions.status) as time_limit')->where('transactions.status', '=', 0)->get();
		
		return $count_notif;		
	}

	
	
?>