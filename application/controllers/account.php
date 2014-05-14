<?php

require_once 'nhabuon.php';

class Account extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url','cookie');
    }
    
	function index() {
		$this->load->library('layout', 'layout_main');
		$data = array();
		$this->layout->view('/home/home', $data);
	}
	
	function login() {
		$this->stencil->layout('layout_main');
		$this->stencil->title('Đăng nhập');	
		$this->load->helper('form');
		$this->load->model('user_model');
		$data = array();
		$submitted 		= $this->input->post('submitted');
		if ($submitted)
		{
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			if ($this->user_model->checkLogin($email, $password)) {
				
				if ($this->session->userdata('is_admin') == '1') {
					redirect('admin/dashboard');
				}
				redirect('home');
			} else {
				$this->session->set_flashdata('error', $this->user_model->message);
				redirect('account/login');
			}
		}
		$this->stencil->paint('account/login', $data);
		//$this->layout->view('account/login', $data);
	}
	
	function logout() {
		$this->session->sess_destroy();
		redirect('/home');
	}
}

?>