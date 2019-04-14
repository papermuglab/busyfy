<?php

class Profile_model extends CI_Model {

    public function isOldPasswordCorrect($oldPassword, $myID) {
        $this->db->select('admin_id');
        $this->db->from(TBL_ADMINS);
        $this->db->where('admin_id', $myID);
        $this->db->where('password', $oldPassword);
        $this->db->limit(1);
        $que = $this->db->get();
        return ($que->num_rows() > 0) ? TRUE : FALSE;
    }

}
