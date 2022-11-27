<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volume Bangun Ruang</title>
</head>
<body>
    <form action="" method="post">
      <fieldset>
        <legend>Volume Kubus</legend>
        <label for="sisi">Sisi : </label><input id="sisi" type="number" name='sisi' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['sisi']) ) : ?>
            <?php 
                $sisi = $_POST['sisi'];
                $LAlasKubus = $sisi*$sisi;
                $TKubus = $sisi;
                $VKubus = $LAlasKubus*$TKubus;
            ?>
            <p>Volume kubus kamu adalah <?= $VKubus; ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Volume Balok</legend>
        <label for="panjang">Panjang Alas : </label><input id="panjang" type="number" name='panjang' placeholder="Dalam cm" required><br />
        <label for="lebar">Lebar Alas : </label><input id="lebar" type="number" name='lebar' placeholder="Dalam cm" required><br />
        <label for="tingginya">Tinggi : </label><input id="tingginya" type="number" name='tingginya' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php if( isset($_POST['panjang']) && isset($_POST['lebar'])  && isset($_POST['tingginya'])  ) : ?>
            <?php 
                $LAlasBalok = $_POST['panjang']*$_POST['lebar'];
                $TBalok = $_POST['tingginya'];
                $VBalok = $LAlasBalok*$TBalok;
            ?>
            <p>Volume balok kamu adalah <?= $VBalok; ?>cm</p>
        <?php endif; ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Volume Tabung</legend>
        <div id="boxdiameter">
          <label for="diameter">Diameter Alas : </label><input id="diameter" type="number" name='diameter' placeholder="Dalam cm" oninput="hilangr()">
        </div>
        <div id="boxjari2">
          <label for="jari2">Jari-jari Alas : </label><input id="jari2" type="number" name='jari2' placeholder="Dalam cm" oninput="hilangdiameter()">
        </div>
        <label for="Ttabung">Tinggi : </label><input id="Ttabung" type="number" name='Ttabung' placeholder="Dalam cm" required>
        <button name="submit" type="submit">submit</button>

        <?php 
          if( isset($_POST['diameter']) && isset($_POST['Ttabung']) ) { 
                $RTabung = $_POST['diameter']*0.5;
                $LAlasTabung = $RTabung*$RTabung*3.14;
                $Ttabung = $_POST['Ttabung'];
                $Vtabung = $LAlasTabung*$Ttabung;

            echo "<p>Volume Tabungan kamu adalah ".$Vtabung."cm";
          } elseif ( isset($_POST['jari2']) && isset($_POST['Ttabung']) ) {
            $RTabung = $_POST['jari2'];
            $LAlasTabung = $RTabung*$RTabung*3.14;
            $Ttabung = $_POST['Ttabung'];
            $Vtabung = $LAlasTabung*$Ttabung;

            echo "<p>Volume Tabung kamu adalah ".$Vtabung."cm";
          }
        ?>
      </fieldset>
    </form>
    <a href="bangun_datar.php"><button>Bersihkan</button></a>
</body>
<script>
    function hilangr() {
        if ( document.getElementById('diameter').value.length<1 ) {
            document.getElementById("boxjari2").style.display = "block";
        } else {
            document.getElementById("boxjari2").style.display = "none";
        }
    }
    function hilangdiameter() {
        if ( document.getElementById('jari2').value.length<1 ) {
            document.getElementById("boxdiameter").style.display = "block";
        } else {
            document.getElementById("boxdiameter").style.display = "none";
        }
    }
</script>
</html>