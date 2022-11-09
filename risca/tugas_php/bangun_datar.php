<?php 
$A = "5 RUMUS MENGHITUNG LUAS BANGUN DATAR";
	
	function persegi_panjang (){
	 $p = 10;
	 $l = 2;
	 $luas = $p*$l;
	 echo " <b>1. Rumus Menghitung Luas Persegi Panjang</b><br>";
	 echo " Rumus Luas : L = Panjang x Lebar<br>";
	 echo " Panjang : $p cm<br>";
	 echo " Lebar : $l cm<br>";
	 echo " L = $p x $l <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}

	function segitiga (){
	 $p = 1/2;
	 $la = 10;
	 $t = 5;
	 $luas = $p*$la*$t;
	 echo " <b>2. Rumus Menghitung Luas Segitiga</b><br>";
	 echo " Rumus Luas : L = 1/2 x Luas Alas x Tinggi<br>";
	 echo " Luas Alas : $la cm<br>";
	 echo " Tinggi : $t cm<br>"; 
	 echo " L = 1/2 x $la x $t  <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}

	function layang_layang (){
	 $p = 1/2;
	 $d1 = 10;
	 $d2 = 2;
	 $luas = $p*$d1*$d2;
	 echo " <b>3. Rumus Menghitung Luas Layang-layang</b><br>";
	 echo " Rumus Luas : L = 1/2 x Diagonal 1 x Diagonal 2<br>";
	 echo " Diagonal 1 : $d1 cm<br>";
	 echo " Diagonal 2 : $d2 cm<br>"; 
	 echo " L = $p x $d1 x $d2  <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}

	function jajar_genjang (){
	 $la = 10;
	 $t = 5;
	 $luas = $la*$t;
	 echo " <b>4. Rumus Menghitung Luas Jajar Genjang</b><br>";
	 echo " Rumus Luas : L = Luas Alas x Tinggi<br>";
	 echo " Luas Alas : $la cm<br>";
	 echo " Tinggi : $t cm<br>"; 
	 echo " L = $la x $t  <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}

	function trapesium (){
	 $p = 1/2;
	 $r1 = 10;
	 $r2 = 2;
	 $t = 5;
	 $luas = $p*($r1+$r2)*$t;
	 echo " <b>5. Rumus Menghitung Luas Trapesium</b><br>";
	 echo " Rumus Luas : L = 1/2 x (Rusuk 1 + Rusuk 2) x Tinggi<br>";
	 echo " Rusuk 1 : $r1 cm<br>";
	 echo " Rusuk 2 : $r2 cm<br>"; 
	 echo " Tinggi  : $t cm<br>"; 
	 echo " L = $p x ($r1 + $r2) * $t <br>";
	 echo " Hasil Luas nya adalah : $luas ";
	}




	echo " <b>$A</b><br><br>";
	echo "<br>";
	persegi_panjang();
	echo "<br><br><br>";
	segitiga();
	echo "<br><br><br>";
	layang_layang();
	echo "<br><br><br>";
	jajar_genjang();
	echo "<br><br><br>";
	trapesium();
	echo "<br><br><br>";
?>