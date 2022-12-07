<?php
    include_once("connect.php");
    $buku = mysqli_query($mysqli, "SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku 
                                        LEFT JOIN  pengarang ON pengarang.id_pengarang = buku.id_pengarang
                                        LEFT JOIN  penerbit ON penerbit.id_penerbit = buku.id_penerbit
                                        LEFT JOIN  katalog ON katalog.id_katalog = buku.id_katalog
                                        ORDER BY judul ASC");
?>
 
<html>
<head>    
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="justify-content-center collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item mx-3">
        <a class="nav-link text-white" href="index.php">Buku<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-white" href="penerbit.php">Penerbit</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-white" href="pengarang.php">Pengarang</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-white" href="katalog.php" >Katalog</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-3">
    <h3 class="text-center">Data Buku</h3>
    <a class="btn btn-md btn-info mb-n2 mt-1" href="add.php"><i class="bi bi-plus-circle-dotted"></i> Add New Buku</a><br/><br/>
    
    <table class="table table-light table-hover" width='80%' border=1>
    <thead class="thead-dark">
        <tr class="text-center">
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
    </thead>
    
    <?php  
        while($buku_data = mysqli_fetch_array($buku)) {         
            echo "<tr class='text-center'>";
            echo "<td>".$buku_data['isbn']."</td>";
            echo "<td>".$buku_data['judul']."</td>";
            echo "<td>".$buku_data['tahun']."</td>";    
            echo "<td>".$buku_data['nama_pengarang']."</td>";    
            echo "<td>".$buku_data['nama_penerbit']."</td>";    
            echo "<td>".$buku_data['nama_katalog']."</td>";    
            echo "<td>".$buku_data['qty_stok']."</td>";    
            echo "<td>".$buku_data['harga_pinjam']."</td>";    
            echo "<td><a class='btn btn-sm btn-warning' href='edit.php?isbn=$buku_data[isbn]'>Edit</a> | <a class='btn btn-sm btn-danger' href='delete.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</div>


</body>
</html>