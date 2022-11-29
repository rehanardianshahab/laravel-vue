<?php
    require 'databases.php';

    $belum_pinjam = "SELECT anggota.* FROM `anggota` LEFT OUTER JOIN `peminjaman` ON peminjaman.id_anggota = anggota.id_anggota WHERE peminjaman.id_anggota IS NULL AND NOT role = 'admin';";
    $belum_pinjam = query($belum_pinjam);
    // var_dump($belum_pinjam);
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
  <div class="badan">
    <p>Daftar anggota yang belum pernah meminjam buku :</p>
    <?php $i = 0; ?>
    <table>
        <thead>
          <tr>
            <td>No</td><td>Nama</td><td>Alamat</td><td>Gender</td><td>Tgl. Pendaftaran</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $belum_pinjam as $datum ) : ?>
            <?php $i++; ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $datum['nama']; ?></td>
              <td><?= $datum['alamat']; ?></td>
              <td><?= $datum['sex']; ?></td>
              <td><?= $datum['tgl_entry']; ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
  </div>
</body>
</html>