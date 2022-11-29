<?php
  // ambil file database dan function
    require '../databases.php';
    require '../function.php';

  // buat sintaks query
    $data_anggota = "SELECT * FROM anggota";

  // fetch datanya dengan fungsi query (dari file databases)
    $data_anggota = query($data_anggota);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data anggota</title>
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
    <button>Tambah Data</button>
  </a>
  <main>
    <?php $i = 0; ?>
    <table>
        <thead>
          <tr>
            <td>No</td>
            <!-- <td>id</td> -->
            <td>Nama</td>
            <td>Username</td>
            <td>Password</td>
            <td>Gender</td>
            <td>Telp</td>
            <td>Alamat</td>
            <td>Email</td>
            <td>tanggal Pendaftaran</td>
            <td>Akun</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $data_anggota as $datum ) : ?>
            <?php $i++; ?>
            <tr>
              <td><?= $i; ?></td>
              <!-- <td><?= $datum['id_anggota']; ?></td> -->
              <td><?= $datum['nama']; ?></td>
              <td><?= $datum['username']; ?></td>
              <td><?= $datum['password']; ?></td>
              <td><?= $datum['sex']; ?></td>
              <td><?= $datum['telp']; ?></td>
              <td><?= $datum['alamat']; ?></td>
              <td><?= $datum['email']; ?></td>
              <td><?= $datum['tgl_entry']; ?></td>
              <td><?= $datum['role']; ?></td>
              <td><a href="edit.php?id_anggota=<?= $datum["id_anggota"]; ?>">Edit</a> | 
                  <a href="hapus.php?id_anggota=<?= $datum["id_anggota"]; ?>" onclick="return confirm('yakin mau menghapus data ini?')">Hapus</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
  </main>
</body>
</html>