<?php

class Staff extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_admin_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_random_string'));
        $this->load->model('admin/staff_model', 'model');
        isLoggedIn();
    }

    public function index() {
        $this->load->config('pagination');
        $config = $this->config->item('pagination');
        $selectedVendor = $this->uri->segment(4) != '' ? urldecode($this->uri->segment(4)) : '';
        $keyWord = (empty($this->uri->segment(5))) ? 0 : urldecode($this->uri->segment(5));
        $status = $this->uri->segment(6) != '' ? urldecode($this->uri->segment(6)) : '';
        $offset = (empty($this->uri->segment(7))) ? 0 : $this->uri->segment(7);
        $config["uri_segment"] = 7;
        $config["base_url"] = base_url('admin/staff/index/' . urlencode($selectedVendor) . '/' . urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($selectedVendor, $keyWord, $status);
        $this->pagination->initialize($config);
        $data['selectedVendor'] = $selectedVendor;
        $data['staffs'] = $this->model->getList($offset, $selectedVendor, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['offset'] = $offset;
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('staff/list', $data, true);
    }

    public function add() {
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('staff/add', $data, true);
    }

    public function edit($staffEncryptID) {
        $staffID = dycrypt($staffEncryptID);
        $data['staff'] = $this->dml->getRow(TBL_STAFF, 'staff_id', $staffID);
        $this->displayAdmin('staff/add', $data, true);
    }

    public function save() {
        $staffID = $this->input->post('staff_id');
        if ($this->form_validation->run('vendor_add_staff') == true) {
            $staff['name'] = $this->input->post('name');
            $staff['email'] = $this->input->post('email');
            $staff['mobile'] = $this->input->post('mobile');
            $staff['address'] = $this->input->post('address');
            $staff['status'] = $this->input->post('status');
            if (!empty($staffID)) { // Update
                $this->dml->update(TBL_STAFF, 'staff_id', $staffID, $staff);
                $message = getDesignedMessage('Staff profile updated successfully.');
            } else { // Insert
                $staff['vendor_id'] = $this->input->post('vendor_id');
                $staff['password'] = md5(getRandomString(6));
                $this->dml->insert(TBL_STAFF, $staff);
                $message = getDesignedMessage('Staff profile saved successfully.');
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('admin/staff/'));
        } else {
            if (!empty($staffID)) {
                $this->edit(encrypt($staffID));
            } else {
                $this->add();
            }
        }
    }

}
