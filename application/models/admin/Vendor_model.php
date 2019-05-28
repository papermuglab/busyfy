<?php

include_once APPPATH . 'custom_class/Model.php';

class Vendor_model extends CI_Model {

    public function getList($offset = 0, $keyWord = '', $status = '') {
        $this->db->select('vendor_id, owner_name, email, mobile, status');
        $this->db->from(TBL_VENDORS);
        $this->db->where('is_deleted', NOT_DELETED);
        if (!empty($keyWord)) {
            $this->db->where('(owner_name LIKE "%' . $keyWord . '%" OR email LIKE "%' . $keyWord . '%" OR mobile LIKE "%' . $keyWord . '%")');
        }
        if ($status != '') {
            $this->db->where('status', $status);
        }
        $this->db->order_by('status', 'ASC');
        $this->db->limit(Model::ADMIN_PAGE_LIMIT, $offset);
        return $this->db->get()->result_array();
    }

    public function getListCount($keyWord = '', $status = '') {
        $this->db->select('COUNT(vendor_id) AS total');
        $this->db->from(TBL_VENDORS);
        $this->db->where('is_deleted', NOT_DELETED);
        if (!empty($keyWord)) {
            $this->db->where('(owner_name LIKE "%' . $keyWord . '%" OR email LIKE "%' . $keyWord . '%" OR mobile LIKE "%' . $keyWord . '%")');
        }
        if ($status != '') {
            $this->db->where('status', $status);
        }
        return $this->db->get()->row()->total;
    }

}
