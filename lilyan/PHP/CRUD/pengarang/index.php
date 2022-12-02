<?php
    include_once("../connect.php");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
?>
 
<html>
<head>    
    <title>Halaman Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
 
<body>

<center>
    <a href="../buku/index.php">Buku</a> |
    <a href="../penerbit/index.php">Penerbit</a> |
    <a href="../pengarang/index.php">Pengarang</a> |
    <a href="../katalog/index.php">Katalog</a>
    <hr>
</center>

<a href="add.php">Add New Pengarang</a><br/><br/>
 
    <table class="table" width='80%' border=1>
 
    <tr>
        <th>ID Pengarang</th> 
        <th>Nama Pengarang</th> 
        <th>Email</th> 
        <th>No Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php  
        while($data_pengarang = mysqli_fetch_array($pengarang)) {         
            echo "<tr>";
            echo "<td>".$data_pengarang['id_pengarang']."</td>";
            echo "<td>".$data_pengarang['nama_pengarang']."</td>";
            echo "<td>".$data_pengarang['email']."</td>";    
            echo "<td>".$data_pengarang['telp']."</td>";    
            echo "<td>".$data_pengarang['alamat']."</td>";       
            echo "<td><a class='btn btn-primary' href='edit.php?id_pengarang=$data_pengarang[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_pengarang=$data_pengarang[id_pengarang]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>