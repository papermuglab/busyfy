<?php

class Product extends MY_Controller {

    private $vendorID;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_vendor_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_product_type'));
        $this->load->model('vendor/product_model', 'model');
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
        $config["base_url"] = base_url('vendor/staff/index/'. urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($keyWord, $status);
        $this->pagination->initialize($config);
        $data['products'] = $this->model->getList($offset, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $this->displayVendor('product/list', $data, true);
    }

    public function add() {
        $this->displayVendor('product/add');
    }

    public function edit($productEncryptID) {
        $productID = dycrypt($productEncryptID);
        $data['product'] = $this->dml->getRow(TBL_PRODUCTS, 'product_id', $productID);
        $this->displayVendor('product/add', $data, true);
    }

    public function save() {
        $productID = $this->input->post('product_id');
        $product['name'] = $this->input->post('name');
        $product['sku'] = $this->input->post('sku');
        $product['type'] = $this->input->post('type');
        $product['cost'] = $this->input->post('cost');
        $product['status'] = $this->input->post('status');
        if (!empty($productID)) { // Update
            $this->dml->update(TBL_PRODUCTS, 'product_id', $productID, $product);
            $message = getDesignedMessage('Product updated successfully.');
        } else { // Insert
            $product['vendor_id'] = $this->vendorID;
            $this->dml->insert(TBL_PRODUCTS, $product);
            $message = getDesignedMessage('Product saved successfully.');
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url('vendor/product/'));
    }

}
