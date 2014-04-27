<?php

require_once 'nhabuon.php';

class Bill extends Nhabuon {
    
    /**
     *
     * @var User_model; 
     */
//    private $user_model;


    public function __construct() {  
        parent::__construct();
        
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        $this->load->model('order_model');  
        $this->load->model('user_model');  
        $this->load->model('bill_model');  
    }
    
    function index() {
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        $user_id = $this->session->userdata('user_id');
        $orders = $this->order_model->getByUser($user_id);
        $data = array ('orders' => $orders);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('element/header',$data);
        $this->load->view('order/view',$data);
        $this->load->view('element/footer',$data);
    }
    
    function create() {
        $userId = $this->session->userdata('user_id');
        $user = $this->user_model->get($userId);
        $provinces = $this->user_model->getProvinces();
        $districts = $this->user_model->getDistricts($user->province_id);
        $towns = $this->user_model->getTowns($user->district_id);
        $orders = $this->order_model->getByUser($userId);
//        var_dump($provinces); die;
        $data = compact('user', 'provinces', 'districts', 'towns', 'orders');
        $this->load->view('bill/create',$data);
    }
    
    
}

?>