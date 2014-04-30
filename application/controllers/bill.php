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
        $status = $this->input->get('status');

        $user_id = $this->session->userdata('user_id');
        $bills = $this->bill_model->getByUser($user_id, $status);
        $data = array ('bills' => $bills);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('element/header',$data);
        $this->load->view('bill/list',$data);
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
    
    function edit($billId = null){
        if (empty($billId)) {
            die('Invalid request');
        }
        $userId = $this->session->userdata('user_id');
        $bill = $this->bill_model->getById($billId, $userId);
        if (empty($bill)) {
            die('You are not allow to see this bill');
        }
        $orderIds = $bill->order_item;
        $user = $this->user_model->get($userId);
        $orders = $this->order_model->getByUser($userId, $orderIds);
        $provinces = $this->user_model->getProvinces();
        $districts = $this->user_model->getDistricts($user->province_id);
        $towns = $this->user_model->getTowns($user->district_id);
        $data = compact('user', 'provinces', 'districts', 'towns', 'orders', 'bill');

        if ($bill->status === '1') {
            $this->load->view('bill/view_sented', $data);
        } else if ($bill->status === '2') {
            $this->load->view('bill/confirm',$data);
        } else {
            $this->load->view('bill/view_confirmed',$data);
        }
    }
    
    function edit_action() {
        try {
            $userId = $this->session->userdata('user_id');
            $update_type = $this->input->post("update_type");
            
            if ($update_type === 'resent') {
                $deleteOrder = json_decode($this->input->post("delete_order"));
                $updateOrder =  json_decode($this->input->post("update_order"),true);

                $add = $this->order_model->addOrderToBill($updateOrder);
                if (!$add) {
                    echo '{"status":"0","message":"' . $this->order_model->message . '"}';
                    return;
                }
                if (!empty($deleteOrder)){
                    $this->order_model->delete($userId, $deleteOrder);
                }

                $billId = $this->input->post("bill_id");
                $data = array(
                    'order_item' => implode(',', $updateOrder['ids']),
                    'created' => time() + 7 * 3600,
                    'status' => 1
                ); 
                $this->bill_model->update($billId, $data);
                echo '{"status":"1","message":"Complete successfully"}';
            } else if ($update_type === 'confirm') {
                $billId = $this->input->post("bill_id");
                $data = array(
                    'created' => time() + 7 * 3600,
                    'status' => 3
                ); 
                $this->bill_model->update($billId, $data);
                echo '{"status":"1","message":"Complete successfully"}';
            } else {
                echo '{"status":"1","message":"Complete successfully"}';
            }
            

        } catch (Exception $ex) {
            echo '{"status":"0","message":"' . $ex->getMessage() . '"}';
            
        }
    }
    
    function create_action() {
        try {
            $userId = $this->session->userdata('user_id');
            $deleteOrder = json_decode($this->input->post("delete_order"));
            $updateOrder =  json_decode($this->input->post("update_order"),true);
            
            $add = $this->order_model->addOrderToBill($updateOrder);
            if (!$add) {
                echo '{"status":"0","message":"' . $this->order_model->message . '"}';
                return;
            }
            if (!empty($deleteOrder)){
                $this->order_model->delete($userId, $deleteOrder);
            }
            
            $date = date('m.d.Y', time() + 7 * 3600);
            $numberInDay = $this->bill_model->getNumberInDay($userId, $date);

            $data = array(
                'user_id' => $userId,
                'date' => $date,
                'number_in_day' => $numberInDay,
                'code' => $this->bill_model->getCode($userId, $date, $numberInDay),
                'order_item' => implode(',', $updateOrder['ids']),
                'created' => time() + 7 * 3600
            ); 
            $this->bill_model->insert($data);
            echo '{"status":"1","message":"Complete successfully"}';
        } catch (Exception $ex) {
            echo '{"status":"0","message":"' . $ex->getMessage() . '"}';
            
        }
        
    }
    
}

?>