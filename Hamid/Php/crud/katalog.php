<?php
    include_once("koneksi.php");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog ORDER BY id_katalog ASC");
?>

<html>
<head>
    <title>CRUD Katalog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .navbar {
            background-color: #007bff;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        
        .navbar a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .navbar a:hover {
            text-decoration: underline;
        }
        
        .navbar .brand {
            font-size: 24px;
        }
        
        .navbar .actions {
            display: flex;
            align-items: center;
        }
        
        .navbar .actions a {
            margin-left: 10px;
        }
        
        .navbar .actions a i {
            margin-right: 5px;
        }
        
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #ddd;
            font-weight: bold;
        }
        
        a {
            text-decoration: none;
            color: #007bff;
        }
        
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-primary:hover, .btn-danger:hover {
            color: #fff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="penerbit.php">Penerbit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pengarang.php">Pengarang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="katalog.php">Katalog</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="navbar">
    <div class="brand">Tambahkan Katalog Baru</div>
    <div class="actions">
        <a class="btn btn-primary" href="add_katalog.php"><i class="fas fa-plus"></i>ADD</a>
    </div>
</div>
 
    <table class="table" width='80%' border=1>
 
    <tr>
        <th>ID</th> 
        <th>Katalog</th> 
    </tr>
    <?php  
        while($katalog_data = mysqli_fetch_array($katalog)) {         
            echo "<tr>";
            echo "<td>".$katalog_data['id_katalog']."</td>";
            echo "<td>".$katalog_data['nama']."</td>";         
            echo "<td><a class='btn btn-primary' href='edit_katalog.php?id_katalog=$katalog_data[id_katalog]'>Edit</a> | <a class='btn btn-danger' href='delete_katalog.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";        
        }
    ?>
    </table>
</body>
</html>