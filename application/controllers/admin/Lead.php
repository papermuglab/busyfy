<?php

class Lead extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_admin_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_random_string', 'get_lead_data'));
        $this->load->model('admin/lead_model', 'model');
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
        $config["base_url"] = base_url('admin/lead/index/' . urlencode($selectedVendor) . '/' . urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($selectedVendor, $keyWord, $status);
        $this->pagination->initialize($config);
        $data['selectedVendor'] = $selectedVendor;
        $data['leads'] = $this->model->getList($offset, $selectedVendor, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['offset'] = $offset;
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('lead/list', $data, true);
    }

    public function add() {
        if (!empty($this->input->post('vendor_id'))) {
            $vendorID = $this->input->post('vendor_id');
            $data['products'] = $this->model->getProducts($vendorID);
            $data['staffs'] = $this->model->getStaff($vendorID);
        }
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('lead/add', $data, true);
    }

    public function edit($leadEncryptID) {
        $leadID = dycrypt($leadEncryptID);
        $data['lead'] = $this->model->getDetails($leadID);
        if ($data['lead']) {
            $data['products'] = $this->model->getProducts($data['lead']['vendor_id']);
            $data['staffs'] = $this->model->getStaff($data['lead']['vendor_id']);
        } else {
            $this->add();
        }
        $this->displayAdmin('lead/add', $data, true);
    }

    public function save() {
        $leadID = $this->input->post('lead_id');
        if ($this->form_validation->run('vendor_add_lead') == true) {
            $lead['assigned_to'] = $this->input->post('assigned_to');
            $lead['quantity'] = $this->input->post('quantity');
            $lead['status'] = $this->input->post('status');
            $lead['patron_name'] = $this->input->post('name');
            $lead['patron_email'] = $this->input->post('email');
            $lead['patron_mobile'] = $this->input->post('mobile');
            if (!empty($leadID)) { // Update
                $this->dml->update(TBL_LEADS, 'lead_id', $leadID, $lead);
                $message = getDesignedMessage('Lead updated successfully.');
            } else { // Insert
                $lead['vendor_id'] = $this->input->post('vendor_id');
                $lead['product_id'] = $this->input->post('product_id');
                $this->dml->insert(TBL_LEADS, $lead);

                $message = getDesignedMessage('Lead assigned successfully.');
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('admin/lead/'));
        } else {
            if (!empty($leadID)) {
                $this->edit(encrypt($leadID));
            } else {
                $this->add();
            }
        }
    }

    public function getData() {
        $vendorID = $this->input->get('vendorID');
        $params['products'] = $this->model->getProducts($vendorID);
        $params['staff'] = $this->model->getStaff($vendorID);
        echo json_encode($params);
    }

}
