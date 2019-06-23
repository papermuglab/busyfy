<?php

function getLeadStatus() {
    return array(0 => 'In process', 1 => 'Converted to Task', 2 => 'Declined');
}

function getLeadStatusName($type) {
    $name = '';
    switch ($type) {
        case 0:
            $name = 'In process';
            break;
        case 1:
            $name = 'Converted to Task';
            break;
        case 2:
            $name = 'Declined';
            break;
        default:
            break;
    }
    return $name;
}