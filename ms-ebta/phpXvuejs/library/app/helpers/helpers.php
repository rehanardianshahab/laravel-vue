<?php
function epochtotime($data)
{
    return date('H:i:s - d/M/Y', $data);
}
function tanggal($data) {
    return date('H:i:s - d/M/Y', strtotime($data));
}
function tanggalNoTime($data) {
    return date('d/M/Y', strtotime($data));
}
function durasi($awal, $akhir)
{
    $date1 = $awal;
    $date2 = $akhir;

    $diff = strtotime($date2) - strtotime($date1);

    // return $diff;
    $years = $diff / (365*60*60*24);
    $months = $diff / (30*60*60*24);
    $days = $diff/ (60*60*24);

    // pesan
    $pesan = intval($days). ' hari';

    if ($days > 30) {
        $months = ($diff) / (30*60*60*24);
        $days = ($diff-$months)/ (60*60*24);
        $pesan = intval($months). ' bulan '. intval($days). ' hari';
    } elseif ($months > 12) {
        $years = $diff / (365*60*60*24);
        $months = ($diff - $years * 365*60*60*24) / (30*60*60*24);
        $days = ($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24);
        $pesan = intval($years). ' tahun '.intval($months). ' bulan '. intval($days). ' hari';
    }

    return $pesan;
}
function uang($angka, $curr=''){

	$hasil_rupiah = $curr." " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
function notif($time, $nama)
{
    $years = $time / (365*60*60*24);
    $months = $time / (30*60*60*24);
    $days = $time/ (60*60*24);

    $pesan = $nama.' melewati batas waktu '.intval($days).' hari';

    if ($days > 30) {
        $months = ($time) / (30*60*60*24);
        $days = ($time-$months)/ (60*60*24);

        $pesan = $nama.' melewati batas waktu '.intval($months). ' bulan '. intval($days). ' hari';
    } elseif ($months > 12) {
        $years = $time / (365*60*60*24);
        $months = ($time - $years * 365*60*60*24) / (30*60*60*24);
        $days = ($time - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24);
        $pesan = $nama.' melewati batas waktu '.intval($years). ' tahun '.intval($months). ' bulan '. intval($days). ' hari';
    }

    return $pesan;
}

function findObjectInArray($KeyValue, $keyName, $arr, $returning = false){
        
    foreach ( $arr as $element ) {
        if ( $KeyValue == $element[$keyName] ) {
            return $element;
        }
    }
    return $returning;

}
