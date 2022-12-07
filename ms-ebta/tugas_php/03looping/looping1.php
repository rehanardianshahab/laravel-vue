<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Looping</title>
</head>
<body>
    <?php
      for ($i=1, $j=0 ; $i <= 9; $i++) {
        $j = $j."";
        echo $j.'<br>';
        $j = $j."".$i;
      }
    ?>
</body>
</html>