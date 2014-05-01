<?php


class Dashboard extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();   
        date_default_timezone_set("UTC"); 
        $this->load->helper('url','cookie');
        $this->load->library('session');
        if (!$this->checkAdmin()) {
            die("Access denied");
        }
    }
    
    function checkAdmin() {
        $isAdmin = $this->session->userdata('is_admin');
        if (!empty($isAdmin)) {
            return true;
        }
        return false;
    }
    
    function index() {
        $user_id = $this->session->userdata('user_id');
        $this->load->view('dashboard/admin');
    }
    
}

?>