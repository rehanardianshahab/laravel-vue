<!DOCTYPE html>
<head>
    <title>Tambahkan Katalog</title> 
</head>

<?php
        include_once("koneksi.php");
    ?>

<body>

<a href="katalog.php">Back to Katalog</a>
	<br/><br/>
 
	<form action="add_katalog.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id_katalog"></td>
			</tr>

			<tr> 
				<td>Katalog</td>
				<td><input type="text" name="nama"></td>
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
			$id = $_POST['id_katalog'];
			$katalog = $_POST['nama'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `katalog` (`id_katalog`, `nama`) VALUES ('$id', '$katalog');");
			
			header("Location:katalog.php");
		}
    ?>
</body>
</html>