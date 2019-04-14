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
        $vendorId = $this->session->userdata('vendor_id');
        $data['vendorRow'] = $this->dml->getRow(TBL_VENDORS, 'vendor_id', $vendorId);
        $data['bankRow'] = $this->dml->getRow(TBL_VENDOR_BANKS, 'vendor_id', $vendorId);
        $this->displayVendor('profile/edit', $data, true);
    }

    public function save() {
        $this->load->helper('upload_file');
        if ($this->form_validation->run('vendor_edit_profile') == TRUE) {
            $vendorId = $this->session->userdata('vendor_id');

            // Vendor Company and Personal Details
            $vendorParaArr['name'] = $this->input->post('name');
            $vendorParaArr['company_name'] = $this->input->post('company_name');
            $vendorParaArr['billing_address'] = $this->input->post('billing_address');
            $vendorParaArr['latitude'] = $this->input->post('latitude');
            $vendorParaArr['longitude'] = $this->input->post('longitude');
            $vendorParaArr['domain_type'] = $this->input->post('domain_type');
            $vendorParaArr['gst_no'] = $this->input->post('gst_no');
            $vendorParaArr['pan_no'] = $this->input->post('pan_no');
            if (!empty($_FILES['licence_copy']['name'])) {
                $vendorParaArr['licence_copy_file'] = uploadFile('licence_copy');
            }
            if (!empty($_FILES['incorporation_copy']['name'])) {
                $vendorParaArr['incorporation_certification_file'] = uploadFile('incorporation_copy');
            }
            $this->dml->update(TBL_VENDORS, 'vendor_id', $vendorId, $vendorParaArr);

            // Vendor Bank Details
            $vendorBankParaArr['bank_name'] = $this->input->post('bank_name');
            $vendorBankParaArr['account_type'] = $this->input->post('bank_account_type');
            $vendorBankParaArr['account_no'] = $this->input->post('account_no');
            $vendorBankParaArr['ifsc_code'] = $this->input->post('ifsc_code');
            if ($this->model->isVendorAvailableInBank($vendorId)) { // Update
                $this->dml->update(TBL_VENDOR_BANKS, 'vendor_id', $vendorId, $vendorBankParaArr);
            } else { // Insert
                $vendorBankParaArr['vendor_id'] = $vendorId;
                $this->dml->insert(TBL_VENDOR_BANKS, $vendorBankParaArr);
            }

            // Prepare Message
            $this->session->set_flashdata('message', getDesignedMessage("Profile updated successfully."));
            redirect(base_url('vendor/profile'));
        } else {
            $this->index();
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
