<?php

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('check_vendor_session'));
        isLoggedIn();
    }

    public function index() {
        $this->displayVendor('dashboard/index');
    }

}
