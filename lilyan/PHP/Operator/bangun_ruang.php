<?php 
// 1. Balok
function volume_balok($panjang, $lebar, $tinggi)
{
	$hasil = $panjang * $lebar * $tinggi;
	return $hasil;
}
 
echo "Hasil Volume Balok dengan Panjang 12, lebar 7, dan Tinggi 8 = ".volume_balok(12, 7, 8);
echo "<br>";
echo "Hasil Volume Balok dengan Panjang 18, lebar 12, dan Tinggi 111 = ".volume_balok(18,12,11);

echo "<hr>";

// 2. Limas Segi empat
function volume_limas($panjang, $lebar, $tinggi)
{
	$hasil = ($panjang *$lebar * $tinggi)/3;
	return $hasil;
}
 
echo "Hasil Volume volume limas segiempat dengan panjang 6, lebar 4, dan tinggi 9 = ".volume_limas(6,4,9);
echo "<br>";
echo "Hasil Volume volume limas segiempat dengan panjang 18, lebar 32, dan tinggi 42 = ".volume_limas(18,32,42);

echo "<hr>";

// 3. Tabung
function volume_bola($pi, $jari)
{
	$hasil = 4/3 * $pi * $jari * $jari * $jari;
	return $hasil;
}
 
echo "Hasil Volume Bola dengan Phi 3.14, dan jari-jari 30 = ".volume_bola(3.14,30,30,30);
echo "<br>";
echo "Hasil Volume Bola dengan Phi 22/7, dan jari-jari 21 = ".volume_bola(22/7,21,21,21);
?>