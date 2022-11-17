<?php
include_once("connect.php");
 
$id = $_GET['id_pengarang'];
 
$disable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS = 0");
$result = mysqli_query($mysqli, "DELETE FROM pengarang WHERE id_pengarang='$id'");
$enable = mysqli_query($mysqli, "SET FOREIGN_KEY_CHECKS=1");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:pengarang.php");
?>