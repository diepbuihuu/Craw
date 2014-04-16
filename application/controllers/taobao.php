<?php

require_once 'nhabuon.php';

class Taobao extends Nhabuon {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }
    
    function test() {
        $url = 'http%3A%2F%2Fs.click.taobao.com%2Ft%3Fe%3Dm%253d2%2526s%253dIufdCzvGLaMcQipKwQzePOeEDrYVVa64Vb0yt%252f5tJWWhJZGGaVTGpsTpW5dmmxAk%252bY2AJQZCxCG6lMQ5ZLUJIfNG8zj6Hs%252fVW2se0duwIQXaMb6m%252bNPodav9Onyq%252b84Qrw3SO5ty15KTQEosONmZcymDWz48%252budVi5nCqDv2dZwHXO%252be%252fYcm%252fA%253d%253d%26ref%3D%26et%3DcR6z5c5NeLIam7kxQ1w0Ep4FOUK%252BCtO1';
        echo urldecode($url);
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
            $url = "http://sea.taobao.com";
        } else {
            $url = trim(urldecode($url));
            $url = $this->removeRedirect($url);
//            $url = 'http://s.click.taobao.com/t?e=m%3d2%26s%3dIufdCzvGLaMcQipKwQzePOeEDrYVVa64Vb0yt%2f5tJWWhJZGGaVTGpsTpW5dmmxAk%2bY2AJQZCxCG6lMQ5ZLUJIfNG8zj6Hs%2fVW2se0duwIQXaMb6m%2bNPodav9Onyq%2b84Qrw3SO5ty15KTQEosONmZcymDWz48%2budVi5nCqDv2dZwHXO%2be%2fYcm%2fA%3d%3d&ref=&et=cR6z5c5NeLIam7kxQ1w0Ep4FOUK%2BCtO1';
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
            //cookie
            $cna = 'CtHDC7DH1hgCAXG+8JKV3/He';
            curl_setopt($ch, CURLOPT_COOKIE, "cna=$cna"); 

            // $output contains the output string 
            $output = curl_exec($ch); 
            
            if ($output === '') {
                $output = curl_exec_follow($ch); 
            }

            // close curl resource to free up system resources 
            curl_close($ch);     
            $injectObject = '<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>';
            $injectObject .= '<script type="text/javascript" src="/js/jquery.cookie.js"></script>';
            $injectObject .= '<script type="text/javascript" src="/js/link_process.js"></script>';
            $injectObject .= '<input type="hidden" id="product_url" value="' . $url . '">';
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