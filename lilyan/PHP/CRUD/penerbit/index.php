<?php
    include_once("../connect.php");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
?>
 
<html>
<head>    
    <title>Halaman Penerbit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link mx-3" href="../buku/index.php">Buku</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3 active" aria-current="page" href="../penerbit/index.php">Penerbit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="../pengarang/index.php">Pengarang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="../katalog/index.php">Katalog</a>
      </li>
    </ul>
</nav>
<br>

<a class="btn btn-outline-primary" href="add.php">Add New Penerbit</a><br/><br/>
 
    <table class="table table-striped" border=1>
        <tr>
            <th>ID Penerbit</th> 
            <th>Nama Penerbit</th> 
            <th>Email</th> 
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php  
            while($data_penerbit = mysqli_fetch_array($penerbit)) {         
                echo "<tr>";
                echo "<td>".$data_penerbit['id_penerbit']."</td>";
                echo "<td>".$data_penerbit['nama_penerbit']."</td>";
                echo "<td>".$data_penerbit['email']."</td>";    
                echo "<td>".$data_penerbit['telp']."</td>";    
                echo "<td>".$data_penerbit['alamat']."</td>";       
                echo "<td><a class='btn btn-primary' href='edit.php?id_penerbit=$data_penerbit[id_penerbit]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_penerbit=$data_penerbit[id_penerbit]'>Delete</a></td></tr>";        
            }
        ?>
    </table>
</body>
</html>