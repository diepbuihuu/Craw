<?php

require_once 'nhabuon.php';

class UserDashboard extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
        $this->load->model('order_model');
    }
    
    function index() {
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        $redirect_url = $this->session->userdata('redirect_url');
        if (!empty($redirect_url)) {
            $this->session->unset_userdata(array('redirect_url' => ''));
            redirect($redirect_url);
        }
        
        $user_id = $this->session->userdata('user_id');
        $this->load->view('dashboard/user');
    }
    
}

?>