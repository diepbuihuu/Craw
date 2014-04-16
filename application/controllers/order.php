<?php

require_once 'nhabuon.php';

class Order extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
        $this->load->model('order_model');
    }
    
    function index() {
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        $user_id = $this->session->userdata('user_id');
        $orders = $this->order_model->getByUser($user_id);
        $data = array ('orders' => $orders);
        $this->load->view('order/view',$data);
    }
    
    function addToCard() {
        
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'product_link' => $this->input->post("product_url"),
            'product_name' => $this->input->post("product_name"),
            'price' => $this->input->post("price"),
            'number' => $this->input->post("number"),
            'shop_name' => $this->input->post("shop_name"),
            'user_data' => rtrim($this->input->post("user_data"),', '),
            'status' => '1',
            'created' => time(),
            'modified' => time()
        );
        
        $this->order_model->insert($data);
        
        echo "Add to card success";
    }
}

?>