<?php

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_admin_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_product_type'));
        $this->load->model('admin/product_model', 'model');
        isLoggedIn();
    }

    public function index() {
        $this->load->config('pagination');
        $config = $this->config->item('pagination');
        $selectedVendor = $this->uri->segment(4) != '' ? urldecode($this->uri->segment(4)) : '';
        $keyWord = (empty($this->uri->segment(5))) ? 0 : urldecode($this->uri->segment(5));
        $status = $this->uri->segment(6) != '' ? urldecode($this->uri->segment(6)) : '';
        $offset = (empty($this->uri->segment(7))) ? 0 : $this->uri->segment(7);
        $config["uri_segment"] = 7;
        $config["base_url"] = base_url('admin/product/index/' . urlencode($selectedVendor) . '/' . urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($selectedVendor, $keyWord, $status);
        $this->pagination->initialize($config);
        $data['selectedVendor'] = $selectedVendor;
        $data['products'] = $this->model->getList($offset, $selectedVendor, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('product/list', $data, true);
    }

    public function add() {
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('product/add', $data, true);
    }

    public function edit($productEncryptID) {
        $productID = dycrypt($productEncryptID);
        $data['product'] = $this->dml->getRow(TBL_PRODUCTS, 'product_id', $productID);
        $this->displayAdmin('product/add', $data, true);
    }

    public function save() {
        $productID = $this->input->post('product_id');
        if ($this->form_validation->run('vendor_add_product') == true) {
            $product['name'] = $this->input->post('name');
            $product['sku'] = $this->input->post('sku');
            $product['type'] = $this->input->post('type');
            $product['cost'] = $this->input->post('cost');
            $product['status'] = $this->input->post('status');
            if (!empty($productID)) { // Update
                $this->dml->update(TBL_PRODUCTS, 'product_id', $productID, $product);
                $message = getDesignedMessage('Product updated successfully.');
            } else { // Insert
                $product['vendor_id'] = $this->input->post('vendor_id');
                $this->dml->insert(TBL_PRODUCTS, $product);
                $message = getDesignedMessage('Product saved successfully.');
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('admin/product/'));
        } else {
            if (!empty($productID)) {
                $this->edit(encrypt($productID));
            } else {
                $this->add();
            }
        }
    }

    public function getProductPrice() {
        $productID = $this->input->get('productID');
        echo $this->model->getPrice($productID);
    }

}
