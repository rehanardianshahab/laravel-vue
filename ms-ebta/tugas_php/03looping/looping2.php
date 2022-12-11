<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Looping</title>
    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
      th {
        background-color: #33adff;
      }
      <?php
        $a = 1;
        while ($a < 9) {
          echo ".baris".$a.", ";
          $a++;
          $a++;
        }
      ?> .baris9 {
        background-color: #cccccc;
      }
      th, td {
        padding: 0.5rem;
      }
    </style>
</head>
<body>
      <table>
        <tr>
          <th>No</th><th>Nama</th><th>Kelas</th>
        </tr>
        <?php for ($i=1, $j=10 ; $i <= 10; $i++, $j--) : ?>
          <tr class="baris<?= $i; ?>">
            <td><?= $i; ?></td><td>Nama ke <?= $i; ?></td><td>Kelas <?= $j; ?></td>
          </tr>
        <?php endfor ?>
      </table>
</body>
</html>