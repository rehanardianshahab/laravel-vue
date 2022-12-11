<?php

$nama = "Lilyan Arhatia Agustine";
$berat_badan = 50;
$tinggi_badan = 1.60; // Contoh tb 160cm dapat ditulis dengan 1.60 meter

$hasil_bmi = $berat_badan / pow($tinggi_badan,2);

if  ($hasil_bmi < 18.5) {
    echo "Halo, $nama. Nilai BMI anda adalah $hasil_bmi, anda termasuk Kurus";
} else if ($hasil_bmi < 25) {
    echo "Halo, $nama. Nilai BMI anda adalah $hasil_bmi, anda termasuk Normal";
} else if ($hasil_bmi < 30) {
    echo "Halo, $nama. Nilai BMI anda adalah $hasil_bmi, anda termasuk Gemuk";
} else if ($hasil_bmi > 30) {
    echo "Halo, $nama. Nilai BMI anda adalah $hasil_bmi, anda termasuk Obesitas";
} 

?>