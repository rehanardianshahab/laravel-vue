<html>
<head>
	<title>Edit Pengarang</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
	include_once("connect.php");
	$id = $_GET['id_pengarang'];

    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang WHERE id_pengarang = '$id' ");

    while($pengarang_data = mysqli_fetch_array($pengarang))
    {
    	$nama_pengarang = $pengarang_data['nama_pengarang'];
    	$id = $pengarang_data['id_pengarang'];
    	$email = $pengarang_data['email'];
    	$telp = $pengarang_data['telp'];
    	$alamat = $pengarang_data['alamat'];
    }
?>
 
<body>

<div class="container mt-4">
<a class="btn btn-sm btn-primary" href="pengarang.php"><i class="bi bi-arrow-left-square"></i> Back to Pengarang</a>
	<br/><br/>

	<form action="edit_pengarang.php?id_pengarang=<?php echo $id; ?>" method="post" name="form1">
		<!-- ID Pengarang -->
		<div class="form-group">
			<label for="id_pengarang">ID</label>
			<input type="text" name="id_pengarang" readonly class="form-control-plaintext" id="id_pengarang" value="<?php echo $id; ?>">
		</div>

		<!-- Nama pengarang -->
		<div class="form-group">
			<label for="nama_pengarang">Pengarang</label>
			<input type="text" name="nama_pengarang" class="form-control" id="nama_pengarang" value="<?php echo $nama_pengarang; ?>">
		</div>

		<!-- Email -->
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
		</div>

		<!-- Telpon -->
		<div class="form-group">
			<label for="telp">Telp</label>
			<input type="text" name="telp" class="form-control" id="telp" value="<?php echo $telp ?>">
		</div>

		<!-- Alamat -->
		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea type="text" name="alamat" class="form-control" id="alamat"><?php echo $alamat ?></textarea>
		</div>
		<button type="submit" name="update" class="btn btn-primary">Submit</button>
	</form>
 
	<!-- <form action="edit_pengarang.php?id_pengarang=<?php echo $id; ?>" method="post">
		<table width="25%" border="0">
			<tr> 
				<td>ID</td>
				<td style="font-size: 11pt;"><?php echo $id; ?> </td>
			</tr>
			<tr> 
				<td>Pengarang</td>
				<td><input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>"></td>
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
	</form> -->
</div>

	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$id = $_GET['id_pengarang'];
			$nama_pengarang = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "UPDATE pengarang SET nama_pengarang = '$nama_pengarang', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_pengarang = '$id';");
			
			header("Location:pengarang.php");
		}
	?>
</body>
</html>