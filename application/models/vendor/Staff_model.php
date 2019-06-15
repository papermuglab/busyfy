<?php

include_once APPPATH . 'custom_class/Model.php';

class Staff_model extends CI_Model {

    private $vendorID;
    
    public function __construct() {
        parent::__construct();
        $this->vendorID = $this->session->userdata('vendor_id');
    }

    public function getList($offset = 0, $keyWord = '', $status = '') {
        $this->db->select('s.staff_id, s.name, s.email, s.mobile, s.status');
        $this->db->select('(SELECT COUNT(*) FROM ' . TBL_STAFF_TASKS . ' WHERE assigned_to = s.staff_id AND status = 0) AS total_task', false);
        $this->db->from(TBL_STAFF . ' AS s');
        $this->db->where('s.is_deleted', NOT_DELETED);
        $this->db->where('s.vendor_id', $this->vendorID);
        if (!empty($keyWord)) {
            $this->db->where('(s.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%" OR s.mobile LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('s.status', $status);
        }
        $this->db->order_by('s.added_on', 'DESC');
        $this->db->limit(Model::ADMIN_PAGE_LIMIT, $offset);
        return $this->db->get()->result_array();
    }

    public function getListCount($keyWord = '', $status = '') {
        $this->db->select('COUNT(s.staff_id) AS total');
        $this->db->from(TBL_STAFF . ' AS s');
        $this->db->where('s.is_deleted', NOT_DELETED);
        $this->db->where('s.vendor_id', $this->vendorID);
        if (!empty($keyWord)) {
            $this->db->where('(s.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%" OR s.mobile LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('s.status', $status);
        }
        return $this->db->get()->row()->total;
    }

}
