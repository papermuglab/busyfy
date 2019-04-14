<?php

function isLoggedIn() {
    $CI = & get_instance();
    $vendorId = $CI->session->userdata('vendor_id');
    if (!$vendorId) {
        redirect(base_url('vendor/login'));
    }
}

?>