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
        <legend>Kalkulator IBM</legend>
        <label for="nama">Nama : </label><input id="nama" type="text" name='nama' placeholder="Nama Kamu" required><br />
        <label for="tinggi">Tinggi badan : </label><input id="tinggi" type="number" name='tinggi' placeholder="Dalam Kg" required><br />
        <label for="berat">Berat badan : </label><input id="berat" type="number" name='berat' placeholder="Dalam cm" required>
        <button name="submit">submit</button>

        <?php
          if ( isset($_POST['submit']) ) {
            $nama = $_POST['nama'];
            $rumus_metrik = ($_POST['berat']/$_POST['tinggi']/$_POST['tinggi'])*10000;
            $rumus_metrik = number_format($rumus_metrik, 2, '.', '');
          }
        ?>
        <?php if ( isset($_POST['submit']) ) : ?>
          <?php if( $rumus_metrik < 17 ) : ?>
              <p>Halo <?= $nama; ?>. Nilai IBM kamu adalah <?=$rumus_metrik ?>, kamu termasuk sangat kurus.</p>
            <?php elseif ( $rumus_metrik >= 17 && $rumus_metrik <= 18.4 ) : ?>
              <p>Halo <?= $nama; ?>. Nilai IBM kamu adalah <?=$rumus_metrik ?>, kamu termasuk kurus.</p>
            <?php elseif ( $rumus_metrik >= 18.5 && $rumus_metrik <= 25 ) : ?>
              <p>Halo <?= $nama; ?>. Nilai IBM kamu adalah <?=$rumus_metrik ?>, kamu termasuk ideal.</p>
            <?php elseif ( $rumus_metrik >= 25.1 && $rumus_metrik <= 27 ) : ?>
              <p>Halo <?= $nama; ?>. Nilai IBM kamu adalah <?=$rumus_metrik ?>, kamu termasuk gemuk.</p>
            <?php elseif ( $rumus_metrik >= 27.1 && $rumus_metrik <= 30 ) : ?>
              <p>Halo <?= $nama; ?>. Nilai IBM kamu adalah <?=$rumus_metrik ?>, kamu termasuk kegemukan.</p>
            <?php else : ?>
              <p>Halo <?= $nama; ?>. Nilai IBM kamu adalah <?=$rumus_metrik ?>, kamu termasuk Overdosis.</p>
          <?php endif; ?>
        <?php endif; ?>
      </fieldset>
    </form>
    <a href="kategori.php"><button>Bersihkan</button></a>
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