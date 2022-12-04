<?php
include_once("../connect.php");
 
$id_penerbit = $_GET['id_penerbit'];

mysqli_query($mysqli, "SET foreign_key_checks = 0");
$result = mysqli_query($mysqli, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");
mysqli_query($mysqli,"SET foreign_key_checks = 1");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
?>