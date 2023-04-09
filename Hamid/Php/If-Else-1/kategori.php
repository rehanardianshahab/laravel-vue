<?php

// Input data dari user
$nama = "Hamid"; //ganti dengan nama yang diinginkan
$tinggi_badan = 166.2; //cm
$berat_badan = 52; //kg

// Konversi tinggi badan dari cm ke meter
$tinggi_badan_m = $tinggi_badan / 100;

// Hitung BMI
$bmi = $berat_badan / ($tinggi_badan_m * $tinggi_badan_m);

// Tentukan kategori berat badan
if ($bmi < 18.5) {
    $kategori = "kurus";
} elseif ($bmi >= 18.5 && $bmi <= 24.9) {
    $kategori = "sedang";
} elseif ($bmi >= 25 && $bmi <= 29.9) {
    $kategori = "gemuk";
} else {
    $kategori = "obesitas";
}

// Hasil
echo "Halo, $nama. Nilai BMI anda adalah $bmi, anda termasuk dalam kategori $kategori.";

?>
