<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Array</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th {
            border: solid 1px black;
            padding: 5px;
        }

        td {
            border: solid 1px black;
            padding: 5px;
        }

        tr {
            text-align: center;
        }

        tbody tr:nth-child(odd) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <?php
        $array = file_get_contents('data.json');
        $data = json_decode($array, true);
    ?>

    <table>
        <!-- Table Header -->
        <thead>
            <tr>
                <th>No.</th>
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
            <tr>
                <?php 
                    $i = 0;
                    foreach ($data as $d => $value) { 
                        ++$i?>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value['nama']; ?></td>
                        <td><?php 
                            $newDate = date('d F Y', strtotime($value['tanggal_lahir']));
                            echo $newDate;
                        ?></td>
                        <td><?php 
                            echo date("Y") - date('Y', strtotime($value['tanggal_lahir']))." tahun";
                        ?></td>
                        <td><?php echo $value['alamat']; ?></td>
                        <td><?php echo $value['kelas']; ?></td>
                        <td><?php echo $value['nilai']; ?></td>
                        <td><?php
                            if ($value['nilai'] >= 90) {
                                echo "A";
                            } else if ($value['nilai'] >= 80) {
                                echo "B";
                            } else if ($value['nilai'] >= 70) {
                                echo "C";
                            } else {
                                echo "D";
                            };
                        ?></td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</body>
</html>