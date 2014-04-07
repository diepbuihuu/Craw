<?php

class User extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
        $this->load->model('user_model');
    }
    
    function get() {
        $this->user_model->get();
    }

    function insert() {
        $username = "nhabuon";
        $password = md5("nhabuon");
        $email = "diepbuihuu@gmail.com";
        $phone = "01666463771";
        $address = "HaNoi VietName";
        
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        );
        $this->user_model->insert($data);
        echo "success";
    }
    
    function index() {
        echo "index";
    }

}

?>