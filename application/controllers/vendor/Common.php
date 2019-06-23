<?php

class Common extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('check_vendor_session', 'get_designed_message'));
        isLoggedIn();
    }

    public function delete() {
        $table = $field = '';
        $this->load->library('dml');
        $params['is_deleted'] = 1;
        $type = $this->input->get('type');
        $recordID = $this->input->get('recordID');
        switch ($type) {
            case 'product':
                $table = TBL_PRODUCTS;
                $field = 'product_id';
                break;
            case 'staff':
                $table = TBL_STAFF;
                $field = 'staff_id';
                break;
            case 'task':
                $table = TBL_STAFF_TASKS;
                $field = 'task_id';
                break;
            case 'lead':
                $table = TBL_LEADS;
                $field = 'lead_id';
                break;
            default:
                break;
        }
        $result = $this->dml->update($table, $field, $recordID, $params);
        if ($result['status']) {
            echo getDesignedMessage('Record deleted successfully.');
        } else {
            echo getDesignedMessage('Something wrong happened, Please try again.', 2);
        }
    }

}
