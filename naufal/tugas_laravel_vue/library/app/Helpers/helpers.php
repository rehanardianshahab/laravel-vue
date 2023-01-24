<?php

    function convert_date($value) {
        return date('d/m/Y', strtotime($value));
    }

    function count_days($date_start, $date_end) {
        $date1 = strtotime($date_start);
        $date2 = strtotime($date_end);
        $totalSecondsDiff = abs($date1-$date2);
        $differentDays = $totalSecondsDiff/24/60/60;

        return $differentDays;
    }

    function show_stat($stat) {
        if($stat == 1) {
            return "Returned";
        } else {
            return "Haven't Returned";
        }
    }

    function change_currency($num) {
        $currency = "Rp ".number_format($num, 2, ",", ".");

        return $currency;
    }

    function limit_days($date_end) {
        $today = strtotime(date('d-m-Y'));
        $limit = strtotime($date_end);

        $limit_notif = abs($today - $limit);
        $limit_notif_days = $limit_notif/60/60/24;

        return $limit_notif_days;
    }

?>