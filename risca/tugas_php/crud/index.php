<?php
    include_once("connect.php");
    $buku = mysqli_query($mysqli, "SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku 
        LEFT JOIN  pengarang ON pengarang.id_pengarang = buku.id_pengarang
        LEFT JOIN  penerbit ON penerbit.id_penerbit = buku.id_penerbit
        LEFT JOIN  katalog ON katalog.id_katalog = buku.id_katalog
        ORDER BY judul ASC");
?>
 
<!DOCTYPE html>
<head>    
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>

<ul class="nav justify-content-center bg-light">
  <li class="nav-item">
    <a class="nav-link" href="index.php">Buku</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="penerbit/penerbit.php">Penerbit</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pengarang/pengarang.php">Pengarang</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="katalog/katalog.php">Katalog</a>
  </li>
</ul>


<a href="buku/buku_add.php" class="btn btn-primary mt-4">Add New Buku</a><br/><br/>
 
    <table class="table table-bordered table-striped table-hover" width='80%' border=1>
 
    <tr class="bg-primary" style="text-align: center; color: #FFF;">
        <th>ISBN</th> 
        <th>Judul</th> 
        <th>Tahun</th> 
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Katalog</th>
        <th>Stok</th>
        <th>Harga Pinjam</th>
        <th>Aksi</th>
    </tr>
    <?php  
        while($buku_data = mysqli_fetch_array($buku)) {         
            echo "<tr>";
            echo "<td>".$buku_data['isbn']."</td>";
            echo "<td>".$buku_data['judul']."</td>";
            echo "<td>".$buku_data['tahun']."</td>";    
            echo "<td>".$buku_data['nama_pengarang']."</td>";    
            echo "<td>".$buku_data['nama_penerbit']."</td>";    
            echo "<td>".$buku_data['nama_katalog']."</td>";    
            echo "<td>".$buku_data['qty_stok']."</td>";    
            echo "<td>".$buku_data['harga_pinjam']."</td>";    
            echo "<td><a class='btn btn-primary' href='buku/buku_edit.php?isbn=$buku_data[isbn]'>Edit</a> | <a class='btn btn-danger' href='buku/buku_delete.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>