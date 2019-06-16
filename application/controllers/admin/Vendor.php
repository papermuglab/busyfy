<?php

class Vendor extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_admin_session', 'get_designed_message', 'static_data', 'encrypt_uri'));
        $this->load->model('admin/vendor_model', 'model');
        isLoggedIn();
    }

    public function index() {
        $this->load->config('pagination');
        $config = $this->config->item('pagination');
        $keyWord = (empty($this->uri->segment(4))) ? 0 : urldecode($this->uri->segment(4));
        $status = $this->uri->segment(5) != '' ? urldecode($this->uri->segment(5)) : '';
        $offset = (empty($this->uri->segment(6))) ? 0 : $this->uri->segment(6);
        $config["uri_segment"] = 6;
        $config["base_url"] = base_url('admin/vendor/index/' . urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($keyWord, $status);
        $this->pagination->initialize($config);
        $data['vendors'] = $this->model->getList($offset, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['offset'] = $offset;
        $this->displayAdmin('vendor/list', $data, true);
    }

    public function join() {
        $this->displayAdmin('vendor/join');
    }

    public function correct($vendorEncryptID) {
        $vendorID = dycrypt($vendorEncryptID);
        $data['vendor'] = $this->dml->getRow(TBL_VENDORS, 'vendor_id', $vendorID);
        $data['bank'] = $this->dml->getRow(TBL_VENDOR_BANK_DETAILS, 'vendor_id', $vendorID);
        $data['company'] = $this->dml->getRow(TBL_VENDOR_COMPANY_DETAILS, 'vendor_id', $vendorID);
        $this->displayAdmin('vendor/join', $data, true);
    }

    public function edit($vendorEncryptID) {
        $vendorID = dycrypt($vendorEncryptID);
        $data['vendor'] = $this->dml->getRow(TBL_VENDORS, 'vendor_id', $vendorID);
        $data['bank'] = $this->dml->getRow(TBL_VENDOR_BANK_DETAILS, 'vendor_id', $vendorID);
        $data['company'] = $this->dml->getRow(TBL_VENDOR_COMPANY_DETAILS, 'vendor_id', $vendorID);
        $this->displayAdmin('vendor/add', $data, true);
    }

    public function save() {
        $vendorID = $this->input->post('vendor_id');
        $this->saveVendor($vendorID);
        $this->saveBankDetails($vendorID);
        $this->saveCompanyDetails($vendorID);
        $this->session->set_flashdata('message', getDesignedMessage('Vendor profile updated successfully.'));
        redirect(base_url('admin/vendor/'));
    }

    public function saveVendor($vendorID) {
        $vendor['owner_name'] = $this->input->post('owner_name');
        $vendor['email'] = $this->input->post('email');
        $vendor['mobile'] = $this->input->post('mobile');
        //$vendor['password'] = md5($this->input->post('password'));
        $vendor['residential_address'] = $this->input->post('residential_address');
        $vendor['company_name'] = $this->input->post('company_name');
        $vendor['domain_type'] = $this->input->post('domain_type');
        $vendor['billing_address'] = $this->input->post('billing_address');
        $vendor['status'] = $this->input->post('status');
        if (empty($vendorID) && $this->model->isAvailable(TBL_VENDORS, $vendorID) === false) { // Insert
            $result = $this->dml->insert(TBL_VENDORS, $vendor);
        } else { // Update
            $result = $this->dml->update(TBL_VENDORS, 'vendor_id', $vendorID, $vendor);
        }
        return $result;
    }

    public function saveBankDetails($vendorID) {
        $bank['bank_name'] = $this->input->post('bank_name');
        $bank['account_type'] = $this->input->post('account_type');
        $bank['account_no'] = $this->input->post('account_no');
        $bank['ifsc_code'] = $this->input->post('ifsc_code');
        if (!empty($vendorID) && $this->model->isAvailable(TBL_VENDOR_BANK_DETAILS, $vendorID) === false) { // Insert
            $bank['vendor_id'] = $vendorID;
            $this->dml->insert(TBL_VENDOR_BANK_DETAILS, $bank);
        } else { // Update
            $this->dml->update(TBL_VENDOR_BANK_DETAILS, 'vendor_id', $vendorID, $bank);
        }
    }

    public function saveCompanyDetails($vendorID) {
        $this->load->helper('upload_file');
        $companyDetails['gst_no'] = $this->input->post('gst_no');
        $companyDetails['pan_no'] = $this->input->post('pan_no');
        $companyDetails['tin_no'] = $this->input->post('tin_no');
        $companyDetails['service_tax_id'] = $this->input->post('service_tax_id');
        $companyDetails['gst_verified'] = $this->input->post('gst_verified');
        $companyDetails['gst_comment'] = $this->input->post('gst_comment');
        $companyDetails['tin_verified'] = $this->input->post('tin_verified');
        $companyDetails['tin_comment'] = $this->input->post('tin_comment');
        $companyDetails['pan_verified'] = $this->input->post('pan_verified');
        $companyDetails['pan_comment'] = $this->input->post('pan_comment');
        $companyDetails['service_tax_id_verified'] = $this->input->post('service_tax_id_verified');
        $companyDetails['service_tax_id_comment'] = $this->input->post('service_tax_id_comment');
        $companyDetails['comment'] = $this->input->post('comment');
        if (!empty($_FILES['gst_doc']['name'])) {
            $companyDetails['gst_doc'] = uploadFile('gst_doc', 'gst/');
        }
        if (!empty($_FILES['pan_doc']['name'])) {
            $companyDetails['pan_doc'] = uploadFile('pan_doc', 'pan/');
        }
        if (!empty($_FILES['tin_doc']['name'])) {
            $companyDetails['tin_doc'] = uploadFile('tin_doc', 'tin/');
        }
        if (!empty($_FILES['service_tax_doc']['name'])) {
            $companyDetails['service_tax_doc'] = uploadFile('service_tax_doc', 'service_tax/');
        }
        if (!empty($vendorID) && $this->model->isAvailable(TBL_VENDOR_COMPANY_DETAILS, $vendorID) === false) { // Insert
            $companyDetails['vendor_id'] = $vendorID;
            $this->dml->insert(TBL_VENDOR_COMPANY_DETAILS, $companyDetails);
        } else { // Update
            $this->dml->update(TBL_VENDOR_COMPANY_DETAILS, 'vendor_id', $vendorID, $companyDetails);
        }
    }

    public function insert() {
        $vendorID = $this->input->post('vendor_id');
        $result = $this->saveVendor($vendorID);
        $this->saveBankDetails($result['id']);
        $this->saveCompanyDetails($result['id']);
        if (empty($vendorID)) { // Insert
            $message = getDesignedMessage('Vendor profile saved successfully.');
        } else { // Update
            $message = getDesignedMessage('Vendor profile updated successfully.');
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url('admin/vendor/'));
    }

}
