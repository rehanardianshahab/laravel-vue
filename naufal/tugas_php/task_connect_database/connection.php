<?php

$servername = "localhost";
$database = "perpus_edu";
$username = "root";
$password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // echo "Connected successfully";
    // mysqli_close($conn);

    // Query 1
    $sql_anggota = "SELECT * FROM anggota";
    $result_anggota = $conn->query($sql_anggota);

    if ($result_anggota->num_rows > 0) {
        // output data each row
        while ($row = $result_anggota->fetch_assoc()) {
            echo "Anggota : ".$row["nama"]." - ".$row["sex"]." - ".$row["alamat"]."<br>";
        }
    } else {
        echo "0 results";
    }

    echo "<br><br><br>";

    // Query 2
    $sql_penerbit = "SELECT * FROM penerbit";
    $result_penerbit = $conn->query($sql_penerbit);

    if ($result_penerbit->num_rows > 0) {
        // output data each row
        while ($row = $result_penerbit->fetch_assoc()) {
            echo "Penerbit : ".$row["nama_penerbit"]." - ".$row["email"]." - ".$row["telp"]." - ".$row["alamat"]."<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>