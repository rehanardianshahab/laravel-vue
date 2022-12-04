<?php
  // ambil file database dan function
    require '../databases.php';
    require '../function.php';

  // buat sintaks query
    $data_penerbit = "SELECT * FROM penerbit";

  // fetch datanya dengan fungsi query (dari file databases)
    $data_penerbit = query($data_penerbit);

  // menjaankan pencarian
  if (isset($_POST['cari'])) {
    // query untuk syarat search
    $keyword = $_POST['keyword'];
		$query = "SELECT * FROM penerbit WHERE
    id_penerbit LIKE '%$keyword%' OR
    nama_penerbit LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    alamat LIKE '%$keyword%'";
    // jalankan fungsinya
    $data_penerbit = cari($query);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Katalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <nav>
    <?php require '../navigasi.php'; ?>
  </nav>
  
  <br />
  
  <main>
  
    <a href="tambah.php">
      <button type="button">Tambah Data</button>
    </a>

    <br><br>
    <form action="" method="post">
      <input class="cari" type="text" name="keyword" size="50" autofocus placeholder="Masukkan Keyword" autocomplete="off">
      <button type="submit" name="cari">Cari Data</button>
      <?php if (isset($_POST['cari'])) : ?>
        <a href="index.php">
          <button type="button">Tampilkan Semua Data</button>
        </a>
      <?php endif ?>
    </form>
    <br />

    <?php $i = 0; ?>
    <table>
        <thead>
          <tr>
            <td>No</td>
            <td>Id penerbit</td>
            <td>Nama penerbit</td>
            <td>Email</td>
            <td>No. Telp</td>
            <td>Alamat</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $data_penerbit as $datum ) : ?>
            <?php $i++; ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $datum['id_penerbit']; ?></td>
              <td><?= $datum['nama_penerbit']; ?></td>
              <td><?= $datum['email']; ?></td>
              <td><?= $datum['telp']; ?></td>
              <td><?= $datum['alamat']; ?></td>
              <td><a href="edit.php?id_penerbit=<?= $datum["id_penerbit"]; ?>">Edit</a> | 
                  <a href="hapus.php?id_penerbit=<?= $datum["id_penerbit"]; ?>" onclick="return confirm('yakin mau menghapus data ini?')">Hapus</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
  </main>
</body>
</html>