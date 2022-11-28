<?php
    $array = file_get_contents('data.json');
    $data = json_decode($array, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
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
  <table>
    <!-- Table Header -->
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Umur</th>
        <th>Alamat</th>
        <th>Kelas</th>
        <th>Nilai</th>
        <th>Hasil</th>
      </tr>
    </thead>
    <!-- Table Body -->
    <tbody>
      <?php $i = 0; ?>
      <?php foreach ($data as $datum => $isi) : ?>
        <tr>
          <?php 
            ++$i;
            $tgl_lahir = date('d F Y', strtotime($isi['tanggal_lahir']));
            $umur = date("Y") - date('Y', strtotime($isi['tanggal_lahir']))." tahun"; 
            if ($isi['nilai'] >= 90) {
                $hasil = "A";
            } else if ($isi['nilai'] >= 80) {
                $hasil = "B";
            } else if ($isi['nilai'] >= 70) {
                $hasil = "C";
            } else {
                $hasil = "D";
            };
          ?>
          <td><?= $i; ?></td>
          <td><?= $isi['nama']; ?></td>
          <td><?= $tgl_lahir; ?></td>
          <td><?= $umur; ?></td>
          <td><?= $isi['alamat']; ?></td>
          <td><?= $isi['kelas']; ?></td>
          <td><?= $isi['nilai']; ?></td>
          <td><?= $hasil ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>