<?php
    // ambil file database dan function
    require '../databases.php';
    require '../function.php';

    // ambil data primaty key di url
    $id = $_GET["isbn"];

    // buat sintaks query
        // query dari tabel buku
        $data_buku = "SELECT * FROM buku WHERE isbn = "."'".strtolower($id)."'";
        // query data penerbit
        $penerbit = "SELECT id_penerbit, nama_penerbit FROM penerbit";
        // query data pengarang
        $pengarang = "SELECT id_pengarang, nama_pengarang FROM pengarang";
        // query data katalog
        $katalog = "SELECT * FROM katalog";
        

    // fetch datanya dengan fungsi query (dari file databases)
        // fetch data dari tabel buku
        $data_buku = query($data_buku)[0];
        // fetch data penerbit
        $penerbit = query($penerbit);
        // fetch data pengarang
        $pengarang = query($pengarang);
        // fetch data katalig
        $katalog = query($katalog);
        var_dump($data_buku);

    // mulai editing
    if ( isset($_POST["submit"]) ) {
        edit( $_POST, $conn, 'buku' );
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Anggota</title>
</head>
<body>
    <form action="" method="post">
        <label for="isbn">Isbn : </label>
        <input type="text" name="isbn" id="isbn" value="<?= $data_buku['isbn']; ?>" required>
        
        <br />

        <label for="judul">judul : </label>
        <input type="text" name="judul" id="judul" value="<?= $data_buku['judul']; ?>" required>
        
        <br />

        <label for="tahun">tahun : </label>
        <input type="text" name="tahun" id="tahun" value="<?= $data_buku['tahun']; ?>" required>

        <br />

        <label for="id_penerbit">Penerbit : </label>
        <select name="id_penerbit" id="id_penerbit">
          <?php foreach ($penerbit as $key => $value) : ?>
            <?php if ($value['id_penerbit']==$data_buku['id_penerbit']) : ?>
                <option value="<?= $value['id_penerbit']; ?>" selected><?= $value['nama_penerbit']; ?></option>
            <?php else : ?>
                <option value="<?= $value['id_penerbit']; ?>"><?= $value['nama_penerbit']; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>

        <br />

        <label for="id_pengarang">Pengarang : </label>
        <select name="id_pengarang" id="id_pengarang">
          <?php foreach ($pengarang as $key => $value) : ?>
            <?php if ($value['id_pengarang']==$data_buku['id_pengarang']) : ?>
                <option value="<?= $value['id_pengarang']; ?>" selected><?= $value['nama_pengarang']; ?></option>
            <?php else : ?>
                <option value="<?= $value['id_pengarang']; ?>"><?= $value['nama_pengarang']; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>

        <br />

        <label for="id_katalog">Katalog : </label>
        <select name="id_katalog" id="id_katalog">
          <?php foreach ($katalog as $key => $val) : ?>
            <?php if ($value['id_katalog']==$data_buku['id_katalog']) : ?>
                <option value="<?= $val['id_katalog']; ?>" selected><?= $val['nama']; ?></option>
            <?php else : ?>
                <option value="<?= $val['id_katalog']; ?>"><?= $val['nama']; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>

        <br />

        <label for="qty_stok">Stok : </label>
        <input type="text" name="qty_stok" id="qty_stok" value="<?= $data_buku['qty_stok']; ?>" required>

        <br />

        <label for="harga_pinjam">Harga Sewa : </label>
        <input type="text" name="harga_pinjam" id="harga_pinjam" value="<?= $data_buku['harga_pinjam']; ?>" required>

        <br />

        <button type="submit" name="submit">Edit Data</button>
    </form>
</body>
</html>