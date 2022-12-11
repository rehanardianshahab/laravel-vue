<?php
include_once("../connect.php");
 
$id_katalog = $_GET['id_katalog'];

mysqli_query($mysqli, "SET foreign_key_checks = 0");
$result = mysqli_query($mysqli, "DELETE FROM katalog WHERE id_katalog='$id_katalog'");
mysqli_query($mysqli,"SET foreign_key_checks = 1");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
?>