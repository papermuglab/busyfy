<?php

class Oauth_model extends CI_Model {

    public function verify($para) {
        $this->db->select('vendor_id, owner_name AS name, email, status');
        $this->db->from(TBL_VENDORS);
        $this->db->where('email', $para['email']);
        $this->db->where('password', $para['password']);
        $this->db->where('status != ', 3);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

}

?>