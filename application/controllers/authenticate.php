<?php

class Authenticate extends CI_Controller {
    
    /**
     *
     * @var User_model 
     */
    public $user_model;

    public function __construct() {  
        unset($this->user_model);
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
            if ($this->session->userdata('is_admin') == '1') {
                $response['is_admin'] = '1';
            }
        } else {
            $message = $this->user_model->message;
            $response = array (
                "status" => 0,
                "message" => $message
            );
        }
        
        echo json_encode($response);
    }
    
    function logout() {
        $this->session->sess_destroy();
        redirect('/home');
    }
    

}

?>