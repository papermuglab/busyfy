<?php

class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml'));
        $this->load->helper(array('check_vendor_session', 'get_designed_message', 'static_data'));
        $this->load->model('vendor/profile_model', 'model');
        isLoggedIn();
    }

    public function index() {
        $vendorID = $this->session->userdata('vendor_id');
        $data['vendor'] = $this->dml->getRow(TBL_VENDORS, 'vendor_id', $vendorID);
        $data['bank'] = $this->dml->getRow(TBL_VENDOR_BANK_DETAILS, 'vendor_id', $vendorID);
        $data['company'] = $this->dml->getRow(TBL_VENDOR_COMPANY_DETAILS, 'vendor_id', $vendorID);
        $this->displayVendor('profile/edit', $data, true);
    }

    public function save() {
        $vendorID = $this->input->post('vendor_id');
        $this->saveVendor($vendorID);
        $this->saveBankDetails($vendorID);
        $this->saveCompanyDetails($vendorID);
        $this->session->set_flashdata('message', getDesignedMessage('Profile updated successfully.'));
        redirect(base_url('vendor/profile'));
    }

    public function saveVendor($vendorID) {
        $vendor['owner_name'] = $this->input->post('owner_name');
        $vendor['email'] = $this->input->post('email');
        $vendor['mobile'] = $this->input->post('mobile');
        $vendor['residential_address'] = $this->input->post('residential_address');
        $vendor['company_name'] = $this->input->post('company_name');
        $vendor['domain_type'] = $this->input->post('domain_type');
        $vendor['billing_address'] = $this->input->post('billing_address');
        if ($this->model->isAvailable(TBL_VENDORS, $vendorID) === false) { // Insert
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
        if ($this->model->isAvailable(TBL_VENDOR_BANK_DETAILS, $vendorID) === false) { // Insert
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
        if ($this->model->isAvailable(TBL_VENDOR_COMPANY_DETAILS, $vendorID) === false) { // Insert
            $companyDetails['vendor_id'] = $vendorID;
            $this->dml->insert(TBL_VENDOR_COMPANY_DETAILS, $companyDetails);
        } else { // Update
            $this->dml->update(TBL_VENDOR_COMPANY_DETAILS, 'vendor_id', $vendorID, $companyDetails);
        }
    }

    public function changePassword() {
        $this->displayVendor('profile/change-password');
    }

    public function isUniqueGSTNo($value) {
        $vendorId = $this->session->userdata('vendor_id');
        if (!empty($value) && $this->model->isUniqueGSTNo($value, $vendorId) === false) {
            $this->form_validation->set_message('isUniqueGSTNo', 'The {field} must be unique.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isUniquePANNo($value) {
        $vendorId = $this->session->userdata('vendor_id');
        if (!empty($value) && $this->model->isUniquePANNo($value, $vendorId) === false) {
            $this->form_validation->set_message('isUniquePANNo', 'The {field} must be unique.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkPassword() {
        if ($this->form_validation->run('change_password') == TRUE) {
            $currentVendorId = $this->session->userdata('vendor_id');
            $params['old_password'] = md5($this->input->post('old_password'));
            $params['password'] = md5($this->input->post('new_password'));
            if ($this->model->isOldPasswordCorrect($params['old_password'], $currentVendorId)) { // Valid old password
                unset($params['old_password']);
                $result = $this->dml->update(TBL_VENDORS, 'vendor_id', $currentVendorId, $params);
                if ($result['status']) {
                    $message = getDesignedMessage('Password is changed successfully.');
                } else {
                    $message = getDesignedMessage('Something wrong happened, Please try again.', 2);
                }
            } else { // Wrong Old Password
                $message = getDesignedMessage('Old Password is wrong, Please try again with correct password.', 2);
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('vendor/profile/changePassword'));
        } else {
            $this->changePassword();
        }
    }

}
