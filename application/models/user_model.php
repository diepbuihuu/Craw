<?php

class User_model extends CI_Model {

    public $message;

    function __construct()
    {
        $this->message = "";
        // Call the Model constructor
        parent::__construct();
    }
    
    function get($userId) {
        $query = $this->db->get_where('users', array('id' => $userId));
        return $query->row();
    }
    
    function getProvinces() {
        $query = $this->db->get('provinces');
        return $query->result();
    }
    
    function getDistricts($provinceId) {
        $query = $this->db->get_where('districts', array('province_id' => $provinceId));
        return $query->result();
    }
    
    function getTowns($districtId) {
        $query = $this->db->get_where('towns', array('district_id' => $districtId));
        return $query->result();
    }

    function insert($data)
    {
        $data['created'] = time();
        $this->db->insert('users', $data);
        $sessionData = array(
            'login' => 1,
            'username' => $data['username'],
            'user_id' => $this->db->insert_id()
        );
        
        $this->session->set_userdata($sessionData);
        return true;
    }
    
    function validateRegisterInfo($data, $id = null) {
        foreach ($data as $key => $field) {
            if ($field === "") {
                $this->message = $key . " is missing";
                return false;
            }
        }
        if (!$this->validateEmail($data['email']) || !$this->validateNumber($data['phone'])) {
            return FALSE;
        }
        return $this->checkDupplicate($data, $id);
    }
    
    function validateEmail($email) {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
        // Run the preg_match() function on regex against the email address
        if (preg_match($regex, $email)) {
             return true;
        } else { 
            $this->message = "Invalid email";
            return false;
        }
    }
    
    function validateNumber($number) {
        $regex = '/^[0-9]+$/'; 
        // Run the preg_match() function on regex against the email address
        if (preg_match($regex, $number)) {
             return true;
        } else { 
            $this->message = "Invalid number";
            return false;
        }
    }
    
    function update($data, $userId) {
        $this->db->where('id', $userId);
        $this->db->update('users', $data);
    }
    
    function checkDupplicate($data, $id) {
        
        $whereClause = '(username = "' . $data['username'] . '" OR email = "' 
                        . $data['email'] . '" OR phone = "' . $data['phone'] . '")';
        
        $this->db->where($whereClause);       
        if (!is_null($id)) {
            $this->db->where('id != ', $id);
        }
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            $user = $query->row();
            if ($user->username === $data['username']) {
                $this->message = "Username already existed";
            } else if ($user->email === $data['email']) {
                $this->message = "Email already existed";
            } else if ($user->phone === $data['phone']) {
                $this->message = "Phone number already existed";
            }
            return false;
        } else {
            return true;
        }
    }
    
    function checkLogin($username, $password) {
        if ($username === "" || $password === "") {
            $this->message = "Please input username and password";
            return false;
        }
        
        /**
         * @var CI_DB_result
         */
        $query = $this->db->get_where('users', array("username" => $username));
        if ($query->num_rows() === 0) {
            $this->message = "Username doesnot exist";
            return false;
        }
        
        $user = $query->row();
        if ($user->password !== md5($password)) {
            $this->message = "Wrong username or password";
            return FALSE;
        }
        
        $sessionData = array(
            'login' => 1,
            'username' => $user->username,
            'user_id' => $user->id
        );
        
        $this->session->set_userdata($sessionData);
        return true;
    }

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
