<?php

function encrypt($value) {
    return base64_encode($value);
}

function dycrypt($value) {
    return base64_decode($value);
}
