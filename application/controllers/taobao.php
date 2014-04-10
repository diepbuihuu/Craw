<?php

require_once 'nhabuon.php';

class Taobao extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }
    

   
    function index() {
        $url = $this->input->get('url');
        
        if ($url === FALSE || $url === "") {
            $url = "http://sea.taobao.com";
        } else {
            $url = trim(urldecode($url));
        }

        if (!$this->checkLogin()) {
            redirect('/authenticate');
        }
        
        if (strpos($url, 'tmall') !== FALSE && strpos($url, 'taobao') === FALSE) {
            redirect('/tmall');
        } else {
            // create curl resource 
            $ch = curl_init(); 

            // set url 
            curl_setopt($ch, CURLOPT_URL, $url); 
//            curl_setopt($ch, CURLOPT_URL, 'http://item.taobao.com/item.htm?spm=a230r.1.14.37.l99Uy8&id=14748198940'); 
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
            $injectObject .= '<link href="/css/add_taobao.css" rel="stylesheet">';
    //        $output = str_replace('</body>', $injectObject.'</body>', $output);
            $output = str_replace('index-min.js', 'aaa.js', $output);
            $output = $output . $injectObject;
            setcookie('product_url', $url, time() + 3600, '/index.php');
            setcookie('original_url', "", time() + 3600, '/index.php');
            echo $output;
        }
        
    }
    

}

?>