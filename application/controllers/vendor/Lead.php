<?php

class Lead extends MY_Controller {

    private $vendorID;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_vendor_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_random_string', 'get_lead_data'));
        $this->load->model('vendor/lead_model', 'model');
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
        $config["base_url"] = base_url('vendor/lead/index/' . urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($keyWord, $status);
        $this->pagination->initialize($config);
        $data['leads'] = $this->model->getList($offset, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['offset'] = $offset;
        $this->displayVendor('lead/list', $data, true);
    }

    public function add() {
        $data['products'] = $this->model->getProducts();
        $data['staffs'] = $this->model->getStaff();
        $this->displayVendor('lead/add', $data, true);
    }

    public function edit($leadEncryptID) {
        $leadID = dycrypt($leadEncryptID);
        $data['products'] = $this->model->getProducts();
        $data['staffs'] = $this->model->getStaff();
        $data['lead'] = $this->model->getDetails($leadID);
        $this->displayVendor('lead/add', $data, true);
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
                $lead['vendor_id'] = $this->vendorID;
                $lead['product_id'] = $this->input->post('product_id');
                $this->dml->insert(TBL_LEADS, $lead);

                $message = getDesignedMessage('Lead assigned successfully.');
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('vendor/lead/'));
        } else {
            if (!empty($leadID)) {
                $this->edit(encrypt($leadID));
            } else {
                $this->add();
            }
        }
    }

}
