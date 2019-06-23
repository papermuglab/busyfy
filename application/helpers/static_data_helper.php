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

function getAccountStatus() {
    return array('0' => 'In Process', '1' => 'Active', '2' => 'Need to Resolve comments', '3' => 'Discarded');
}

function getAccountStatusName($id) {
    $name = '';
    switch ($id) {
        case 0:
            $name = 'In Process';
            break;
        case 1:
            $name = 'Active';
            break;
        case 2:
            $name = 'Need to Resolve comments';
            break;
        case 3:
            $name = 'Discarded';
            break;
    }
    return $name;
}

function getNormalStatus() {
    return array(0 => 'Inactive', 1 => 'Active');
}

function getNormalStatusName($id) {
    $name = '';
    switch ($id) {
        case 0:
            $name = 'Inactive';
            break;
        case 1:
            $name = 'Active';
            break;
    }
    return $name;
}

function getTaskStatus() {
    return array(0 => 'In process', 1 => 'Completed', 2 => 'Cancelled');
}

function getTaskStatusName($type) {
    $name = '';
    switch ($type) {
        case 0:
            $name = 'In process';
            break;
        case 1:
            $name = 'Completed';
            break;
        case 2:
            $name = 'Cancelled';
            break;
        default:
            break;
    }
    return $name;
}
