<?php

require_once 'dashboard.php';

class Bill extends Dashboard {
    
    /**
     *
     * @var Bill_model; 
     */
    public $bill_model;


    public function __construct() {  
        unset ($this->bill_model);
        parent::__construct();
        
        $this->load->model('order_model');  
        $this->load->model('user_model');  
        $this->load->model('bill_model');  
    }
    
    function index() {
        $status = $this->input->get('status');
        $bills = $this->bill_model->getAll($status);
        $data = array ('bills' => $bills);
        $this->load->view('admin/element/header');
        $this->load->view('admin/bill/list',$data);
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
    
    function edit($userId, $billId = null){
        if (empty($billId)) {
            die('Invalid request');
        }
        
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

            $this->load->view('admin/bill/view', $data);
    }
    
    function edit_action() {
        try {
                $userId = $this->input->post('user_id');
                $billId= $this->input->post("bill_id");
            
                $updateOrder =  json_decode($this->input->post("update_order"),true);

                $update = $this->order_model->adminUpdateBillOrder($updateOrder);
                if (!$update) {
                    echo '{"status":"0","message":"' . $this->order_model->message . '"}';
                    return;
                }

                $data = array(
                    'fee' => $this->input->post("order_fee"),
                    'created' => time() + 7 * 3600,
                    'status' => 2
                ); 
                $this->bill_model->update($billId, $data);
                echo '{"status":"1","message":"Complete successfully"}';

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