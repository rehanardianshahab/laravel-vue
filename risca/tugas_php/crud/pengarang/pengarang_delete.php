<?php
include_once("../connect.php");
 
$id_pengarang = $_GET['id_pengarang'];

mysqli_query($mysqli, 'SET foreign_key_checks = 0');
$result = mysqli_query($mysqli, "DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'");
mysqli_query($mysqli, 'SET foreign_key_checks = 1');

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:pengarang.php");
?>