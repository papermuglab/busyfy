<?php

class Staff extends MY_Controller {

    private $vendorID;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_vendor_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_random_string'));
        $this->load->model('vendor/staff_model', 'model');
        isLoggedIn();
        $this->vendorID = $this->session->userdata('vendor_id');
    }

    public function index() {
        $this->load->config('pagination');
        $config = $this->config->item('pagination');
        $keyWord = (empty($this->uri->segment(4))) ? 0 : urldecode($this->uri->segment(4));
        $status = $this->uri->segment(5) != '' ? urldecode($this->uri->segment(5)) : '';
        $offset = (empty($this->uri->segment(6))) ? 0 : $this->uri->segment(6);
        $config["uri_segment"] = 6;
        $config["base_url"] = base_url('vendor/staff/index/'. urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($keyWord, $status);
        $this->pagination->initialize($config);
        $data['staffs'] = $this->model->getList($offset, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['offset'] = $offset;
        $this->displayVendor('staff/list', $data, true);
    }

    public function add() {
        $this->displayVendor('staff/add');
    }

    public function edit($staffEncryptID) {
        $staffID = dycrypt($staffEncryptID);
        $data['staff'] = $this->dml->getRow(TBL_STAFF, 'staff_id', $staffID);
        $this->displayVendor('staff/add', $data, true);
    }

    public function save() {
        $staffID = $this->input->post('staff_id');
        $staff['name'] = $this->input->post('name');
        $staff['email'] = $this->input->post('email');
        $staff['mobile'] = $this->input->post('mobile');
        $staff['address'] = $this->input->post('address');
        $staff['status'] = $this->input->post('status');
        if (!empty($staffID)) { // Update
            $this->dml->update(TBL_STAFF, 'staff_id', $staffID, $staff);
            $message = getDesignedMessage('Staff profile updated successfully.');
        } else { // Insert
            $staff['vendor_id'] = $this->vendorID;
            $staff['password'] = md5(getRandomString(6));
            $this->dml->insert(TBL_STAFF, $staff);
            $message = getDesignedMessage('Staff profile saved successfully.');
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url('vendor/staff/'));
    }

}
