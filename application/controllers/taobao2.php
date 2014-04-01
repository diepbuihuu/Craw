<?php

class Taobao2 extends CI_Controller {
    
    public function __construct() {  
        parent::__construct();
        $this->load->helper('url','cookie');
    }
    
    function addToCard() {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $filename = $documentRoot . '/upload/buyItem.txt';
        $fileContent = "Username: ". $this->input->cookie("username") . PHP_EOL;
        $fileContent .= "Product url: ". $this->input->post("product_url") . PHP_EOL;
        $fileContent .= "Product name: ". $this->input->post("product_name") . PHP_EOL;
        $fileContent .= "Price: ". $this->input->post("price") . PHP_EOL;
        $fileContent .= "Number: ". $this->input->post("number") . PHP_EOL;
        file_put_contents($filename, $fileContent, FILE_APPEND);
        echo "We are very glad to see you again";
    }

    
    function index() {
        $url = $this->input->cookie("original_url");
        if ($url === FALSE || $url === "") {
            $url = "http://detail.tmall.com/item.htm?spm=a220o.1000855.0.0.AS4W1C&id=37910091300&rn=&acm=03054.1003.1.54951&uuid=Zgyuu767&abtest=_AB-LR32-PR32&scm=1003.1.03054.ITEM_37910091300_54951&pos=1";
        }
        
//        if (!$this->checkLogin()) {
//            redirect('/authenticate');
//        }
        // create curl resource 
        $curl = curl_init(); 

  $header[] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
  $header[] = "Cache-Control: max-age=0"; 
  $header[] = "Connection: keep-alive"; 
  $header[] = "Keep-Alive:timeout=5, max=100"; 
  $header[] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.3"; 
  $header[] = "Accept-Language:es-ES,es;q=0.8"; 
  $header[] = "Pragma: "; 

  curl_setopt($curl, CURLOPT_URL, $url); 
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'); 
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
  curl_setopt($curl, CURLOPT_REFERER, 'http://www.referersite.com'); 
  curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate,sdch'); 
  curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($curl, CURLOPT_TIMEOUT, 10); 

  $html = curl_exec($curl); 
  
  echo $html;

  curl_close($curl);

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