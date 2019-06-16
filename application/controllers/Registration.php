<?php

/*
 * This controller will responsible for Vendor Registration.
 */

class Registration extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('static_data'));
        $this->load->library(array('dml', 'form_validation'));
    }

    public function index() {
        $this->load->view('vendor/registration/index');
    }

    public function message($messageID) {
        $data['id'] = $messageID;
        $this->load->view('vendor/registration/message', $data);
    }

    public function save() {
        if ($this->form_validation->run('registration') == TRUE) {
            $vendorID = $this->saveVendor();
            if ($vendorID) { // Success
                $this->saveBankDetails($vendorID);
                $this->saveCompanyDetails($vendorID);
                redirect(base_url('registration/message/1'));
            } else { // Error
                redirect(base_url('registration/message/1'));
            }
        } else {
            $this->index();
        }
    }

    public function saveVendor() {
        $vendor['owner_name'] = $this->input->post('owner_name');
        $vendor['email'] = $this->input->post('email');
        $vendor['mobile'] = $this->input->post('mobile');
        $vendor['password'] = md5($this->input->post('password'));
        $vendor['residential_address'] = $this->input->post('residential_address');
        $vendor['company_name'] = $this->input->post('company_name');
        $vendor['domain_type'] = $this->input->post('domain_type');
        $vendor['billing_address'] = $this->input->post('billing_address');
        $vendor['status'] = INACTIVE;
        $vendor['registered_by'] = SELF_REGISTRATION;
        $result = $this->dml->insert(TBL_VENDORS, $vendor);
        if ($result['status']) {
            return $result['id'];
        } else {
            return 0;
        }
    }

    public function saveBankDetails($vendorID) {
        $bank['vendor_id'] = $vendorID;
        $bank['bank_name'] = $this->input->post('bank_name');
        $bank['account_type'] = $this->input->post('account_type');
        $bank['account_no'] = $this->input->post('account_no');
        $bank['ifsc_code'] = $this->input->post('ifsc_code');
        $this->dml->insert(TBL_VENDOR_BANK_DETAILS, $bank);
    }

    public function saveCompanyDetails($vendorID) {
        $this->load->helper('upload_file');
        $companyDetails['vendor_id'] = $vendorID;
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
        if (!empty($_FILES['logo']['name'])) {
            $companyDetails['logo'] = uploadFile('logo', 'logo/');
        }
        $this->dml->insert(TBL_VENDOR_COMPANY_DETAILS, $companyDetails);
    }

    public function checkGST($value) {
        if (empty($_FILES['gst_doc']['name'])) {
            $this->form_validation->set_message('checkGST', 'The {field} must be required.');
            return FALSE;
        } else {
            if (FILE_SIZE_LIMIT <= $_FILES['gst_doc']['size']) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkGST', 'The {field} size must be less than 2 MB required.');
                return FALSE;
            }
        }
    }

    public function checkPan($value) {
        if (empty($_FILES['pan_doc']['name'])) {
            $this->form_validation->set_message('checkPan', 'The {field} must be required.');
            return FALSE;
        } else {
            if (FILE_SIZE_LIMIT <= $_FILES['pan_doc']['size']) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkPan', 'The {field} size must be less than 2 MB required.');
                return FALSE;
            }
        }
    }

    public function checkTIN($value) {
        if (empty($_FILES['tin_doc']['name'])) {
            $this->form_validation->set_message('checkTIN', 'The {field} must be required.');
            return FALSE;
        } else {
            if (FILE_SIZE_LIMIT <= $_FILES['tin_doc']['size']) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkTIN', 'The {field} size must be less than 2 MB required.');
                return FALSE;
            }
        }
    }

    public function checkServiceTax($value) {
        if (empty($_FILES['service_tax_doc']['name'])) {
            $this->form_validation->set_message('checkServiceTax', 'The {field} must be required.');
            return FALSE;
        } else {
            if (FILE_SIZE_LIMIT <= $_FILES['service_tax_doc']['size']) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkServiceTax', 'The {field} size must be less than 2 MB required.');
                return FALSE;
            }
        }
    }

    public function checkLogo($value) {
        if (empty($_FILES['logo']['name'])) {
            $this->form_validation->set_message('checkLogo', 'The {field} must be required.');
            return FALSE;
        } else {
            if (FILE_SIZE_LIMIT <= $_FILES['logo']['size']) {
                return TRUE;
            } else {
                $this->form_validation->set_message('checkLogo', 'The {field} size must be less than 2 MB required.');
                return FALSE;
            }
        }
    }

}
