<html>
    <head>
        <title>Tugas PHP - Looping 2</title>
        
        <style>
            table{width:200px; text-align:center; margin:auto;}
            table tr:nth-child(even) {
                background: #D8D9CF;
            }
            table th { background-color: #009EFF; }
        </style>

    </head>
    <body>
        <form>
            <table border="1" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                </tr>

            <?php  for ($no = 1, $nama=1, $kelas=10; $nama<=10, $kelas > 0; $nama++, $kelas--) { ?>
 
                <tr>
                    <td> <?php echo $no; ?></td>
                    <td><?php echo "Nama ke $nama" ?></td>
                    <td><?php echo "Kelas $kelas" ?></td>
                </tr>
 
		    <?php $no++; } ?>

            </table>
        </form>
    </body>
</html>