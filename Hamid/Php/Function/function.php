<?php

// Luas segitiga
function luasSegitiga($alas, $tinggi) {
    $luas = 0.5 * $alas * $tinggi;
    return $luas;
  }
  
  // contoh penggunaan
  $alas = 10;
  $tinggi = 8;
  $luas = luasSegitiga($alas, $tinggi);
  echo "Luas segitiga dengan alas $alas dan tinggi $tinggi adalah $luas<br>";
  
// Volume balok

function volumeBalok($panjang, $lebar, $tinggi) {
    $volume = $panjang * $lebar * $tinggi;
    return $volume;
  }
  
  // contoh penggunaan
  $panjang = 5;
  $lebar = 4;
  $tinggi = 3;
  $volume = volumeBalok($panjang, $lebar, $tinggi);
  echo "Volume balok dengan panjang $panjang, lebar $lebar, dan tinggi $tinggi adalah $volume<br>";
  
// Luas Lingkaran
function luasLingkaran($jari) {
    $luas = pi() * $jari * $jari;
    return $luas;
  }
  
  // contoh penggunaan
  $jari = 7;
  $luas = luasLingkaran($jari);
  echo "Luas lingkaran dengan jari-jari $jari adalah $luas<br>";

// Volume Bola
function volumeBola($jari) {
    $volume = 4 / 3 * pi() * $jari * $jari * $jari;
    return $volume;
  }
  
  // contoh penggunaan
  $jari = 12;
  $volume = volumeBola($jari);
  echo "Volume bola dengan jari-jari $jari adalah $volume<br>";

// Luas Permukaan Kubus
function luasPermukaanKubus($sisi) {
    $luas = 6 * $sisi * $sisi;
    return $luas;
  }
  
  // contoh penggunaan
  $sisi = 5;
  $luas = luasPermukaanKubus($sisi);
  echo "Luas permukaan kubus dengan sisi $sisi adalah $luas<br>";
  


?>