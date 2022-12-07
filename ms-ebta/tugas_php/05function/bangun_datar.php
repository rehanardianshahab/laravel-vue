<?php
  // fungsi rumus persegi
  function luaspersegi($sisi) {
    $luasP = $sisi*$sisi;
    $persegi = '<p>Luas persegi kamu adalah '.$luasP.'cm</p>
              <div class="gb persegi">
                <p>'.$sisi.'</p>
                <div>
                  <img src="img/persegi.jpg" alt="persegi">
                </div>
              </div>
              <div>
                <p>Sisi = '.$sisi.'cm</p>
                <p>Luas = '.$sisi.'cm <b>X</b> '.$sisi.'cm = '.$luasP.'cm</p>
              </div>';
    echo $persegi;
  }
  // fungsi rumus persegi panjang
  function luaspersegipanjang($panjang, $lebar) {
    if ($lebar > $panjang) {
      $p = $lebar;
      $l = $panjang;
      $teliti = "Hai, mungkin kamu salah memasukkan angka. Seharusnya panjang dari persegi panjang itu lebih besar dari luasnya. Kamu memasukkan
                <br />Panjang = ". $l.
                "<br />Lebar = ". $p.
                "<br />Sedangkan seharusnya
                <br />Panjang = ". $p.
                "<br />Lebar = ". $l;
      echo "<p style='color:red; border: 1px solid red; padding:1rem;'>".$teliti."</p>";
      } else {
          $p = $panjang;
          $l = $lebar;
      }
      $luas = $p*$l;
      $ppanjang = '<p>Luas persegi panjang kamu adalah '.$luas.'cm</p>
            <div class="block-gb transalte-ppanjang">  
              <p class="text-samping">'.$l.'cm</p>
              <div class="gb ppanjang">
                <p>'.$p.'cm</p>
                <div>
                  <img src="img/persegi-panjang.jpg" alt="persegi">
                </div>
              </div>
            </div>
            <div>
              <p>Panjang = '.$p.'cm</p>
              <p>Lebar = '.$l.'cm</p>
              <p>Luas = '.$p.'cm <b>X</b> '.$l.'cm = '.$luas.'cm</p>
            </div>';
      echo $ppanjang;
  }
  // fungsi segi tiga
  function segitiga($alas, $tinggi) {
      $luasS3 = $alas*0.5*$tinggi;
      $segitiga = '<p>Luas segi tiga kamu adalah '. $luasS3.'cm</p>
            <div class="block-s3">  
              <div class="gb s3">
                <div>
                  <img src="img/segitiga.jpg" alt="persegi">
                </div>
                <p>'.$alas.'cm</p>
              </div>
              <p class="text-samping-s3">'.$tinggi.'cm</p>
            </div>
            <div class="text-s3">
              <p>Alas = '. $alas.'cm</p>
              <p>Tinggi = '. $tinggi.'cm</p>
              <p>Luas = (<sup>1</sup>/<sub>2</sub> <b>X</b> '. $alas.'cm) '. $tinggi.'cm = '. $luasS3.'cm</p>
            </div>';
      echo $segitiga;
  }
  // fungsi layangan
  function layangan($d1, $d2) {
      if ( $d1 < $d2 ) {
        $a = $d1;
        $b = $d2;
      } else {
        $a = $d2;
        $b = $d1;
      }
      $luaslayangan = 0.5*$a*$b;
      $layang = '<p>Luas layang-layang kamu adalah '. $luaslayangan.'</p>
            <div class="block-gb transalte-ppanjang">  
              <p class="text-samping">'. $a.'cm</p>
              <div class="gb ppanjang">
                <p>'.$b.'cm</p>
                <div>
                  <img src="img/layangan.png" alt="persegi">
                </div>
              </div>
            </div>
            <div>
              <p>diagonal 1 = '. $a.'cm</p>
              <p>diagonal 2 = '. $b.'cm</p>
              <p>Luas = <sup>1</sup>/<sub>2</sub> ('. $a.'cm <b>X</b> '. $b.'cm) = '.$luaslayangan.'cm</p>
            </div>';
      echo $layang;
  }
  // fungsi trapezoid
  function trapezoid($A1, $A2, $T) {
      if ($A1>$A2) {
          $a1 = $A2;
          $a2 = $A1;
          $teliti = "Hai, mungkin kamu salah memasukkan angka. Seharusnya panjang dari atap trapezoid itu lebih besar dari alasnya. Kamu memasukkan
                    <br />Atap = ". $a2.
                    "<br />Alas = ". $a1.
                    "<br />Sedangkan seharusnya
                    <br />Atap = ". $a1.
                    "<br />Alas = ". $a2;
          echo "<p style='color:red; border: 1px solid red; padding:1rem;'>".$teliti."</p>";
        } else {
          $a1 = $A1;
          $a2 = $A2;
        }
        $luasTrapezoid = 0.5*($a1+$a2)*$T;
        $trapz =  '<p>Luas trapezoid kamu adalah '. $luasTrapezoid.'cm</p>
            <div class="box-trapezoid">
              <p class="kiri-trpz">'. $T.'cm</p>
              <div class="trapezoid">
                <p class="atas">'. $a1.'cm</p>
                <div>
                  <img src="img/trapezoid.png" alt="trapezoid">
                </div>
                <p class="bawah">'. $a2.'cm</p>
              </div>
            </div>
            <div>
              <p>Atap = '. $a1.'cm</p>
              <p>Alas = '. $a2.'cm</p>
              <p>Tinggi = '. $T.'cm</p>
              <p>Luas = <sup>1</sup>/<sub>2</sub> ('. $a1.'cm <b>+</b> '. $a2.'cm) '. $T.'cm = '. $luasTrapezoid.'cm</p>
            </div>';
        echo $trapz;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luas Bangun Datar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
      <fieldset>
        <legend>Luas Persegi</legend>
        <label for="sisi">Sisi : </label><input id="sisi" type="number" name='sisi' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php 
          if( isset($_POST['sisi']) ) {
                luaspersegi($_POST['sisi']);
          }
         ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Persegi Panjang</legend>
        <label for="panjang">Panjang : </label><input id="panjang" type="number" name='panjang' placeholder="Dalam cm" required><br />
        <label for="lebar">Lebar : </label><input id="lebar" type="number" name='lebar' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php 
          if( isset($_POST['panjang']) && isset($_POST['lebar']) ) {
              luaspersegipanjang($_POST['panjang'], $_POST['lebar']);
          } 
        ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Segi Tiga</legend>
        <label for="alas">Alas : </label><input id="alas" type="number" name='alas' placeholder="Dalam cm" required><br />
        <label for="tinggi">Tinggi : </label><input id="tinggi" type="number" name='tinggi' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php 
          if( isset($_POST['alas']) && isset($_POST['tinggi']) ) {
              segitiga($_POST['alas'], $_POST['tinggi']);
          }
        ?>
      </fieldset>
    </form>
<br />
    <form action="" method="post">
      <fieldset>
        <legend>Luas Layang-Layang</legend>
        <label for="d1">Diagonal 1 : </label><input id="d1" type="number" name='d1' placeholder="Dalam cm" required><br />
        <label for="d2">Diagonal 2 : </label><input id="d2" type="number" name='d2' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php 
          if( isset($_POST['d1']) && isset($_POST['d2']) ) {
              layangan($_POST['d1'], $_POST['d2']);
          } 
        ?>
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

        <?php
          if( isset($_POST['A1']) && isset($_POST['A2']) ) {
              trapezoid($_POST['A1'],$_POST['A2'],$_POST['T']);
          } 
        ?>
      </fieldset>
    </form>
    <a href="bangun_datar.php"><button>Bersihkan</button></a>
</body>
</html>