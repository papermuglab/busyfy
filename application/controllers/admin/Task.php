<?php

class Task extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'dml', 'pagination'));
        $this->load->helper(array('check_admin_session', 'get_designed_message', 'static_data', 'encrypt_uri', 'get_random_string', 'get_task_data'));
        $this->load->model('admin/task_model', 'model');
        isLoggedIn();
    }

    public function index() {
        $this->load->config('pagination');
        $config = $this->config->item('pagination');
        $selectedVendor = $this->uri->segment(4) != '' ? urldecode($this->uri->segment(4)) : '';
        $keyWord = (empty($this->uri->segment(5))) ? 0 : urldecode($this->uri->segment(5));
        $status = $this->uri->segment(6) != '' ? urldecode($this->uri->segment(6)) : '';
        $offset = (empty($this->uri->segment(7))) ? 0 : $this->uri->segment(7);
        $config["uri_segment"] = 7;
        $config["base_url"] = base_url('admin/task/index/' . urlencode($selectedVendor) . '/' . urlencode($keyWord) . '/' . urlencode($status));
        $config["total_rows"] = $this->model->getListCount($selectedVendor, $keyWord, $status);
        $this->pagination->initialize($config);
        $data['selectedVendor'] = $selectedVendor;
        $data['tasks'] = $this->model->getList($offset, $selectedVendor, $keyWord, $status);
        $data['keyWord'] = $keyWord;
        $data['status'] = $status;
        $data['offset'] = $offset;
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('task/list', $data, true);
    }

    public function add() {
        if (!empty($this->input->post('vendor_id'))) {
            $vendorID = $this->input->post('vendor_id');
            $data['products'] = $this->model->getProducts($vendorID);
            $data['staffs'] = $this->model->getStaff($vendorID);
        }
        $data['vendorList'] = $this->model->getVendorList();
        $this->displayAdmin('task/add', $data, true);
    }

    public function edit($taskEncryptID) {
        $taskID = dycrypt($taskEncryptID);
        $data['task'] = $this->model->getDetails($taskID);
        if ($data['task']) {
            $data['products'] = $this->model->getProducts($data['task']['vendor_id']);
            $data['staffs'] = $this->model->getStaff($data['task']['vendor_id']);
            $data['patron'] = $this->dml->getRow(TBL_PATRONS, 'patron_id', $data['task']['patron_id']);
        } else {
            $this->add();
        }
        $this->displayAdmin('task/add', $data, true);
    }

    public function save() {
        $taskID = $this->input->post('task_id');
        $patronID = $this->input->post('patron_id');
        if ($this->form_validation->run('vendor_add_task') == true) {
            $task['assigned_to'] = $this->input->post('assigned_to');
            $task['pickup_datetime'] = $this->input->post('pickup_datetime');
            $task['pickup_location'] = $this->input->post('pickup_location');
            $task['drop_location'] = $this->input->post('drop_location');
            $task['quantity'] = $this->input->post('quantity');
            $task['single_cost'] = $this->input->post('single_cost');
            $task['total_cost'] = ($task['quantity'] * $task['single_cost']);
            $task['is_paid'] = $this->input->post('is_paid');
            $task['payment_mode'] = $this->input->post('payment_mode');
            $task['status'] = $this->input->post('status');
            $patron['name'] = $this->input->post('name');
            $patron['email'] = $this->input->post('email');
            $patron['mobile'] = $this->input->post('mobile');
            if (!empty($taskID)) { // Update
                $this->dml->update(TBL_STAFF_TASKS, 'task_id', $taskID, $task);
                $this->dml->update(TBL_PATRONS, 'patron_id', $patronID, $patron);
                $message = getDesignedMessage('Task updated successfully.');
            } else { // Insert
                $patron['vendor_id'] = $this->input->post('vendor_id');
                $result = $this->dml->insert(TBL_PATRONS, $patron);

                $task['vendor_id'] = $this->input->post('vendor_id');
                $task['product_id'] = $this->input->post('product_id');
                $task['patron_id'] = $result['id'];
                $this->dml->insert(TBL_STAFF_TASKS, $task);

                $message = getDesignedMessage('Task assigned successfully.');
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('admin/task/'));
        } else {
            if (!empty($taskID)) {
                $this->edit(encrypt($taskID));
            } else {
                $this->add();
            }
        }
    }

    public function getData() {
        $vendorID = $this->input->get('vendorID');
        $params['products'] = $this->model->getProducts($vendorID);
        $params['staff'] = $this->model->getStaff($vendorID);
        echo json_encode($params);
    }

}
