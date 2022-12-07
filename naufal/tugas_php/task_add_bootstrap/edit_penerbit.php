<html>
<head>
	<title>Edit Penerbit</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
	include_once("connect.php");
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

<div class="container mt-4">
	<a class="btn btn-sm btn-primary" href="penerbit.php"><i class="bi bi-arrow-left-square"></i> Back to Penerbit</a>
	<br/><br/>

	<form action="edit_penerbit.php?id_penerbit=<?php echo $id; ?>" method="post" name="form1">
		<!-- ID Penerbit -->
		<div class="form-group">
			<label for="id_penerbit">ID</label>
			<input type="text" readonly name="id_penerbit" class="form-control-plaintext" id="id_penerbit" value="<?php echo $id; ?>">
		</div>

		<!-- Nama Penerbit -->
		<div class="form-group">
			<label for="nama_penerbit">Penerbit</label>
			<input type="text" name="nama_penerbit" class="form-control" id="nama_penerbit" value="<?php echo $nama_penerbit; ?>">
		</div>

		<!-- Email -->
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
		</div>

		<!-- Telpon -->
		<div class="form-group">
			<label for="telp">Telp</label>
			<input type="text" name="telp" class="form-control" id="telp" value="<?php echo $telp; ?>">
		</div>

		<!-- Alamat -->
		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea type="text" name="alamat" class="form-control" id="alamat"> <?php echo $alamat ?></textarea>
		</div>
		<button type="submit" name="update" class="btn btn-primary">Submit</button>
	</form>
</div>
	
	
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