<?php

require_once 'nhabuon.php';

class Alibaba extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }
    
    
    function removeRedirect($url) {
        if (substr($url, 0, 7) === '/search') {
            $url = 'http://search8.taobao.com' . $url;
        }
        $url = str_replace(' ', '+', $url);
        return $url;
    }
    
    
    function sendRequestAlibaba($url) {
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
//        $injectObject .= '<script type="text/javascript" src="/js/jquery.cookie.js"></script>';
        $injectObject .= '<script type="text/javascript" src="/js/link_process_alibaba.js"></script>';
        $injectObject .= '<input type="hidden" id="product_url" value="' . $url . '">';
        $injectObject .= '<link href="/css/add_alibaba.css" rel="stylesheet">';
//        $output = str_replace('</body>', $injectObject.'</body>', $output);
        $output = $output . $injectObject;
        echo $output;
    }
   
    function index() {
        $url = $this->input->get('url');
        
        if ($url === FALSE || $url === "") {
            $url = "http://www.1688.com/";
        } else {
            $url = trim(urldecode($url));
            $url = $this->removeRedirect($url);
        }
        
        if (startsWith($url, '//')) {
            $url = "http:" . $url;
        }
        
        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        
        if (strpos($url, 'tmall') !== FALSE && strpos($url, 'taobao') === FALSE) {
            redirect('/tmall');
        } else {
            $this->sendRequestAlibaba($url);   
        }
        
    }
    
}

?>