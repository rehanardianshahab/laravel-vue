<?php

    // 1. Fungsi luas persegi panjang
    function luasPersegiPanjang($p, $l) {
        $luas = $p * $l;
        echo "Luas persegi panjang = $p x $l = $luas <br>";
    }

    luasPersegiPanjang(4, 12);

    // 2. Fungsi luas persegi
    function luasPersegi($s) {
        $luas = $s * $s;
        echo "Luas persegi = $s x $s = $luas <br>";
    }

    luasPersegi(8);

    // 3. Fungsi luas segitiga
    function luasSegitiga($a, $t) {
        $luas = 0.5 * $a * $t;
        echo "Luas segitiga = 1/2 x $a x $t = $luas <br>";
    }

    luasSegitiga(8, 12);

    // 4. Fungsi volume balok
    function volumeBalok($p, $l, $t) {
        $volume = $p * $l * $t;
        echo "Volume balok = $p x $l x $t = $volume <br>";
    }

    volumeBalok(5, 7, 9);

    // 5. Fungsi volume kubus
    function volumeKubus($s) {
        $volume = $s * $s * $s;
        echo "Volume kubus = $s x $s x $s = $volume <br>";
    }

    volumeKubus(8);
?>