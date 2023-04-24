<?php
include_once("koneksi.php");
 
$isbn = $_GET['isbn'];
 
$disable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=0");
$result = mysqli_query($mysqli, "DELETE FROM buku WHERE isbn='$isbn' LIMIT 1");
$enable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=1");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
?>