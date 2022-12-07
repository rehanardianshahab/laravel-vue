<?php
    include_once("../connect.php");
    $penerbit = mysqli_query($mysqli, "SELECT *  FROM penerbit 
        ORDER BY id_penerbit ASC");
?>
 
<!DOCTYPE html>
<head>    
    <title>Penerbit</title>
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

<a href="penerbit_add.php" class="btn btn-primary mt-4">Add New Penerbit</a><br/><br/>
 
    <table class="table table-bordered table-striped table-hover" width='80%' border=1> 
    <tr class="bg-primary" style="text-align: center; color: #FFF;">
        <th>ID Penerbit</th>
        <th>Nama Penerbit</th>
        <th>Email</th>
        <th>Telpon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    
    <?php  
        while($penerbit_data = mysqli_fetch_array($penerbit)) {         
            echo "<tr>";  
            echo "<td>".$penerbit_data['id_penerbit']."</td>";    
            echo "<td>".$penerbit_data['nama_penerbit']."</td>";    
            echo "<td>".$penerbit_data['email']."</td>";    
            echo "<td>".$penerbit_data['telp']."</td>";    
            echo "<td>".$penerbit_data['alamat']."</td>";    
            echo "<td><a class='btn btn-primary' href='penerbit_edit.php?id_penerbit=$penerbit_data[id_penerbit]'>Edit</a> | <a class='btn btn-danger' href='penerbit_delete.php?id_penerbit=$penerbit_data[id_penerbit]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>