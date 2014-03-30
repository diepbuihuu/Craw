<?php

class Taobao extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }

    
    function index() {
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://item.taobao.com/item.htm?spm=2013.1.0.0.LECn7C&scm=1007.10009.518.0&id=26754524142&pvid=5a899401-5357-4b2a-8f05-9f4641820784"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);    
        echo $output;
    }
    
    function checkLogin() {
        if (!empty($this->input->cookie("username"))) {
            return true;
        }
        return false;
    }
    
    function checkUser() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        setcookie("username", $username);
        $response = array (
            "status" => 1,
            "message" => "Complete successfully"
        );
        echo json_encode($response);
    }

}

?>