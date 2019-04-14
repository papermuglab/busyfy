<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header('Cache-Control: no-store,no-cache,must-revalidate');
        header('Cache-Control: post-check=0,pre-check=0', false);
        header('Pragma:no-cache');
    }

    public function displayAdmin($common, $data = array(), $return = FALSE) {
        if ($return):
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('admin/' . $common, $data);
            $this->load->view('common/footer');
        else:
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('admin/' . $common);
            $this->load->view('common/footer');
        endif;
    }

    public function displayCA($common, $data = array(), $return = FALSE) {
        if ($return):
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('ca/' . $common, $data);
            $this->load->view('common/footer');
        else:
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('ca/' . $common);
            $this->load->view('common/footer');
        endif;
    }

    public function displayVendor($common, $data = array(), $return = FALSE) {
        if ($return):
            $this->load->view('vendor/common/header');
            $this->load->view('vendor/common/navigation');
            $this->load->view('vendor/' . $common, $data);
            $this->load->view('vendor/common/footer');
        else:
            $this->load->view('vendor/common/header');
            $this->load->view('vendor/common/navigation');
            $this->load->view('vendor/' . $common);
            $this->load->view('vendor/common/footer');
        endif;
    }

}

?>
