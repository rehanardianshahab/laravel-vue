<?php
    include_once("connect.php");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog ORDER BY id_katalog ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>

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
<h3 class="text-center">Data Katalog</h3>
<a class="btn btn-md btn-info mb-n2 mt-1" href="add_katalog.php"><i class="bi bi-plus-circle-dotted"></i> Add New Katalog</a><br/><br/>
 
 <table class="table table-light table-hover" width='80%' border=1>
 <thead class="thead-dark">
     <tr class="text-center">
         <th>ID</th> 
         <th>Katalog</th>
         <th>Aksi</th>
     </tr>
 </thead>
 <?php  
     while($katalog_data = mysqli_fetch_array($katalog)) {         
         echo "<tr class='text-center'>";
         echo "<td>".$katalog_data['id_katalog']."</td>";
         echo "<td>".$katalog_data['nama']."</td>";         
         echo "<td><a class='btn btn-sm btn-warning' href='edit_katalog.php?id_katalog=$katalog_data[id_katalog]'>Edit</a> | <a class='btn btn-sm btn-danger' href='delete_katalog.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";        
     }
 ?>
 </table>
</div>

</body>
</html>