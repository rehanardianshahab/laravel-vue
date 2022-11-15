<?php
include_once("connect.php");
 
$id = $_GET['id_katalog'];
 
$result = mysqli_query($mysqli, "DELETE FROM katalog WHERE id_katalog='$id'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:katalog.php");
?>