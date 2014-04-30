<?php

class Bill_model extends CI_Model {

    public $message;

    function __construct()
    {
        $this->message = "";
        // Call the Model constructor
        parent::__construct();
    }

    function insert($data)
    {
        $this->db->insert('bills', $data);
    }
    
    function getCode($userId, $date, $numberInDay) {
        $numberInDay = $this->format3CharacterNumber($numberInDay);
        $userId = $this->format3CharacterNumber(intval($userId));
        $code = $date . '-' . $numberInDay . '-KH'.$userId; 
        return $code;
    }
    
    function format3CharacterNumber($number) {
        if ($number < 10) {
            return '00'.$number;
        } else if ($number < 100) {
            return '0' . $number;
        } else {
            return $number;
        }
    }
    
    function getNumberInDay($userId, $date) {
        $this->db->where('user_id', $userId);
        $this->db->where('date', $date);
        $this->db->order_by('number_in_day', 'desc');
        $this->db->limit(1);
        $queries = $this->db->get('bills');
        if ($queries->num_rows() === 0) {
            return 1;
        } else {
            $row = $queries->row();
            return intval($row->number_in_day) + 1;
        }
    }
    function getByUser($userId, $status) {
        $this->db->where('user_id', $userId);
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get('bills', 50);
        $queryData = $query->result();
        $result = array();
        foreach ($queryData as $row) {
            $row->created_text = date('d/m/Y', $row->created);
            $row->status_text = $this->formatStatus($row->status);
        }
        return $queryData;
    }
    
    function update($billId, $data) {
        $this->db->where('bill_id', $billId);
        $this->db->update('bills', $data);
    }
    
    function getById($billId, $userId) {
        $this->db->where('user_id', $userId);
        $this->db->where('bill_id', $billId);
        $query = $this->db->get('bills', 50);
        if ($query->num_rows === 0) {
            return array();
        }
        $row = $query->row();
        $row->created_text = date('d/m/Y', $row->created);
        $row->status_text = $this->formatStatus($row->status);
        return $row;
    }
    
    function formatStatus($status) {
        switch ($status) {
            case '1':
                return 'Đã gửi';
            case '2':
                return 'Admin đã check';
            case '3':
                return 'Đã chốt';
            default :
                return $status;
        }
    }

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
