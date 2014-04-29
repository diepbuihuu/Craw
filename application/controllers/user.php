<?php

class User extends CI_Controller {
    /**
     *
     * @var User_model 
     */
    //private $user_model;
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
        $this->load->library('session');
        $this->load->model('user_model');
    }
    
    function get() {
        $this->user_model->get();
    }
    
    function edit() {
        echo '1234';
    }
    
    function register() {
        $provinces = $this->user_model->getProvinces();
        $data = array('provinces' => $provinces);
        $this->load->view('user/register',$data);
    }
    
    function update_action() {
        {
        $data = array(
            'username' => $this->input->post("username"),
            'email' => $this->input->post("email"),
            'phone' => $this->input->post("phone"),
            'account' => $this->input->post("account"),
            'province_id' => $this->input->post("province"),
            'district_id' => $this->input->post("district"),
            'town_id' => $this->input->post("town"),
            'address' => $this->input->post("address")
        );
        $userId = $this->session->userdata('user_id');
        if ($this->user_model->validateRegisterInfo($data, $userId)) {
            $this->user_model->update($data, $userId);
            $response = array (
                "status" => 1,
                "message" => "Complete successfully"
            );
        } else {
            $message = $this->user_model->message;
            $response = array (
                "status" => 0,
                "message" => $message
            );
        }
        echo json_encode($response);
    }
    }
            
    function register_action() {
        $data = array(
            'username' => $this->input->post("username"),
            'password' => md5($this->input->post("password")),
            'email' => $this->input->post("email"),
            'phone' => $this->input->post("phone"),
            'account' => $this->input->post("account"),
            'province_id' => $this->input->post("province"),
            'district_id' => $this->input->post("district"),
            'town_id' => $this->input->post("town"),
            'address' => $this->input->post("address")
        );
        if ($this->user_model->validateRegisterInfo($data)) {
            $data['role_id'] = 4;
            $this->user_model->insert($data);
            $response = array (
                "status" => 1,
                "message" => "Complete successfully"
            );
        } else {
            $message = $this->user_model->message;
            $response = array (
                "status" => 0,
                "message" => $message
            );
        }
        echo json_encode($response);
    }

    function insert() {
        $username = "nhabuon";
        $password = md5("nhabuon");
        $email = "diepbuihuu@gmail.com";
        $phone = "01666463771";
        $address = "HaNoi VietName";
        
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        );
        $this->user_model->insert($data);
        echo "success";
    }
    
    function index() {
        echo "index";
    }
    
    function getDistrict($provinceId) {
        echo json_encode($this->user_model->getDistricts($provinceId));
    }
    
    function getTown($districtId) {
        echo json_encode($this->user_model->getTowns($districtId));
    }

}

?>