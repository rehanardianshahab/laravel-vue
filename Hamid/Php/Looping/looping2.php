<!DOCTYPE html>
<html>
<head>
  <title>Tabel Data Siswa</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: lightgray;
    }
  </style>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Kelas</th>
      </tr>
    </thead>
    <tbody>
      <?php
        for ($i = 1; $i <= 10; $i++) {
          echo "<tr>";
          echo "<td>" . $i . "</td>";
          echo "<td>Nama ke-" . $i . "</td>";
          echo "<td>Kelas " . (11 - $i) . "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</body>
</html>
