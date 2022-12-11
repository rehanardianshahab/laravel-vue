<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Looping 2</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th {
            border: solid 1px black;
            padding: 5px;
            background-color: aqua;
        }

        td {
            border: solid 1px black;
            padding: 5px;
        }

        tr:nth-child(odd) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
            </tr>
        </thead>

        <!-- Tabel Body -->
        <tbody>
            <?php
            
                for ($no = 1, $nam = 1, $kel = 10; $no <= 10, $nam <= 10, $kel > 0; $no++, $nam++, $kel--) {
                    echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>Nama ke $nam</td>";
                        echo "<td>Kelas $kel</td>";
                    echo "</tr>";
                }
            
            ?>
        </tbody>
    </table>
</body>
</html>