<?php

require_once 'nhabuon.php';

class Tmall extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
    }
      
    function index() {
        $url = $this->input->cookie("original_url");
        if ($url === FALSE || $url === "") {
            $url = "http://www.tmall.com/";
        }
        
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        
        if (strpos($url, 'taobao') !== FALSE && strpos($url, 'tmall') === FALSE) {
            redirect('/taobao');
        }
        
        // create curl resource 
        $ch = curl_init(); 

        // set url 
//        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);     
        $injectObject = '<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/jquery.cookie.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/link_process_tmall.js"></script>';
        $injectObject .= '<form id="link_form" action="/" style="display:none;"></form>';
//        $output = str_replace('</body>', $injectObject.'</body>', $output);
        $output = $output . $injectObject;
        setcookie('product_url', $url, time() + 3600, '/');
        setcookie('original_url', "", time() + 3600, '/');
        echo $output;
    }
    

}

?>