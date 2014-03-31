<?php

class Taobao extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }

    
    function index() {
        $url = $this->input->cookie("original_url");
        if ($url === FALSE || $url === "") {
            $url = "http://sea.taobao.com";
        }
        
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
//        curl_setopt($ch, CURLOPT_URL, "http://www.1order.vn/frontpage/parserTB.action?method=cktb?d=1396250005116"); 
        

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);     
        $injectObject = '<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/jquery.cookie.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/link_process.js"></script>';
        $injectObject .= '<form id="link_form" action="/" style="display:none;"></form>';
//        $output = str_replace('</body>', $injectObject.'</body>', $output);
        $output = $output . $injectObject;
        echo $output;
    }
    
    function checkLogin() {
        $username = $this->input->cookie("username");
        if ($username !== FALSE && $username !== "") {
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