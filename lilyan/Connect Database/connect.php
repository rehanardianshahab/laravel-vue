<?php
$servername = "localhost";
$database = "perpustakaan";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

//Check connection
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}

// echo "Connected successfully";
// mysqli_close($conn);

$sql = "SELECT * FROM anggota WHERE role != 'ADMIN'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  "Anggota : " .$row["id_anggota"]. " " .$row["nama"]. " " .$row["username"]. " " .$row["alamat"]. " " .$row["role"]. "<br>";
    }
} else {
    echo "0 result";
}

$conn->close();
?>
