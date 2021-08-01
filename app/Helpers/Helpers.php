<?php

if (!function_exists('file_size')) {
    // original source for this code: https://stackoverflow.com/a/23888858
    function file_size($bytes){
        $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%d", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}