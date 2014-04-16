<?php

require_once 'nhabuon.php';


class Tmall extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
    }
     
      
    function index() {
        
        $url = $this->input->get('url');    
        if ($url === FALSE || $url === "") {
            $url = "http://www.tmall.com/";
        } else {
            $url = trim(urldecode($url));
        }
        
        if (startsWith($url, '//')) {
            $url = "http:" . $url;
        }
        
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }

        if (strpos($url, 'taobao') !== FALSE && strpos($url, 'tmall') === FALSE) {
            redirect('/taobao');
        }
        
        $this->sendRequestTmall($url);
    }
    
    function sendRequestTmall($url) {
        // create curl resource 
        $ch = curl_init(); 

        // set url 
//        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        
        $output = curl_exec_follow($ch);
        // $output contains the output string 
//        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);     
        $injectObject = '<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/jquery.cookie.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/link_process_tmall.js"></script>';
        $injectObject .= '<input type="hidden" id="product_url" value="' . $url . '">';
        $injectObject .= '<link href="/css/add_tmall.css" rel="stylesheet">';
//        $output = str_replace('</body>', $injectObject.'</body>', $output);
        $output = $output . $injectObject;
        setcookie('product_url', $url, time() + 3600, '/index.php');
        setcookie('original_url', "", time() + 3600, '/index.php');
        echo $output;
    }
    
    function search() {
        
        $requestURL = $_SERVER['REQUEST_URI'];
        $url = str_replace('/index.php/tmall/search', 'http://list.tmall.com/search_product.htm', $requestURL);
        
        $this->sendRequestTmall($url);
    }
    

}

?>