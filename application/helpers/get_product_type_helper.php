<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the get_product_type_helper.
 */

function getProductTypes() {
    return array(1 => 'Physical Product', 2 => 'Service');
}

function getProductType($type) {
    $name = '';
    switch ($type) {
        case 1:
            $name = 'Physical Product';
            break;
        case 2:
            $name = 'Service';
            break;
        default:
            break;
    }
    return $name;
}
