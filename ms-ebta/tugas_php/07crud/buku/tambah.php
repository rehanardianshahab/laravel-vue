<?php
    // ambil file database dan function
    require '../databases.php';
    require '../function.php';

    // mulai input data
    if ( isset($_POST["submit"]) ) {
        tambah( $_POST, $conn, 'buku' );
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anggota</title>
</head>
<body>
    <form action="" method="post">

        <br />

        <label for="isbn">Isbn : </label>
        <input type="text" name="isbn" id="isbn" placeholder="Masukkan Nomor ISBN" required>
        
        <br />

        <label for="judul">Judul : </label>
        <input type="text" name="judul" id="judul" placeholder="Judul Buku" required>
        
        <br />

        <label for="tahun">Tahun : </label>
        <input type="text" name="tahun" id="tahun" placeholder="Tahun Terbit" required>

        <br />

        <label for="id_penerbit">Id Penerbit : </label>
        <input type="text" name="id_penerbit" id="id_penerbit" placeholder="no. Id penerbit" required>
        
        <br />

        <label for="id_pengarang">Id Pengarang : </label>
        <input type="text" name="id_pengarang" id="id_pengarang" placeholder="no. Id pengarang" required>

        <br />

        <label for="id_katalog">Id Katalog : </label>
        <input type="text" name="id_katalog" id="id_katalog" placeholder="no. Id katalog" required>

        <br />

        <label for="qty_stok">Stok : </label>
        <input type="text" name="qty_stok" id="qty_stok" placeholder="jumlah Stok" required>
        
        <br />

        <label for="harga_pinjam">Harga Sewa : </label>
        <input type="text" name="harga_pinjam" id="harga_pinjam" placeholder="Dalam Rupiah" required>

        <br />

        <button type="submit" name="submit">Tambah Data</button>
    </form>
</body>
</html>