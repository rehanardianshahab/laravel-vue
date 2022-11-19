<?php 
// 1. Persegi Panjang
function luas_persegi_panjang($panjang, $lebar)
{
	$hasil = $panjang * $lebar;
	return $hasil;
}
 
echo "Hasil Luas Persegi Panjang dengan Panjang 10 dan Tinggi 15 = ".luas_persegi_panjang(10,5);
echo "<br>";
echo "Hasil Luas Persegi Panjang dengan Panjang 7 dan Tinggi 9 = ".luas_persegi_panjang(7,9);

echo "<hr>";

// 2. Segitiga
function luas_segitiga($alas, $tinggi)
{
	$luas = ($alas)/2 * $tinggi;
	return $luas;
}
echo "Hasil Luas Segitiga dengan alas 6 dan tinggi 15 = ".luas_segitiga(6,15);
echo "<br>";
echo "Hasil Luas Segitiga dengan alas 4 dan tinggi 8 = ".luas_segitiga(4,8);

echo "<hr>";

// 3. Jajar genjang
function luas_jajargenjang($alas, $tinggi)
{
	$luas = $alas * $tinggi;
	return $luas;
}
echo "Hasil Luas Jajar genjang dengan alas 14 dan tinggi 5 = ".luas_jajargenjang(14,5);
echo "<br>";
echo "Hasil Luas Jajar genjang dengan alas 4 dan tinggi 8 = ".luas_jajargenjang(4,8);

echo "<hr>";

// 4. Trapesium
function luas_trapesium($s1, $s2, $tinggi)
{
	$luas = ($s1 + $s2)/2 * $tinggi;
	return $luas;
}
echo "Hasil Luas Trapesium dengan sisi sejajar 12 dan 8 dan tinggi 7 = ".luas_trapesium(12,8,7);
echo "<br>";
echo "Hasil Luas Trapesium dengan sisi sejajar 15 dan 4 dan tinggi 6 = ".luas_trapesium(15,4,6);

echo "<hr>";

// 5. Lingkaran
function luas_lingkaran($v, $r)
{
	$luas = $v * $r * $r;
	return $luas;
}
echo "Hasil Luas lingkaran dengan Pi 22/7 dan jari-jari 21 = ".luas_lingkaran(22/7,21,21);
echo "<br>";
echo "Hasil Luas lingkaran dengan Pi 3.14 dan jari-jari 20 = ".luas_lingkaran(3.14,20,20);

echo "<hr>";
?>