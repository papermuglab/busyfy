<?php

function isLoggedIn() {
    $CI = & get_instance();
    $adminId = $CI->session->userdata('admin_id');
    if (!$adminId) {
        redirect(base_url('admin/login'));
    }
}

?>