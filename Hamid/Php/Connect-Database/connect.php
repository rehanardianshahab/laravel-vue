<?php
$servername = "localhost"; // Nama server Anda
$username = "root"; // Nama pengguna database Anda
$password = ""; // Kata sandi database Anda
$dbname = "perpus"; // Nama database yang ingin Anda hubungkan

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil atau tidak
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";
// sistem query
function query( $query ){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

?>