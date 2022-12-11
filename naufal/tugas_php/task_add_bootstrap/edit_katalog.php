<html>
<head>
	<title>Edit Katalog</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
	include_once("connect.php");
	$id = $_GET['id_katalog'];

    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog WHERE id_katalog = '$id' ");

    while($katalog_data = mysqli_fetch_array($katalog))
    {
    	$nama_katalog = $katalog_data['nama'];
    	$id = $katalog_data['id_katalog'];
    }
?>
 
<body>

<div class="container mt-4">
	<a class="btn btn-sm btn-primary" href="katalog.php"><i class="bi bi-arrow-left-square"></i>Back to Katalog</a>
	<br/><br/>

	<form action="edit_katalog.php?id_katalog=<?php echo $id; ?>" method="post" name="form1">
			<!-- ID Katalog -->
			<div class="form-group">
				<label for="id_katalog">ID</label>
				<input type="text" readonly name="id_katalog" class="form-control-plaintext" id="id_katalog" value="<?php echo $id; ?>">
			</div>

		<!-- Nama Katalog -->
			<div class="form-group">
				<label for="nama">Pengarang</label>
				<input type="text" name="nama" class="form-control" id="nama" value="<?php echo $nama_katalog; ?>">
			</div>

			<button type="submit" name="update" class="btn btn-primary">Submit</button>
		</form>
</div>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$id = $_GET['id_katalog'];
			$nama_katalog = $_POST['nama'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "UPDATE katalog SET nama = '$nama_katalog' WHERE id_katalog = '$id';");
			
			header("Location:katalog.php");
		}
	?>
</body>
</html>