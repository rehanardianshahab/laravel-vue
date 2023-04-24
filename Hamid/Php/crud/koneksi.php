<?php
    // Koneksi ke database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "perpus";

    $mysqli = new mysqli($host, $username, $password, $database);

    if($mysqli === false){
        die("ERROR: Tidak dapat terhubung. " . $mysqli->connect_error);
    }
?>
