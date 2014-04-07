<?php

class Nhabuon extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
        $this->load->library('session');
    }
    
    function checkLogin() {
        if ($this->session->userdata('login')) {
            return true;
        } else {
            return false;
        }
    }

}

?>