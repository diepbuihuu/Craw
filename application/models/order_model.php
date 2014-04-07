<?php

class Order_model extends CI_Model {

    public $message;

    function __construct()
    {
        $this->message = "";
        // Call the Model constructor
        parent::__construct();
    }

    function insert($data)
    {
        $this->db->insert('orders', $data);
    }
    
    function getByUser($userId) {
        $this->db->where('user_id', $userId);
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get('orders', 50);
        return $query->result();
    }

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
