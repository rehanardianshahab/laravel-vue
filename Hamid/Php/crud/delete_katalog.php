<?php
include_once("koneksi.php");
 
$id = $_GET['id_katalog'];
 
$disable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=0");
$result = mysqli_query($mysqli, "DELETE FROM katalog WHERE id_katalog='$id'");
$enable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=1");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:katalog.php");
?>