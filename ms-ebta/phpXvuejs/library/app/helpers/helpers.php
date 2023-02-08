<?php

function tanggal($data) {
    return date('H:i:s - d/M/Y', strtotime($data));
}