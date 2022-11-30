<?php
  // ambil file database dan function
    require '../databases.php';
    require '../function.php';

  // buat sintaks query
    $data_katalogue = "SELECT * FROM katalog";

  // fetch datanya dengan fungsi query (dari file databases)
    $data_katalogue = query($data_katalogue);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Katalog</title>
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
            <td>Id Katalog</td>
            <td>Nama Katalog</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $data_katalogue as $datum ) : ?>
            <?php $i++; ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $datum['id_katalog']; ?></td>
              <td><?= $datum['nama']; ?></td>
              <td><a href="edit.php?id_katalog=<?= $datum["id_katalog"]; ?>">Edit</a> | 
                  <a href="hapus.php?id_katalog=<?= $datum["id_katalog"]; ?>" onclick="return confirm('yakin mau menghapus data ini?')">Hapus</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
  </main>
</body>
</html>