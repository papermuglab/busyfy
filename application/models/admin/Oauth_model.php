<?php

class Oauth_model extends CI_Model {

    public function verify($para) {
        $this->db->select('admin_id, name, email');
        $this->db->from(TBL_ADMINS);
        $this->db->where('email', $para['email']);
        $this->db->where('password', $para['password']);
        $this->db->where('status', 1);
        $this->db->where('is_deleted', 0);
        $this->db->limit(1);
        $que = $this->db->get();
        return $que->row_array();
    }

}

?>