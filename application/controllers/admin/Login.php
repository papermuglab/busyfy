<?php

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('admin_id') != "") {
            redirect(base_url('admin/dashboard'));
        }
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('admin/login/index');
    }

    public function authenticate() {
        $this->load->model('admin/oauth_model', 'oauth');
        if ($this->form_validation->run('login') == TRUE) {
            $para['email'] = $this->input->post('email');
            $para['password'] = md5($this->input->post('password'));
            $res = $this->oauth->verify($para);
            if (!empty($res)) {
                $this->setSession($res);
                $redirect = 'admin/dashboard';
            } else {
                $redirect = 'admin/login';
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid credentials.</div>');
            }
            redirect(base_url($redirect));
        } else {
            $this->index();
        }
    }

    function setSession($para) {
        $this->session->set_userdata('admin_id', $para['admin_id']);
        $this->session->set_userdata('admin_role', $para['role_id']);
        $this->session->set_userdata('admin_name', $para['name']);
    }

}

?>