<?php

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('vendor_id') != "") {
            redirect(base_url('vendor/dashboard'));
        }
        $this->load->helper(array('encrypt_uri'));
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('vendor/login/index');
    }

    public function authenticate() {
        $this->load->model('vendor/oauth_model', 'oauth');
        if ($this->form_validation->run('login') == TRUE) {
            $para['email'] = $this->input->post('email');
            $para['password'] = md5($this->input->post('password'));
            $res = $this->oauth->verify($para);
            if (!empty($res)) {
                $this->setSession($res);
                $redirect = $res['status'] == '1' ? 'vendor/dashboard/' : 'vendor/dashboard/' . encrypt($res['status']);
            } else {
                $redirect = 'vendor/login';
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid credentials.</div>');
            }
            redirect(base_url($redirect));
        } else {
            $this->index();
        }
    }

    function setSession($para) {
        $this->session->set_userdata('vendor_id', $para['vendor_id']);
        $this->session->set_userdata('vendor_name', $para['name']);
        $this->session->set_userdata('vendor_status', $para['status']);
    }

}

?>