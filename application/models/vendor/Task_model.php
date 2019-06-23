<?php

include_once APPPATH . 'custom_class/Model.php';

class Task_model extends CI_Model {
    private $vendorID;
    public function __construct() {
        parent::__construct();
        $this->vendorID = $this->session->userdata('vendor_id');
    }

    public function getList($offset = 0, $keyWord = '', $status = '') {
        $this->db->select('t.task_id, p.name, t.pickup_location, t.drop_location, t.pickup_datetime, s.name AS staff_name, t.status');
        $this->db->from(TBL_STAFF_TASKS . ' AS t');
        $this->db->join(TBL_PRODUCTS . ' AS p', 'p.product_id = t.product_id');
        $this->db->join(TBL_STAFF . ' AS s', 's.staff_id = t.assigned_to');
        $this->db->where('t.vendor_id', $this->vendorID);
        $this->db->where('t.is_deleted', NOT_DELETED);
        if (!empty($keyWord)) {
            $this->db->where('(p.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%" OR t.pickup_datetime LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('t.status', $status);
        }
        $this->db->order_by('t.added_on', 'DESC');
        $this->db->limit(Model::ADMIN_PAGE_LIMIT, $offset);
        return $this->db->get()->result_array();
    }

    public function getListCount($keyWord = '', $status = '') {
        $this->db->select('COUNT(t.task_id) AS total');
        $this->db->from(TBL_STAFF_TASKS . ' AS t');
        $this->db->join(TBL_PRODUCTS . ' AS p', 'p.product_id = t.product_id');
        $this->db->join(TBL_STAFF . ' AS s', 's.staff_id = t.assigned_to');
        $this->db->where('t.is_deleted', NOT_DELETED);
        $this->db->where('t.vendor_id', $this->vendorID);
        if (!empty($keyWord)) {
            $this->db->where('(p.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%" OR t.pickup_datetime LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('t.status', $status);
        }
        return $this->db->get()->row()->total;
    }

    public function getProducts() {
        $this->db->select('product_id AS id, name');
        $this->db->from(TBL_PRODUCTS);
        $this->db->where('vendor_id', $this->vendorID);
        $this->db->where('status', ACTIVE);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getStaff() {
        $this->db->select('staff_id AS id, name');
        $this->db->from(TBL_STAFF);
        $this->db->where('vendor_id', $this->vendorID);
        $this->db->where('status', ACTIVE);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getDetails($taskID) {
        $this->db->select('t.*');
        $this->db->select('p.name');
        $this->db->from(TBL_STAFF_TASKS . ' AS t');
        $this->db->join(TBL_PRODUCTS . ' AS p', 'p.product_id = t.product_id');
        $this->db->where('t.task_id', $taskID);
        $this->db->where('t.is_deleted', NOT_DELETED);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

}
