<?php

function getPaymentModes() {
    return array(1 => 'Online', 2 => 'Offline');
}

function getPaymentModeName($type) {
    $name = '';
    switch ($type) {
        case 1:
            $name = 'Online';
            break;
        case 2:
            $name = 'Offline';
            break;
        default:
            break;
    }
    return $name;
}