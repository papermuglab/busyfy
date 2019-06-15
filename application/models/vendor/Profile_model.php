<?php

class Profile_model extends CI_Model {

    public function isUniqueGSTNo($value, $vendorId) {
        $this->db->select('COUNT(vendor_id) AS count');
        $this->db->from(TBL_VENDORS);
        $this->db->where('vendor_id !=', $vendorId);
        $this->db->where('gst_no', $value);
        $this->db->where('is_deleted', 0);
        return $this->db->get()->row()->count > 0 ? false : true;
    }

    public function isUniquePANNo($value, $vendorId) {
        $this->db->select('COUNT(vendor_id) AS count');
        $this->db->from(TBL_VENDORS);
        $this->db->where('vendor_id !=', $vendorId);
        $this->db->where('pan_no', $value);
        $this->db->where('is_deleted', 0);
        return $this->db->get()->row()->count > 0 ? false : true;
    }

    public function isOldPasswordCorrect($oldPassword, $myID) {
        $this->db->select('vendor_id');
        $this->db->from(TBL_VENDORS);
        $this->db->where('vendor_id', $myID);
        $this->db->where('password', $oldPassword);
        $this->db->limit(1);
        $que = $this->db->get();
        return ($que->num_rows() > 0) ? TRUE : FALSE;
    }

    public function isAvailable($table, $vendorID) {
        $this->db->select('vendor_id');
        $this->db->from($table);
        $this->db->where('vendor_id', $vendorID);
        $this->db->limit(1);
        $row = $this->db->get()->row();
        return !empty($row) ? true : false;
    }

}
