<?php

class Oauth_model extends CI_Model {

    public function verify($para) {
        $this->db->select('admin_id, name, email, role_id');
        $this->db->from(TBL_ADMINS);
        $this->db->where('email', $para['email']);
        $this->db->where('password', $para['password']);
        $this->db->where('is_deleted', INACTIVE);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

}

?>