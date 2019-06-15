<?php

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('check_admin_session'));
        isLoggedIn();
        $this->load->model('admin/dashboard_model', 'model');
    }

    public function index() {
        $data['counts'] = $this->model->getCounts();
        $this->displayAdmin('dashboard/index', $data, true);
    }

}
