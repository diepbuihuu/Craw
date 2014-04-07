<?php

class Authenticate extends CI_Controller {
    
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
        $this->load->library('session');
        $this->load->model('user_model');
    }

    
    function index() {
        $data['title'] = "hello";
        $this->load->view('login/login_form.php', $data);
        
    }
    
    function checkLogin() {
        if ($this->session->userdata('login')) {
            return true;
        } else {
            return false;
        }
    }
    
    function checkUser() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if ($this->user_model->checkLogin($username, $password)) {
            $response = array (
                "status" => 1,
                "message" => "Complete successfully"
            );
        } else {
            $message = $this->user_model->message;
            $response = array (
                "status" => 0,
                "message" => $message
            );
        }
        
        echo json_encode($response);
    }
    

}

?>