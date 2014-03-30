<?php

class Authenticate extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }

    
    function index() {
        if ($this->checkLogin()) {
            redirect('/welcome');
        }
        $data['title'] = "hello";
        $this->load->view('login/login_form.php', $data);
        
    }
    
    function checkLogin() {
        return false;
    }
    
    function checkUser() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        setcookie("username", $username, time()+3600, "/");
        $response = array (
            "status" => 1,
            "message" => "Complete successfully"
        );
        echo json_encode($response);
    }

}

?>