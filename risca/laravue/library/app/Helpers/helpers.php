<?php 

	function convert_date($value) {
		return date('H:i:s - d M Y', strtotime($value));
	}

	function status($status) {
		if($status == 1) {
			$status = 'Returned';
		  }
		  else {
			$status = 'Unreturned';
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

?>