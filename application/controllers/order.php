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
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('element/header',$data);
        $this->load->view('order/view',$data);
        $this->load->view('element/footer',$data);
    }
    
    function addToCard() {
        
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'product_link' => $this->input->post("product_url"),
            'product_name' => $this->input->post("product_name"),
            'price' => $this->input->post("price"),
            'number' => $this->input->post("number"),
            'shop_name' => $this->getDomain($this->input->post("shop_name")),
            'user_data' => rtrim($this->input->post("user_data"),', '),
            'status' => '1',
            'created' => time(),
            'modified' => time()
        );
        
        if (empty($data['shop_name'])) {
            $data['shop_name'] = "Not specified";
        }
        
        $this->order_model->insert($data);
        
        echo "Add to card success";
    }
    
    function addToCardAlibaba() {
        
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'product_link' => $this->input->post("product_url"),
            'product_name' => $this->input->post("product_name"),
            'shop_name' => $this->getDomain($this->input->post("shop_name")),
            'color_image' => $this->input->post("color_url"),
            'status' => '1',
            'created' => time(),
            'modified' => time()
        );
        
        if (empty($data['shop_name'])) {
            $data['shop_name'] = "Not specified";
        }
        
        $color = $this->input->post("user_data");
        $products = json_decode($this->input->post("products"),true);
        foreach ($products as $product) {
            $data['user_data'] = $color . ' ' . $product['name'];
            $data['price'] = $product['price'];
            $data['number'] = $product['amount'];
            $this->order_model->insert($data);
        }

        echo "Add to card success";
    }
    
    function getDomain($url) {
        $result = str_replace('http://', '', $url);
        $paths = explode('.', $result);
        return $paths[0];
    }
}

?>