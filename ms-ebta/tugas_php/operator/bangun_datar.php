<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luas Bangun Datar</title>
</head>
<body>
    <form action="" method="post">
      <fieldset>
        <legend>Luas Persegi</legend>
        <label for="sisi">Sisi : </label><input id="sisi" type="number" name='sisi' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['sisi']) ) : ?>
            <?php 
                $sisi = $_POST['sisi'];
                $sisi *= $sisi;
            ?>
            <p>Luas persegi kamu adalah <?= $sisi ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Persegi Panjang</legend>
        <label for="panjang">Panjang : </label><input id="panjang" type="number" name='panjang' placeholder="Dalam cm" required><br />
        <label for="lebar">Lebar : </label><input id="lebar" type="number" name='lebar' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['panjang']) && isset($_POST['lebar']) ) : ?>
            <?php 
                $panjang = $_POST['panjang'];
                $lebar = $_POST['lebar'];
                $luas = $panjang*$lebar;
            ?>
            <p>Luas persegi panjang kamu adalah <?= $luas; ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Segi Tiga</legend>
        <label for="alas">Alas : </label><input id="alas" type="number" name='alas' placeholder="Dalam cm" required><br />
        <label for="tinggi">Tinggi : </label><input id="tinggi" type="number" name='tinggi' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['alas']) && isset($_POST['tinggi']) ) : ?>
            <?php 
                $alas = $_POST['alas'];
                $tinggi = $_POST['tinggi'];
                $luasS3 = $alas*0.5*$tinggi;
            ?>
            <p>Luas segi tiga kamu adalah <?= $luasS3; ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Layang-Layang</legend>
        <label for="d1">Diagonal 1 : </label><input id="d1" type="number" name='d1' placeholder="Dalam cm" required><br />
        <label for="d2">Diagonal 2 : </label><input id="d2" type="number" name='d2' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['d1']) && isset($_POST['d2']) ) : ?>
            <?php 
                $d1 = $_POST['d1'];
                $d2 = $_POST['d2'];
                $luaslayangan = 0.5*$d1*$d1;
            ?>
            <p>Luas layang-layang kamu adalah <?= $luaslayangan; ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Trapezoid</legend>
        <label for="A1">Sisi atas : </label><input id="A1" type="number" name='A1' placeholder="Dalam cm" required><br />
        <label for="A2">Sisi alas : </label><input id="A2" type="number" name='A2' placeholder="Dalam cm" required><br />
        <label for="T">Tinggi : </label><input id="T" type="number" name='T' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['A1']) && isset($_POST['A2']) ) : ?>
            <?php 
                $A1 = $_POST['A1'];
                $A2 = $_POST['A2'];
                $T = $_POST['T'];
                $luasTrapezoid = 0.5*($A1+$A2)*$T;
            ?>
            <p>Luas trapezoid kamu adalah <?= $luasTrapezoid; ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
    <a href="bangun_datar.php"><button>Bersihkan</button></a>
</body>
</html>