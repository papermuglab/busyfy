<?php

include_once APPPATH . 'custom_class/Model.php';

class Lead_model extends CI_Model {

    public function getList($offset = 0, $vendorID = '', $keyWord = '', $status = '') {
        $this->db->select('t.lead_id, p.name, s.name AS staff_name, t.status, t.added_on');
        $this->db->from(TBL_LEADS . ' AS t');
        $this->db->join(TBL_PRODUCTS . ' AS p', 'p.product_id = t.product_id');
        $this->db->join(TBL_STAFF . ' AS s', 's.staff_id = t.assigned_to');
        $this->db->where('t.is_deleted', NOT_DELETED);
        if (!empty($vendorID) && $vendorID != 'all') {
            $this->db->like('t.vendor_id', $vendorID);
        }
        if (!empty($keyWord)) {
            $this->db->where('(p.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('t.status', $status);
        }
        $this->db->order_by('t.added_on', 'DESC');
        $this->db->limit(Model::ADMIN_PAGE_LIMIT, $offset);
        return $this->db->get()->result_array();
    }

    public function getListCount($vendorID = '', $keyWord = '', $status = '') {
        $this->db->select('COUNT(t.lead_id) AS total');
        $this->db->from(TBL_LEADS . ' AS t');
        $this->db->join(TBL_PRODUCTS . ' AS p', 'p.product_id = t.product_id');
        $this->db->join(TBL_STAFF . ' AS s', 's.staff_id = t.assigned_to');
        $this->db->where('t.is_deleted', NOT_DELETED);
        if (!empty($vendorID) && $vendorID != 'all') {
            $this->db->like('t.vendor_id', $vendorID);
        }
        if (!empty($keyWord)) {
            $this->db->where('(p.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('t.status', $status);
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

    public function getProducts($vendorID) {
        $this->db->select('product_id AS id, name');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('vendor_id', $vendorID);
        $this->db->where('status', ACTIVE);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getStaff($vendorID) {
        $this->db->select('staff_id AS id, name');
        $this->db->from(TBL_STAFF);
        $this->db->where('vendor_id', $vendorID);
        $this->db->where('status', ACTIVE);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getDetails($taskID) {
        $this->db->select('t.*');
        $this->db->select('p.name');
        $this->db->from(TBL_LEADS . ' AS t');
        $this->db->join(TBL_PRODUCTS . ' AS p', 'p.product_id = t.product_id');
        $this->db->where('t.lead_id', $taskID);
        $this->db->where('t.is_deleted', NOT_DELETED);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

}
