<?php

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('check_vendor_session', 'encrypt_uri'));
        isLoggedIn();
        $this->load->model('vendor/dashboard_model', 'model');
    }

    public function index($status = '') {
        $data['status'] = dycrypt($status);
        $data['counts'] = $this->model->getCounts();
        $this->displayVendor('dashboard/index', $data, true);
    }

}
