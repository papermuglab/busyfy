<?php

class Dashboard_model extends CI_Model {

    public function getCounts() {
        $data['total_vendors'] = $this->getTotalVendors();
        $data['total_staff'] = $this->getTotalStaff();
        $data['total_task'] = $this->getTotalTask();
        $data['total_pending_task'] = $this->getTotalPendingTask();
        return $data;
    }

    public function getTotalVendors() {
        $this->db->select('COUNT(vendor_id) AS total');
        $this->db->from(TBL_VENDORS);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->where('status !=', '3');
        return $this->db->get()->row()->total;
    }

    public function getTotalStaff() {
        $this->db->select('COUNT(staff_id) AS total');
        $this->db->from(TBL_STAFF);
        $this->db->where('is_deleted', NOT_DELETED);
        return $this->db->get()->row()->total;
    }

    public function getTotalTask() {
        $this->db->select('COUNT(task_id) AS total');
        $this->db->from(TBL_STAFF_TASKS);
        $this->db->where('is_deleted', NOT_DELETED);
        return $this->db->get()->row()->total;
    }

    public function getTotalPendingTask() {
        $this->db->select('COUNT(task_id) AS total');
        $this->db->from(TBL_STAFF_TASKS);
        $this->db->where('is_deleted', NOT_DELETED);
        $this->db->where('status', 0);
        return $this->db->get()->row()->total;
    }

}
