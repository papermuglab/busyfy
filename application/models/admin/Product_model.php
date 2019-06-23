<?php

include_once APPPATH . 'custom_class/Model.php';

class Product_model extends CI_Model {

    public function getList($offset = 0, $vendorID = '', $keyWord = '', $status = '') {
        $this->db->select('product_id, name, type, cost, status');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('is_deleted', NOT_DELETED);
        if (!empty($vendorID) && $vendorID != 'all') {
            $this->db->like('vendor_id', $vendorID);
        }
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

    public function getListCount($vendorID = '', $keyWord = '', $status = '') {
        $this->db->select('COUNT(product_id) AS total');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('is_deleted', NOT_DELETED);
        if (!empty($vendorID) && $vendorID != 'all') {
            $this->db->like('vendor_id', $vendorID);
        }
        if (!empty($keyWord)) {
            $this->db->where('(name LIKE "%' . $keyWord . '%" OR sku LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('status', $status);
        }
        return $this->db->get()->row()->total;
    }

    public function getVendorList() {
        $this->db->select('vendor_id AS key, owner_name AS value');
        $this->db->from(TBL_VENDORS);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->where('status', ACTIVE);
        $this->db->order_by('value', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getPrice($productID) {
        $this->db->select('cost');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('product_id', $productID);
        $this->db->limit(1);
        return $this->db->get()->row()->cost;
    }
}
