<?php
include_once("connect.php");
 
$id = $_GET['id_pengarang'];
 
$result = mysqli_query($mysqli, "DELETE FROM pengarang WHERE id_pengarang='$id'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:pengarang.php");
?>