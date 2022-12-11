<?php
// 1. Persegi
function luas_persegi($sisi)
{
	$hasil = $sisi * $sisi;
	return $hasil;
}
 
echo "Hasil Luas Persegi dengan memiliki sisi 8  = ".luas_persegi(8,8);
echo "<br>";
echo "Hasil Luas Persegi dengan memiliki sisi 9 = ".luas_persegi(9,9);

echo "<hr>";

// 2. Layang-Layang
function luas_layanglayang($diagonal1, $diagonal2)
{
	$hasil = ($diagonal1 * $diagonal2)/2;
	return $hasil;
}
 
echo "Hasil Luas Layang-layang memiliki ukuran diagonal 8 dan 10  = ".luas_layanglayang(8,10);
echo "<br>";
echo "Hasil Luas Layang-layang memiliki ukuran diagonal 24 dan 10 = ".luas_layanglayang(24,10);

echo "<hr>";

// 3. Segitiga
function luas_segitiga($alas, $tinggi)
{
	$hasil = ($alas)/2 * $tinggi;
	return $hasil;
}
echo "Hasil Luas Segitiga dengan alas 6 dan tinggi 15 = ".luas_segitiga(6,15);
echo "<br>";
echo "Hasil Luas Segitiga dengan alas 4 dan tinggi 8 = ".luas_segitiga(4,8);

echo "<hr>";

// 4. Kubus
function volume_kubus($sisi)
{
	$hasil = $sisi * $sisi * $sisi;
	return $hasil;
}
 
echo "Hasil Volume Kubus dengan memiliki sisi 6 = ".volume_kubus(6, 6, 6);
echo "<br>";
echo "Hasil Volume Kubus dengan memiliki sisi 12 = ".volume_kubus(12,12,12);

echo "<hr>";

// 5. Tabung
function volume_bola($pi, $jari)
{
	$hasil = 4/3 * $pi * $jari * $jari * $jari;
	return $hasil;
}
 
echo "Hasil Volume Bola dengan Phi 3.14, dan jari-jari 30 = ".volume_bola(3.14,30,30,30);
echo "<br>";
echo "Hasil Volume Bola dengan Phi 22/7, dan jari-jari 21 = ".volume_bola(22/7,21,21,21);
?>