<!DOCTYPE html>
<html>
<head>
	<title>Edit Katalog</title>
</head>

<?php
	include_once("../connect.php");
	$id_katalog = $_GET['id_katalog'];

	$buku = mysqli_query($mysqli, "SELECT * FROM buku");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");

    while($katalog_data = mysqli_fetch_array($katalog))
    {
    	$id_katalog = $katalog_data['id_katalog'];
    	$nama = $katalog_data['nama'];
    }
?>

<body>
	<a href="katalog.php">Go to Home</a>
	<br/><br/>
 
	<form action="katalog_edit.php?id_katalog=<?php echo $id_katalog; ?>" method="post">
		<table width="25%" border="0">
			<tr> 
				<td>ID Katalog</td>
				<td><input type="text" name="id_katalog" value="<?php echo $id_katalog; ?>"></td>
			</tr>
			<tr> 
				<td>Nama Katalog</td>
				<td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="update" value="update"></td>
			</tr>
		</table>
	</form>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$id_katalog = $_POST['id_katalog'];
			$nama = $_POST['nama'];
			
			include_once("../connect.php");

			$result = mysqli_query($mysqli, "UPDATE katalog SET nama = '$nama' WHERE id_katalog = '$id_katalog';");
			
			header("Location:katalog.php");
		}
	?>
</body>
</html>