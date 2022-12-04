<?php

// Variabel
$nama = "Orang A";
$tinggi = 1.72;
$beratBadan = 67;
$BMI = $beratBadan / ($tinggi ** 2);
$value = round($BMI, 2);

// If else
if ($BMI < 18.5) {
    echo "Halo, $nama. Nilai BMI Anda adalah $value, anda termasuk kurus";
} else if ($BMI >= 18.5 && $BMI < 25) {
    echo "Halo, $nama. Nilai BMI Anda adalah $value, anda termasuk sedang";
} else {
    echo "Halo, $nama. Nilai BMI Anda adalah $value, anda termasuk gemuk";
};

?>