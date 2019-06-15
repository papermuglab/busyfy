<?php

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('check_vendor_session', 'encrypt_uri'));
        isLoggedIn();
    }

    public function index() {
        $status = $this->session->userdata('vendor_status');
        $this->displayVendor('dashboard/index');
    }

}
