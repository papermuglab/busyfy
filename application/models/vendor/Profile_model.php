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

    public function isVendorAvailableInBank($vendorId) {
        $this->db->select('vendor_id');
        $this->db->from(TBL_VENDOR_BANKS);
        $this->db->where('vendor_id', $vendorId);
        $this->db->limit(1);
        return !empty($this->db->get()->row()) ? true : false;
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

}
