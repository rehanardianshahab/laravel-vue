<?php 
function persegi_panjang ($p, $l){
	 $luas = $p*$l;
	 echo " <b>1. Rumus Menghitung Luas Persegi Panjang</b><br>";
	 echo " Luas = $p x $l <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}
	persegi_panjang(10,2);
	echo "<br><br>";

function segitiga ($alas, $tinggi){
	 $luas = ($alas)/2 * $tinggi;
	 echo " <b>2. Rumus Menghitung Luas segitiga</b><br>"; 
	 echo " Luas = ($alas)/2 x $tinggi  <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}
	segitiga(10,5);
	echo "<br><br><br>";

function layang_layang ($d1, $d2){
	 $luas = ($d1)/2 * $d2; 
	 echo " <b>3. Rumus Menghitung Luas Layang-layang</b><br>";
	 echo " Luas = ($d1) / 2 x $d2  <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}
	layang_layang (10,2);
	echo "<br><br><br>";

function kubus ($sisi){	
	 $volume = $sisi*$sisi*$sisi;
	 echo " <b>4. Rumus Menghitung Volume Kubus</b><br>";
	 echo " Volume = $sisi x $sisi x $sisi  <br>";
	 echo " Hasil Volume nya adalah : $volume ";
	}
	kubus(10);
	echo "<br><br><br>";

function prisma ($alas, $tinggi){
	 $volume = ($alas) / 3 *$tinggi; 
	 echo " <b>5. Rumus Menghitung Volume Prisma</b><br>";
	 echo " Volume = ($alas) / 3 x $tinggi  <br>";
	 echo " Hasil Volume nya adalah : $volume ";
	}
	prisma(10,3);

?>