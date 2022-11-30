<?php
  // ambil file database dan function
    require '../databases.php';
    require '../function.php';

  // buat sintaks query
    $data_buku = "SELECT * FROM buku";

  // fetch datanya dengan fungsi query (dari file databases)
    $data_buku = query($data_buku);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <style>
        table {
          border-collapse: collapse;
      }
      th, td {
          border: solid 1px black;
          padding: 0.5rem;
      }
      tbody tr:nth-child(odd) {
          background-color: lightgray;   
      }
    </style>
</head>
<body>
  <nav>
    <a>Buku</a><a>Anggota</a><a>Katalog</a>
  </nav>
  <hr /><br />
  <a href="tambah.php">
    <button type="button">Tambah Data</button>
  </a>
  <main>
    <?php $i = 0; ?>
    <table>
        <thead>
          <tr>
            <td>No</td>
            <td>Isbn</td>
            <td>Judul</td>
            <td>Tahun</td>
            <td>Id Penerbit</td>
            <td>Id Pengarang</td>
            <td>Id Katalog</td>
            <td>Stok</td>
            <td>Biaya Sewa</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $data_buku as $datum ) : ?>
            <?php $i++; ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $datum['isbn']; ?></td>
              <td><?= $datum['judul']; ?></td>
              <td><?= $datum['tahun']; ?></td>
              <td><?= $datum['id_penerbit']; ?></td>
              <td><?= $datum['id_pengarang']; ?></td>
              <td><?= $datum['id_katalog']; ?></td>
              <td><?= $datum['qty_stok']; ?> Buah</td>
              <td>Rp.<?= $datum['harga_pinjam']; ?>,-</td>
              <td><a href="edit.php?isbn=<?= $datum["isbn"]; ?>">Edit</a> | 
                  <a href="hapus.php?isbn=<?= $datum["isbn"]; ?>" onclick="return confirm('yakin mau menghapus data ini?')">Hapus</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
  </main>
</body>
</html>