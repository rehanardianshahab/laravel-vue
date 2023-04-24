<html>
<head>
	<title>Edit Penerbit</title>
</head>

<?php
	include_once("koneksi.php");
	$id = $_GET['id_penerbit'];

    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit WHERE id_penerbit = '$id' ");

    while($penerbit_data = mysqli_fetch_array($penerbit))
    {
    	$nama_penerbit = $penerbit_data['nama_penerbit'];
    	$id = $penerbit_data['id_penerbit'];
    	$email = $penerbit_data['email'];
    	$telp = $penerbit_data['telp'];
    	$alamat = $penerbit_data['alamat'];
    }
?>
 
<body>
	<a href="penerbit.php">Kembali Ke Beranda</a>
	<br/><br/>
 
	<form action="edit_penerbit.php?id_penerbit=<?php echo $id; ?>" method="post">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td style="font-size: 11pt;"><?php echo $id; ?> </td>
			</tr>
			<tr> 
				<td>Penerbit</td>
				<td><input type="text" name="nama_penerbit" value="<?php echo $nama_penerbit; ?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="email" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr> 
				<td>Telp</td>
				<td><input type="text" name="telp" value="<?php echo $telp ?>"></td>
			</tr>
			<tr> 
				<td>Alamat</td>
				<td><textarea type="text" name="alamat" ><?php echo $alamat ?></textarea></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$id = $_GET['id_penerbit'];
			$nama_penerbit = $_POST['nama_penerbit'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "UPDATE penerbit SET nama_penerbit = '$nama_penerbit', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_penerbit = '$id';");
			
			header("Location:penerbit.php");
		}
	?>
</body>
</html>