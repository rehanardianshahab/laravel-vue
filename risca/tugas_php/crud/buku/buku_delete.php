<?php
include_once("../connect.php");
 
$isbn = $_GET['isbn'];

mysqli_query($mysqli, 'SET foreign_key_checks = 0');
$result = mysqli_query($mysqli, "DELETE FROM buku WHERE isbn='$isbn'");
mysqli_query($mysqli, 'SET foreign_key_checks = 1');

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:../index.php");
?>