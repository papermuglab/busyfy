<?php

function getRandomString($limit) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $limit; $i++) {
        $string .= $characters[mt_rand(0, $max)];
    }
    return $string;
}
