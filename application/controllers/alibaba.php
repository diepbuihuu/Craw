<?php

require_once 'nhabuon.php';

class Alibaba extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }
    
    
    function removeRedirect($url) {
        if (strpos($url, 'redirect.simba.taobao.com') !== false) {
            $queries = explode('&', $url);
            foreach ($queries as $query) {
                if (substr($query, 0, 2) === 'f=') {
                    $url = substr($query, 2);
                    break;
                }
            }
        }
        if (substr($url, 0, 7) === '/search') {
            $url = 'http://search8.taobao.com' . $url;
        }
        $url = str_replace(' ', '+', $url);
        return $url;
    }
   
    function index() {
        $url = $this->input->get('url');
        
//        var_dump($_COOKIE); die;
        
        
        if ($url === FALSE || $url === "") {
            $url = "http://www.1688.com/";
        } else {
//            $url = trim(urldecode($url));
//            $url = $this->removeRedirect($url);
//            $url = 'http://s.click.taobao.com/t?e=m%3d2%26s%3dIufdCzvGLaMcQipKwQzePOeEDrYVVa64Vb0yt%2f5tJWWhJZGGaVTGpsTpW5dmmxAk%2bY2AJQZCxCG6lMQ5ZLUJIfNG8zj6Hs%2fVW2se0duwIQXaMb6m%2bNPodav9Onyq%2b84Qrw3SO5ty15KTQEosONmZcymDWz48%2budVi5nCqDv2dZwHXO%2be%2fYcm%2fA%3d%3d&ref=&et=cR6z5c5NeLIam7kxQ1w0Ep4FOUK%2BCtO1';
        }
//        var_dump($url); die;

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
//            curl_setopt($ch, CURLOPT_HEADER, true);
            //cookie
            $cna = 'AAAAAFDxYAsCAbKoqHH+hOlO';
//            curl_setopt($ch, CURLOPT_COOKIE, "ali_beacon_id=113.168.168.178.1397288022962.719319.0; ali_cookie_uuid=6a8a89bb-4e2c-42d6-b703-480d428f6618781; cna=AAAAAFDxYAsCAbKoqHH+hOlO; JSESSIONID=ELBG1g1-rJUR5QRYtCAYFHoxt5-wNodtbO-4A8A; alicnweb=touch_tb_at%3D1397924758711; ali_ab=1.55.147.167.1397883437856.8; _csrf_token=1397925270122; _tmp_ck_0=\"pgW8OZwgGvg%2FDIoFQVXmLOyNi5LaJe5LieLFBzCb7N23LfPRoBvo3P3fKIH5UEM7BmZfjolRgRIIMHsEwsk65yqc96D2HbCq9KmiQc5xjMBPhHiskGcQeK3%2B574hv9yOFE8E3NVJBlO%2FTzD3BuuXvqIyLZRz6Q5n1m8NVdVH9n3GZVxcbZf1ihT6PAaql99DCUONAv63hYipk2nFWBZ9t6RN7b06%2FMquvo2Fhvzu6U7rMSVbBPrrPnV4fMq%2FxrEKceALJlg78hhICxlA7Edibd%2FQcY9yiadowXnfp6fB7EXn%2FPZVPighm4UGoPYo49DA77LRQD41ZmuJ%2Fp1NDaeEGA%3D%3D\"; aliBeacon_bcookie=ali_resin_trace=c_signed=0; _ITBU_IS_FIRST_VISITED_=ariel001%3Apm09ap9th2"); 

            // $output contains the output string 
            $output = curl_exec_follow($ch); 

            // close curl resource to free up system resources 
            curl_close($ch);     
            $injectObject = '<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>';
            $injectObject .= '<script type="text/javascript" src="/js/jquery.cookie.js"></script>';
            $injectObject .= '<script type="text/javascript" src="/js/link_process_alibaba.js"></script>';
            $injectObject .= '<input type="hidden" id="product_url" value="' . $url . '">';
            $injectObject .= '<link href="/css/add_alibaba.css" rel="stylesheet">';
    //        $output = str_replace('</body>', $injectObject.'</body>', $output);
//            $output = str_replace('index-min.js', 'aaa.js', $output);
            $output = $output . $injectObject;
            setcookie('product_url', $url, time() + 3600, '/index.php');
            setcookie('original_url', "", time() + 3600, '/index.php');
            echo $output;
        }
        
    }
    

}

?>