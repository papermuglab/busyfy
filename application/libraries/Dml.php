<?php

/*
 * Created by: Hamza kt
 * Created on: 02-08-2017
 * Purpose: This library useful when we insert, update, delete and select data from the database.
 *          Using this library we have to pass table name and parameter and method will return status of perticular action.  
 *          For select method it will check default column : status 1 and Delete 0.
 */

class Dml {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    //This will insert para in DB and return the inserted id and it's status
    public function insert($table, $para) {
        $this->CI->db->insert($table, $para);
        $data['id'] = $this->CI->db->insert_id();
        $data['status'] = ($this->CI->db->affected_rows() > 0) ? TRUE : FALSE;
        return $data;
    }

    //This will update $filed column with given $value in specific $table and return you status of action
    public function update($table, $field, $value, $para) {
        try {
            $this->CI->db->where($field, $value);
            $this->CI->db->update($table, $para);
            $data['id'] = $value;
            $data['status'] = ($this->CI->db->affected_rows() >= 0) ? TRUE : FALSE;
        } catch (Exception $ex) {
            log_message('error', $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        }
        return $data;
    }

    //This will update is_deleted coloum with 1 and return you status of action
    public function delete($table, $field, $value) {
        $this->CI->db->where($field, $value);
        $this->CI->db->update($table, array('is_deleted' => 1));
        $data['status'] = ($this->CI->db->affected_rows() > 0) ? TRUE : FALSE;
        return $data;
    }

    //This will return you a row object of given $table, $filed and $value
    public function getRow($table, $field, $value) {
        $columns = "";
        $fields = $this->CI->db->list_fields($table);
        $columns = array_diff($fields, array('is_deleted', 'modified_on', 'password'));
        $fields = "";
        $fields = implode(',', $columns);

        $this->CI->db->select($fields);
        $this->CI->db->from($table);
        $this->CI->db->where($field, $value);
        $this->CI->db->limit(1);
        $que = $this->CI->db->get();
        return $que->row_array();
    }

    //This will return you a result object of given $table, $filed and $value
    public function get($table, $field, $value) {
        $columns = "";
        $fields = $this->CI->db->list_fields($table);
        $columns = array_diff($fields, array('is_deleted', 'modified_on', 'password'));
        $fields = "";
        $fields = implode(',', $columns);

        $this->CI->db->select($fields);
        $this->CI->db->from($table);
        $this->CI->db->where($field, $value);
        return $this->CI->db->get()->result_array();
    }

    //This will return the count of given $table, $field and $value
    public function count($table, $field, $value) {
        $this->CI->db->select('id');
        $this->CI->db->from($table);
        $this->CI->db->where($field, $value);
        $this->CI->db->where('status', ACTIVE);
        $this->CI->db->where('is_deleted', NOT_DELETED);
        $que = $this->CI->db->get();
        return $que->num_rows();
    }

    public function insertBatch($tableName, $records) {
        $this->CI->db->insert_batch($tableName, $records);
        return $this->CI->db->affected_rows();
    }

}

?>