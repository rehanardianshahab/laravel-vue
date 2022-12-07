<html>
<head>
	<title>Edit Buku</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
	include_once("connect.php");
	$isbn = $_GET['isbn'];

	$buku = mysqli_query($mysqli, "SELECT * FROM buku WHERE isbn='$isbn'");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");

    while($buku_data = mysqli_fetch_array($buku))
    {
    	$judul = $buku_data['judul'];
    	$isbn = $buku_data['isbn'];
    	$tahun = $buku_data['tahun'];
    	$id_penerbit = $buku_data['id_penerbit'];
    	$id_pengarang = $buku_data['id_pengarang'];
    	$id_katalog = $buku_data['id_katalog'];
    	$qty_stok = $buku_data['qty_stok'];
    	$harga_pinjam = $buku_data['harga_pinjam'];
    }
?>
 
<body>

<div class="container mt-4">
	<a class="btn btn-sm btn-primary" href="index.php"><i class="bi bi-arrow-left-square"></i> Go to Home</a>
	<br/><br/>

	<form action="edit.php?isbn=<?php echo $isbn; ?>" method="post" name="form1">
			<!-- ISBN -->
			<div class="form-group">
				<label for="isbn">ISBN</label>
				<input type="text" readonly name="isbn" class="form-control-plaintext" id="isbn" value="<?php echo $isbn; ?>">
			</div>

			<!-- Judul -->
			<div class="form-group">
				<label for="judul">Judul</label>
				<input type="text" name="judul" class="form-control" id="judul" value="<?php echo $judul; ?>">
			</div>

			<!-- Tahun -->
			<div class="form-group">
				<label for="tahun">Tahun</label>
				<input type="year" name="tahun" class="form-control" id="tahun" value="<?php echo $tahun; ?>">
			</div>

			<!-- Penerbit -->
			<div class="form-group">
				<label for="id_penerbit">Penerbit</label>
				<select name="id_penerbit" class="custom-select">
					<?php 
						echo "<option>--Pilih Penerbit--</option>";
						while($penerbit_data = mysqli_fetch_array($penerbit)) {         
							echo "<option ".($penerbit_data['id_penerbit'] == $id_penerbit ? 'selected' : '')." value='".$penerbit_data['id_penerbit']."'>".$penerbit_data['nama_penerbit']."</option>";
						}
							?>
				</select>
			</div>

			<!-- Pengarang -->
			<div class="form-group">
				<label for="id_pengarang">Pengarang</label>
				<select name="id_pengarang" class="custom-select">
					<?php 
						echo "<option>--Pilih Pengarang--</option>";
						while($pengarang_data = mysqli_fetch_array($pengarang)) {         
							echo "<option ".($pengarang_data['id_pengarang'] == $id_pengarang ? 'selected' : '')." value='".$pengarang_data['id_pengarang']."'>".$pengarang_data['nama_pengarang']."</option>";
						}
							?>
				</select>
			</div>

			<!-- Katalog -->
			<div class="form-group">
				<label for="id_katalog">Katalog</label>
				<select name="id_katalog" class="custom-select">
					<?php
						echo "<option>--Pilih Katalog--</option>";
						while($katalog_data = mysqli_fetch_array($katalog)) {         
							echo "<option ".($katalog_data['id_katalog'] == $id_katalog ? 'selected' : '')." value='".$katalog_data['id_katalog']."'>".$katalog_data['nama']."</option>";
						}
					?>
				</select>
			</div>

			<!-- Quantity Stok -->
			<div class="form-group">
				<label for="qty_stok">Quantity Stok</label>
				<input type="number" name="qty_stok" class="form-control" id="qty_stok" value="<?php echo $qty_stok; ?>">
			</div>

			<!-- Harga Pinjam -->
			<div class="form-group">
				<label for="harga_pinjam">Harga Pinjam</label>
				<input type="number" name="harga_pinjam" class="form-control" id="harga_pinjam" value="<?php echo $harga_pinjam; ?>">
			</div>

			<input type="submit" name="update" value="Add" class="btn btn-primary"></input>
		</form>
</div>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$isbn = $_GET['isbn'];
			$judul = $_POST['judul'];
			$tahun = $_POST['tahun'];
			$id_penerbit = $_POST['id_penerbit'];
			$id_pengarang = $_POST['id_pengarang'];
			$id_katalog = $_POST['id_katalog'];
			$qty_stok = $_POST['qty_stok'];
			$harga_pinjam = $_POST['harga_pinjam'];
			
			include_once("connect.php");

			$disable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=0");
			$result = mysqli_query($mysqli, "UPDATE buku SET judul = '$judul', tahun = '$tahun', id_penerbit = '$id_penerbit', id_pengarang = '$id_pengarang', id_katalog = '$id_katalog', qty_stok = '$qty_stok', harga_pinjam = '$harga_pinjam' WHERE isbn = '$isbn';");
			$enable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=1");
			
			header("Location:index.php");
		}
	?>
</body>
</html>