<?php
    include_once("../connect.php");
    $pengarang = mysqli_query($mysqli, "SELECT *  FROM pengarang
        ORDER BY id_pengarang ASC");
?>
 
<!DOCTYPE html>
<head>    
    <title>Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>
<ul class="nav justify-content-center bg-light">
  <li class="nav-item">
    <a class="nav-link" href="../index.php">Buku</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../penerbit/penerbit.php">Penerbit</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../pengarang/pengarang.php">Pengarang</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../katalog/katalog.php">Katalog</a>
  </li>
</ul>

<a href="pengarang_add.php" class="btn btn-primary mt-4">Add New Pengarang</a><br/><br/>
 
    <table class="table table-bordered table-striped table-hover" width='80%' border=1>
    <tr class="bg-primary" style="text-align: center; color: #FFF;">
        <th>ID Pengarang</th>
        <th>Nama Pengarang</th>
        <th>Email</th>
        <th>Telpon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    
    <?php  
        while($pengarang_data = mysqli_fetch_array($pengarang)) 
        {         
            echo "<tr>";  
            echo "<td>".$pengarang_data['id_pengarang']."</td>";    
            echo "<td>".$pengarang_data['nama_pengarang']."</td>";    
            echo "<td>".$pengarang_data['email']."</td>";    
            echo "<td>".$pengarang_data['telp']."</td>";    
            echo "<td>".$pengarang_data['alamat']."</td>";    
            echo "<td><a class='btn btn-primary' href='pengarang_edit.php?id_pengarang=$pengarang_data[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='pengarang_delete.php?id_pengarang=$pengarang_data[id_pengarang]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>