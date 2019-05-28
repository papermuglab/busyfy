<?php

class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml'));
        $this->load->helper(array('check_admin_session', 'get_designed_message'));
        $this->load->model('admin/profile_model', 'model');
        isLoggedIn();
    }

    public function index() {
        $adminId = $this->session->userdata('admin_id');
        $data['row'] = $this->dml->getRow(TBL_ADMINS, 'admin_id', $adminId);
        $this->displayAdmin('profile/edit', $data, true);
    }

    public function save() {
        $this->load->helper('upload_file');
        if ($this->form_validation->run('admin_edit_profile') == TRUE) {
            $adminId = $this->session->userdata('admin_id');

            // Vendor Company and Personal Details
            $adminParaArr['name'] = $this->input->post('name');
            $adminParaArr['email'] = $this->input->post('email');
            $this->dml->update(TBL_ADMINS, 'admin_id', $adminId, $adminParaArr);

            $this->session->set_userdata('admin_name', $adminParaArr['name']);
            // Prepare Message
            $this->session->set_flashdata('message', getDesignedMessage("Profile updated successfully."));
            redirect(base_url('admin/profile'));
        } else {
            $this->index();
        }
    }

    public function changePassword() {
        $this->displayAdmin('profile/change-password');
    }

    public function checkPassword() {
        if ($this->form_validation->run('change_password') == TRUE) {
            $currentAdminId = $this->session->userdata('admin_id');
            $params['old_password'] = md5($this->input->post('old_password'));
            $params['password'] = md5($this->input->post('new_password'));
            if ($this->model->isOldPasswordCorrect($params['old_password'], $currentAdminId)) { // Valid old password
                unset($params['old_password']);
                $result = $this->dml->update(TBL_ADMINS, 'admin_id', $currentAdminId, $params);
                if ($result['status']) {
                    $message = getDesignedMessage('Password is changed successfully.');
                } else {
                    $message = getDesignedMessage('Something wrong happened, Please try again.', 2);
                }
            } else { // Wrong Old Password
                $message = getDesignedMessage('Old Password is wrong, Please try again with correct password.', 2);
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('admin/profile/changePassword'));
        } else {
            $this->changePassword();
        }
    }

}
