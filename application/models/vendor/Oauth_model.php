<?php

class Oauth_model extends CI_Model {

    public function verify($para) {
        $this->db->select('vendor_id, name, email');
        $this->db->from(TBL_VENDORS);
        $this->db->where('email', $para['email']);
        $this->db->where('password', $para['password']);
        $this->db->limit(1);
        $que = $this->db->get();
        return $que->row_array();
    }

}

?>