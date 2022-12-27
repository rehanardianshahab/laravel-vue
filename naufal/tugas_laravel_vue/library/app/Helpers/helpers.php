<?php

    function convert_date($value) {
        return date('d/m/Y', strtotime($value));
    }

?>