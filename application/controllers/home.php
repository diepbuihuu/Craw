<?php

require_once 'nhabuon.php';

class Home extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url','cookie');
    }
    
    function index() {
        $redirect_url= $this->session->userdata('redirect_url');
        if (!empty($redirect_url)) {
            $this->session->unset_userdata(array('redirect_url' => ''));
            redirect($redirect_url);
        }
        $data = array();
        if ($this->session->userdata('login')) {
            $data['user_id'] = $this->session->userdata('user_id');
            $data['username'] = $this->session->userdata('username');
        }
        $this->load->view('element/header', $data);
        $this->load->view('home/index');
        $this->load->view('element/footer');
    }
    
}

?>