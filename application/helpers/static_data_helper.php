<?php

function getDomainTypes() {
    return array('1' => 'Market Place', '2' => 'Service');
}

function getDomainType($id) {
    $name = '';
    switch ($id) {
        case 1:
            $name = 'Market Place';
            break;
        case 2:
            $name = 'Service';
            break;
    }
    return $name;
}

function getBankAccountTypes() {
    return array('1' => 'Saving Account', '2' => 'Current Account', '3' => 'Salary Account');
}

function getAccountType($id) {
    $name = '';
    switch ($id) {
        case 1:
            $name = 'Saving Account';
            break;
        case 2:
            $name = 'Current Account';
            break;
        case 3:
            $name = 'Salary Account';
            break;
    }
    return $name;
}