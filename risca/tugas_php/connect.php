<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "perpus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
// mysqli_close($conn);

$sql = "SELECT * FROM buku WHERE harga_pinjam > 10000";
$result = $conn->query($sql);
 if ($result->num_rows > 0){
   while($row = $result->fetch_assoc()){
 		echo "Buku : " .$row['isbn']. " " .$row['judul']. " " .$row['tahun']. " " .$row['id_penerbit']. " " .$row['id_pengarang']. " " .$row['id_katalog']. " " .$row['qty_stok']. " " .$row['harga_pinjam']. "<br>";
 	}
 } else {
 		echo "0 results";
 	}
 	$conn->close();
 

 ?>