<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Katalog</title> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
        include_once("connect.php");
    ?>

<body>

<div class="container mt-4">
	<a class="btn btn-sm btn-primary" href="katalog.php"><i class="bi bi-arrow-left-square"></i> Back to Katalog</a>
		<br/><br/>
	
		<form action="add_katalog.php" method="post" name="form1">
			<!-- ID Katalog -->
			<div class="form-group">
				<label for="id_katalog">ID</label>
				<input type="text" name="id_katalog" class="form-control" id="id_katalog" placeholder="Masukkan ID Katalog">
			</div>

		<!-- Nama Katalog -->
			<div class="form-group">
				<label for="nama">Pengarang</label>
				<input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Katalog">
			</div>

			<button type="submit" name="Submit" class="btn btn-primary">Submit</button>
		</form>
</div>


	
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