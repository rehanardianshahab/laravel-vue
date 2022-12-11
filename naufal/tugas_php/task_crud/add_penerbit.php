<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Penerbit</title> 
</head>

<?php
        include_once("connect.php");
    ?>

<body>

<a href="penerbit.php">Back to Penerbit</a>
	<br/><br/>
 
	<form action="add_penerbit.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id_penerbit"></td>
			</tr>

			<tr> 
				<td>Penerbit</td>
				<td><input type="text" name="nama_penerbit"></td>
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
			$id = $_POST['id_penerbit'];
			$penerbit = $_POST['nama_penerbit'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `email`, `telp`, `alamat`) VALUES ('$id', '$penerbit', '$email', '$telp', '$alamat');");
			
			header("Location:penerbit.php");
		}
    ?>
</body>
</html>