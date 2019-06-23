<?php

include_once APPPATH . 'custom_class/Model.php';

class Product_model extends CI_Model {

    private $vendorID;

    public function __construct() {
        parent::__construct();
        $this->vendorID = $this->session->userdata('vendor_id');
    }

    public function getList($offset = 0, $keyWord = '', $status = '') {
        $this->db->select('product_id, name, type, cost, status');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->where('vendor_id', $this->vendorID);
        if (!empty($keyWord)) {
            $this->db->where('(name LIKE "%' . $keyWord . '%" OR sku LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('status', $status);
        }
        $this->db->order_by('added_on', 'DESC');
        $this->db->limit(Model::ADMIN_PAGE_LIMIT, $offset);
        return $this->db->get()->result_array();
    }

    public function getListCount($keyWord = '', $status = '') {
        $this->db->select('COUNT(product_id) AS total');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->where('vendor_id', $this->vendorID);
        if (!empty($keyWord)) {
            $this->db->where('(name LIKE "%' . $keyWord . '%" OR sku LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('status', $status);
        }
        return $this->db->get()->row()->total;
    }

    public function getPrice($productID) {
        $this->db->select('cost');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('product_id', $productID);
        $this->db->limit(1);
        return $this->db->get()->row()->cost;
    }

}
