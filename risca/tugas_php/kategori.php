<!DOCTYPE html>
<html>
<head>
	<title>Menghitung BMI</title>
</head>
<body>
	<h1>Menghitung BMI</h1>
	<form method="POST" action="">
		Nama<br>
		<input type="text" name="nama"><br>
		Jenis kelamin<br>
		<select name="kelamin">
		    <option value="Laki-laki">Laki-laki</option>
		    <option value="Perempuan">Perempuan</option>
		</select><br>
		Tinggi badan (cm) <br>
		<input type="number" name="tb"><br>
		Berat badan (kg)<br>
		<input type="number" name="bb"><br><br>
		<input type="submit" name="submit" value="Hitung BMI">
		<hr>
	</form>

	<?php
	if (isset($_POST['submit'])) {
	    $nama       = $_POST['nama'];
	    $kelamin    = $_POST['kelamin'];
	    $tb         = $_POST['tb']/100;
	    $bb         = $_POST['bb'];	   
	    $bmi        = $bb / ($tb * $tb);	 
	 
	    echo "<h3>Hasil perhitungan BMI</h3>";
	    echo "Halo $nama<br>";
	    echo "Jenis kelamin: $kelamin<br>";
	    echo "Tinggi Badan: $tb meter<br>";
	    echo "Berat Badan: $bb kilogram<br>";
	    echo "Nilai BMI Anda: ".number_format($bmi);
	    echo "<br>";
	    echo "Anda termasuk: ";
	    if($bmi < 18.5){
                echo "Kurus";
            }else if(($bmi >= 18.5) && ($bmi <= 25)){
                echo "Normal";
            }else if(($bmi > 24.9) && ($bmi <=30)){
                echo "Gemuk";
            }else{
                echo "Obesitas";
            }		  
		}
	?>


</body>
</html>
 