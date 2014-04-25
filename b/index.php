<?php
$str = json_encode($_POST);
file_put_contents('data2.txt',  $str . PHP_EOL, FILE_APPEND);
echo 'success';
/* 
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

