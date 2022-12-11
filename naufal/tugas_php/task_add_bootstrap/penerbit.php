<?php
    include_once("connect.php");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit ORDER BY id_penerbit ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbit</title>

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
<h3 class="text-center">Data Penerbit</h3>
<a class="btn btn-md btn-info mb-n2 mt-1" href="add_penerbit.php"><i class="bi bi-plus-circle-dotted"></i> Add New Penerbit</a><br/><br/>
 
 <table class="table table-light table-hover" width='80%' border=1>
 <thead class="thead-dark">
     <tr class="text-center">
         <th>ID</th> 
         <th>Penerbit</th> 
         <th>Email</th> 
         <th>Telp</th>
         <th>Alamat</th>
         <th>Aksi</th>
     </tr>
 </thead>
 <?php  
     while($penerbit_data = mysqli_fetch_array($penerbit)) {         
         echo "<tr class='text-center'>";
         echo "<td>".$penerbit_data['id_penerbit']."</td>";
         echo "<td>".$penerbit_data['nama_penerbit']."</td>";
         echo "<td>".$penerbit_data['email']."</td>";    
         echo "<td>".$penerbit_data['telp']."</td>";    
         echo "<td>".$penerbit_data['alamat']."</td>";          
         echo "<td><a class='btn btn-sm btn-warning' href='edit_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Edit</a> | <a class='btn btn-sm btn-danger' href='delete_penerbit.php?id_penerbit=$penerbit_data[id_penerbit]'>Delete</a></td></tr>";        
     }
 ?>
 </table>
</div>


</body>
</html>