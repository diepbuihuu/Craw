<?php

require_once 'nhabuon.php';

class Account extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url','cookie');
		$this->load->model('user_model');
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
	}
	
	function register() {
		if(isLogin())
			redirect('/home');
		
		$this->stencil->layout('layout_main');
		$this->stencil->title('Đăng ký');	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		
		$provinces = $this->user_model->getProvinces();
        $data = array('provinces' => $provinces);
		$submitted = $this->input->post('submitted');
		if ($submitted) {
			//$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[10]');
			//$this->form_validation->set_rules('email', 'Email', 'trim', 'Khong duoc co khoang trang');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_message('required', '%s không được để trống');
			if ($this->form_validation->run() == FALSE)
			{
				$error = validation_errors();
				var_dump($error);
			}
			else
			{
				$abc = 2;
				var_dump($abc);
			}
		}
		
        $this->stencil->paint('account/register', $data);
	}
	
	function logout() {
		$this->session->sess_destroy();
		redirect('/home');
	}
	
	/* 
	 * Private function Below
	 */
}

?>