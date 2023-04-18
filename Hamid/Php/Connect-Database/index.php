<?php
require 'connect.php';

// Query untuk menampilkan anggota yang belum pernah meminjam buku
$belum_pinjam = "SELECT * FROM anggota WHERE id_anggota NOT IN (SELECT id_anggota FROM peminjaman) AND role <> 'admin'";
$belum_pinjam_result = mysqli_query($conn, $belum_pinjam);

// Query untuk menampilkan anggota yang sudah pernah meminjam buku
$sudah_pinjam = "SELECT DISTINCT anggota.* FROM anggota INNER JOIN peminjaman ON anggota.id_anggota = peminjaman.id_anggota";
$sudah_pinjam_result = mysqli_query($conn, $sudah_pinjam);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Anggota</title>
  <style>
    table {
      border-collapse: collapse;
    }

    th,
    td {
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
    <table>
      <thead>
        <tr>
          <td>No</td>
          <td>Nama</td>
          <td>Alamat</td>
          <td>Gender</td>
          <td>Tgl. Pendaftaran</td>
        </tr>
      </thead>
      <tbody>
        <?php if(mysqli_num_rows($belum_pinjam_result) > 0) {
          $i = 1;
          while($row = mysqli_fetch_assoc($belum_pinjam_result)) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['sex'] ?></td>
            <td><?= $row['tgl_entry'] ?></td>
          </tr>
          <?php $i++;
          }
        } else { ?>
        <tr>
          <td colspan="5">Tidak ada data yang tersedia</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <br />

    <p>Daftar anggota yang sudah pernah meminjam buku :</p>
    <table>
      <thead>
        <tr>
          <td>No</td>
          <td>Nama</td>
          <td>Alamat</td>
          <td>Gender</td>
          <td>Tgl. Pendaftaran</td>
        </tr>
      </thead>
      <tbody>
        <?php if(mysqli_num_rows($sudah_pinjam_result) > 0) {
          $i = 1;
          while($row = mysqli_fetch_assoc($sudah_pinjam_result)) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['sex'] ?></td>
            <td><?= $row['tgl_entry'] ?></td>
          </tr>
          <?php $i++;
          }
        } else { ?>
        <tr>
        <td colspan="5">Tidak ada data yang tersedia</td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</body>
</html>
