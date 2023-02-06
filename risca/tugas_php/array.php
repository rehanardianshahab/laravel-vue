
<?php 	
	$array = file_get_contents('data.json');
	$data = json_decode($array, true);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Array</title>
</head>
<body>
	<table border="1" cellspacing="0">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Tanggal Lahir</th>
				<th>Umur</th>
				<th>Alamat</th>
				<th>Kelas</th>
				<th>Nilai</th>
				<th>Hasil</th>
			</tr>				

			    <?php  for($a=0; $a<count($data); $a++) { ?>
			    <?php 
					$tahun_lahir = date('Y', strtotime($data[$a]['tanggal_lahir']));
					$tahun_sekarang = date('Y');
					$umur = $tahun_sekarang - $tahun_lahir;
				?>
				<?php
				 	$nilai = $data[$a]['nilai'];

					if ($nilai >= 90) {
					    $grade = "A";
					} elseif($nilai >= 80){
					    $grade = "B";
					} elseif($nilai >= 70){
					    $grade = "C";
					} else {
					    $grade = "D";
					}
				?>
			    <tr>
			    	<td><?php echo $a; ?></td> 
			    	<td><?php echo $data[$a]['nama']; ?></td>
			    	<td><?php echo $data[$a]['tanggal_lahir']; ?></td>
			    	<td><?php echo $umur; ?> </td>
			    	<td><?php echo $data[$a]['alamat']; ?></td>
			    	<td><?php echo $data[$a]['kelas']; ?></td>
			    	<td><?php echo $data[$a]['nilai']; ?></td>
			    	<td><?php echo $grade; ?></td>
			    </tr>

			     
 			    <?php } ?>
	
	</table>
</body>
</html>

	
	

		

