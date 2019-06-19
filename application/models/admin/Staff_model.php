<?php

include_once APPPATH . 'custom_class/Model.php';

class Staff_model extends CI_Model {

    public function getList($offset = 0, $vendorID = '', $keyWord = '', $status = '') {
        $this->db->select('s.staff_id, s.name, s.email, s.mobile, s.status');
        $this->db->select('(SELECT COUNT(*) FROM ' . TBL_STAFF_TASKS . ' WHERE assigned_to = s.staff_id AND status = 0) AS total_task', false);
        $this->db->from(TBL_STAFF . ' AS s');
        $this->db->where('s.is_deleted', NOT_DELETED);
        if (!empty($vendorID) && $vendorID != 'all') {
            $this->db->like('s.vendor_id', $vendorID);
        }
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

    public function getListCount($vendorID = '', $keyWord = '', $status = '') {
        $this->db->select('COUNT(s.staff_id) AS total');
        $this->db->from(TBL_STAFF . ' AS s');
        $this->db->where('s.is_deleted', NOT_DELETED);
        if (!empty($vendorID) && $vendorID != 'all') {
            $this->db->like('s.vendor_id', $vendorID);
        }
        if (!empty($keyWord)) {
            $this->db->where('(s.name LIKE "%' . $keyWord . '%" OR s.email LIKE "%' . $keyWord . '%" OR s.mobile LIKE "%' . $keyWord . '%")');
        }
        if ($status != 'all') {
            $this->db->like('s.status', $status);
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

    public function checkUniqueness($field, $value, $vendorID, $staffID = 0) {
        $this->db->select('COUNT(staff_id) AS total');
        $this->db->from(TBL_STAFF);
        $this->db->where($field, $value);
        $this->db->where('vendor_id', $vendorID);
        if ($staffID) {
            $this->db->where('staff_id !=', $staffID);
        }
        return 0 == $this->db->get()->row()->total ? true : false;
    }

}
