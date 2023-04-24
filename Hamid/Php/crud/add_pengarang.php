<!DOCTYPE html>
<head>
    <title>Tambahkan Pengarang</title> 
</head>

<?php
        include_once("koneksi.php");
    ?>

<body>

<a href="pengarang.php">Back to Pengarang</a>
	<br/><br/>
 
	<form action="add_pengarang.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id_pengarang"></td>
			</tr>

			<tr> 
				<td>Pengarang</td>
				<td><input type="text" name="nama_pengarang"></td>
			</tr>

			<tr> 
				<td>Email</td>
				<td><input type="email" name="email"></td>
			</tr>
			
			<tr> 
				<td>Telp</td>
				<td><input type="text" name="telp"></td>
			</tr>

			<tr> 
				<td>Alamat</td>
				<td><textarea type="text" name="alamat"></textarea></td>
			</tr>

			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
			$id = $_POST['id_pengarang'];
			$penerbit = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`) VALUES ('$id', '$penerbit', '$email', '$telp', '$alamat');");
			
			header("Location:pengarang.php");
		}
    ?>
</body>
</html>