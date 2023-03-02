<?php

function money_format($number, $sparator = ',', $currency = '', $ending = '')
{
    return $currency. ''. number_format($number, 0, ',', $sparator). $ending;
}

function terbilang($angka, $mata_uang = '')
{
    $angka = abs($angka);
    $cara_baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $terbilang = '';

    if ( $angka < 12 ) $terbilang = $cara_baca[$angka] . $mata_uang;
    elseif ( $angka < 20 ) $terbilang = terbilang($angka-10) . ' belas' . $mata_uang;
    elseif ( $angka < 100 ) $terbilang = terbilang($angka/10) . ' puluh ' . terbilang($angka % 10) . $mata_uang;
    elseif( $angka < 200 ) $terbilang = 'seratus ' . terbilang($angka - 100);
    elseif( $angka < 1000 ) $terbilang = terbilang($angka/100) . ' ratus ' . terbilang($angka%100) . $mata_uang;
    elseif( $angka < 2000 ) $terbilang = 'seribu ' . terbilang($angka-1000);
    elseif( $angka < 1000000 ) $terbilang = terbilang($angka/1000) . ' ribu ' . terbilang($angka%1000) . $mata_uang;
    elseif( $angka < 2000000 ) $terbilang = 'satu juta ' . terbilang($angka-1000000) . $mata_uang;
    elseif( $angka < 1000000000 ) $terbilang = terbilang($angka/1000000) . ' juta ' . terbilang($angka%1000000) . $mata_uang;
    elseif( $angka < 2000000000 ) $terbilang = 'satu miliar ' . terbilang($angka-1000000000) . $mata_uang;
    elseif( $angka < 1000000000000 ) $terbilang = terbilang($angka/1000000000) . ' miliar, ' . terbilang($angka%1000000000) . $mata_uang;
    elseif( $angka < 2000000000000 ) $terbilang = 'satu triliun, ' . terbilang($angka-1000000000000) . $mata_uang;
    elseif( $angka < 1000000000000000 ) $terbilang = terbilang($angka/1000000000000) . ' triliun, ' . terbilang($angka%1000000000000) . $mata_uang;

    return trim($terbilang);
}

function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu');
    $nama_bulan = array(1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );
    
    $tahun = substr($tgl, 0, 4);
    $bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text = '';

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= "$hari, $tanggal $bulan $tahun";
        
        return $text;
    }

    $text .= "$tanggal $bulan $tahun";

    return $text;
}

function add_nol($value, $threshod = null)
{
    return sprintf("%0".$threshod."s", $value);
}