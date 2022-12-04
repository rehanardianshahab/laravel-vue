<?php
            $array = file_get_contents('data.json');
            $data = json_decode($array, true);
?>
<html>
    <head>
        <title>Tugas PHP - Looping 2</title>
        
        <style>
            *{margin: 0; padding: 0;}
            nav{display: flex; background-color: #FCE700; padding: 20px 0;}
            nav .logo {font-size: 20px; letter-spacing: 1px;}
            table{width:800px; text-align:center; margin:auto;}
            table tr:nth-child(even) {
                background: #EAEAEA;
            }
            /* table th { background-color: #009EFF; } */
        </style>

    </head>
    <body>
        <nav>
            <div class="logo">
                <h4>&nbsp;&nbsp;Daftar Nilai</h4>
            </div>
        </nav>
        <br>
        <form>
            <table border="1" cellspacing="0">
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
                
            <?php $no=1; foreach ($data as $key => $value) { ?>     
            <?php            
            // Umur
            $tanggal_lahir = date('Y', strtotime($value['tanggal_lahir']));
            $sekarang = date('Y');
            $umur = $sekarang - $tanggal_lahir;
            // Hasil Nilai
            $nilai = $value['nilai'];
				if ($nilai >= 90) {
					$hasil = "A";
				} elseif($nilai >= 80){
					$hasil = "B";
				} elseif($nilai >= 70){
					$hasil = "C";
				} else {
					$hasil = "D";
				}
            ?>
        
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $value['nama'] ?></td>
                    <td><?php echo date('d F Y', strtotime($value['tanggal_lahir'])) ?></td>
                    <td><?php echo "$umur Tahun" ?></td>
                    <td><?php echo $value['alamat'] ?></td>
                    <td><?php echo $value['kelas'] ?></td>
                    <td><?php echo $value['nilai'] ?></td>
                    <td><?php echo $hasil ?></td>                   
                </tr>
            <?php  } ?>

            </table>
        </form>
    </body>
</html>