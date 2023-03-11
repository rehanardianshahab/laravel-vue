<?php

function convert_date($value) {
    return date('d/m/Y', strtotime($value));
}

function change_currency($num) {
    $currency = "Rp ".number_format($num, 2, ",", ".");

    return $currency;
}

?>