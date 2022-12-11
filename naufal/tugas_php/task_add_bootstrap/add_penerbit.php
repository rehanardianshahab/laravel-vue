<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Penerbit</title> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
        include_once("connect.php");
    ?>

<body>

<div class="container mt-4">
	<a class="btn btn-sm btn-primary" href="penerbit.php"><i class="bi bi-arrow-left-square"></i>  Back to Penerbit</a>
		<br/><br/>

	<form action="add_penerbit.php" method="post" name="form1">
		<!-- ID Penerbit -->
		<div class="form-group">
			<label for="id_penerbit">ID</label>
			<input type="text" name="id_penerbit" class="form-control" id="id_penerbit" placeholder="Masukkan ID Penerbit">
		</div>

		<!-- Nama Penerbit -->
		<div class="form-group">
			<label for="nama_penerbit">Penerbit</label>
			<input type="text" name="nama_penerbit" class="form-control" id="nama_penerbit" placeholder="Masukkan Nama Penerbit">
		</div>

		<!-- Email -->
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email Penerbit">
		</div>

		<!-- Telpon -->
		<div class="form-group">
			<label for="telp">Telp</label>
			<input type="text" name="telp" class="form-control" id="telp" placeholder="Masukkan Nomor Telpon Penerbit">
		</div>

		<!-- Alamat -->
		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Penerbit"></textarea>
		</div>
		<button type="submit" name="Submit" class="btn btn-primary">Submit</button>
	</form>
</div>
	
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