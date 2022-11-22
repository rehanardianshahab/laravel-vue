<?php
    include_once("../connect.php");
    $katalog = mysqli_query($mysqli, "SELECT *  FROM katalog 
        ORDER BY id_katalog ASC");
?>
 
<!DOCTYPE html>
<head>    
    <title>Katalog</title>
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

<a href="katalog_add.php" class="btn btn-primary mt-4">Add New Katalog</a><br/><br/>
 
    <table class="table table-bordered table-striped table-hover" width='80%' border=1>
    <tr class="bg-primary" style="text-align: center; color: #FFF;">
        <th>ID Katalog</th>
        <th>Nama Katalog</th>
        <th>Aksi</th>
    </tr>

    <?php  
        while($katalog_data = mysqli_fetch_array($katalog)) {         
            echo "<tr>";  
            echo "<td>".$katalog_data['id_katalog']."</td>";    
            echo "<td>".$katalog_data['nama']."</td>";     
            echo "<td><a class='btn btn-primary' href='katalog_edit.php?id_katalog=$katalog_data[id_katalog]'>Edit</a> | <a class='btn btn-danger' href='katalog_delete.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>