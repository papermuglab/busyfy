<?php

class Logout extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->session->set_userdata('admin_id', '');
        $this->session->set_userdata('admin_name', '');
        redirect(base_url('admin/login'));
    }

}
