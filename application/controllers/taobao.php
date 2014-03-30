<?php

class Taobao extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }

    
    function index() {
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        echo "12345";
    }
    
    function checkLogin() {
        if (!empty($this->input->cookie("username"))) {
            return true;
        }
        return false;
    }
    
    function checkUser() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        setcookie("username", $username);
        $response = array (
            "status" => 1,
            "message" => "Complete successfully"
        );
        echo json_encode($response);
    }

}

?>