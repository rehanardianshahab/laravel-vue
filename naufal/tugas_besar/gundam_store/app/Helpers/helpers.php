<?php

function convert_date($value) {
    return date('d/m/Y', strtotime($value));
}

function change_currency($num) {
    $currency = "Rp ".number_format($num, 2, ",", ".");

    return $currency;
}

function show_stat($stat) {
    if($stat == 1) {
        return "Paid";
    } else {
        return "Not Paid";
    }
}

function limit_days($repayment_date) {
    $today = strtotime(date('d-m-Y'));
    $limit = strtotime($repayment_date);

    $limit_notif = abs($today - $limit);
    $limit_notif_days = $limit_notif/60/60/24;

    return $limit_notif_days;
}

function percentage($val1, $val2) {
    $percent = ($val1 / $val2) * 100;
    $value = number_format($percent, 2, ",", ".");

    return $value;
}

?>