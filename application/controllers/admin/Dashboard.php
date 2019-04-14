<?php

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('check_admin_session'));
        isLoggedIn();
    }

    public function index() {
        $this->displayAdmin('dashboard/index');
    }

}
