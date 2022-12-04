<?php
    include_once("../connect.php");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>

<html>
<head>    
    <title>Halaman Katalog</title>
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
        <a class="nav-link mx-3" href="../penerbit/index.php">Penerbit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="../pengarang/index.php">Pengarang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3 active" aria-current="page" href="../katalog/index.php">Katalog</a>
      </li>
    </ul>
</nav>
<br>

<a class="btn btn-outline-primary" href="add.php">Add New Katalog</a><br/><br/>
 
    <table class="table table-striped" border=1>
      <tr>
          <th>ID Katalog</th> 
          <th>Nama Katalog</th> 
          <th>Aksi</th>
      </tr>
      <?php  
          while($data_katalog = mysqli_fetch_array($katalog)) {         
              echo "<tr>";
              echo "<td>".$data_katalog['id_katalog']."</td>";
              echo "<td>".$data_katalog['nama']."</td>";    
              echo "<td><a class='btn btn-primary' href='edit.php?id_katalog=$data_katalog[id_katalog]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_katalog=$data_katalog[id_katalog]'>Delete</a></td></tr>";        
          }
      ?>
    </table>
</body>
</html>