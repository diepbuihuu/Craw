<?php

class User_model extends CI_Model {

    public $message;

    function __construct()
    {
        $this->message = "";
        // Call the Model constructor
        parent::__construct();
    }

    function insert($data)
    {
        $this->db->insert('users', $data);
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
